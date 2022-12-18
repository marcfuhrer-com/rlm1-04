<?php

namespace App\Http\Controllers;

use App\Models\Accesses;
use App\Models\Building;
use App\Models\Floor;
use App\Models\PublisherData;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PublisherDataController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'building_id' => 'required',
            'floor_id' => 'required',
            'view' => 'required'
        ]);

        $building = Building::where('id', $fields['building_id'])->first();
        $floor = Floor::where('id', $fields['floor_id'])->first();

        if (!$building) {
            $response = [
                'message' => "building_id not found"
            ];
            return response($response, 404);
        }

        if (!$floor) {
            $response = [
                'message' => "floor_id not found"
            ];
            return response($response, 404);
        }

        $user = Auth::user();
        $user_id = $user->id;
        $publisher_data_id = PublisherData::where('name', $fields['name'])
            ->oldest('created_at')
            ->value('id');
        $accesses = Accesses::where('user_id', $user_id)
            ->where('publisher_data_id', $publisher_data_id)->first();

        $updates = 0;
        if ($accesses) {
            $json = json_decode($accesses, true);
            $updates = data_get($json, 'updates');
        }

        if (!$updates) {
            $response = [
                'message' => "You're not authorized to update this view",
            ];
            return response($response, 403);
        }

        $raw = json_decode($fields['view'], true);
        $html = data_get($raw, 'html');

        // Create a new HTML Purifier instance
        $config = HTMLPurifier_Config::createDefault();

        // Disallow the script tag and attributes that execute JavaScript code
        $config->set('HTML.Allowed', 'p,b');
        $config->set('HTML.ForbiddenElements', 'script');
        $config->set('Attr.AllowedFrameTargets', null);
        $config->set('Attr.On*', null);
        $config->set('CSS.AllowTricky', false);
        $config->set('URI.SafeIframeRegexp', '%^(?:https?:)?//(?:localhost|(?:(?:[a-zA-Z0-9.-]+\.)?example\.com))%');

        $purifier = new HTMLPurifier($config);

        // Sanitize the HTML input
        $sanitizedHtml = $purifier->purify($html);

        $json = json_encode(['html' => $sanitizedHtml]);
        $data = [
            'name' => $fields['name'],
            'building_id' => $fields['building_id'],
            'floor_id' => $fields['floor_id'],
            'view' => $json
        ];

        return PublisherData::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
