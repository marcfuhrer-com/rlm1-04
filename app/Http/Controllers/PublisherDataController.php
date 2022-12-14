<?php

namespace App\Http\Controllers;

use App\Models\Accesses;
use App\Models\Building;
use App\Models\Floor;
use App\Models\PublisherData;
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
            'view' => 'required|json'
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

        //$user = Auth::user();
        /*$updates = Accesses::where('user_id', $user->id)
            ->where('publisher_data_name', $fields['name'])->first()
            ->get(['updates']);*/

        /*if (!$updates) {
            $response = [
                'message' => "You're not authorized to update this view"
            ];

            return response($response, 403);
        }*/
        //return response($updates, 403);

        return PublisherData::create($request->all());
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
