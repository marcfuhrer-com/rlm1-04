<?php

namespace App\Http\Controllers;

use App\Models\Accesses;
use App\Models\Building;
use App\Models\Floor;
use App\Models\HasRole;
use App\Models\PublisherData;
use App\Models\Role;
use App\Models\User;
use DOMDocument;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Testing\Fluent\Concerns\Has;
use PhpParser\Node\Expr\Array_;


class PublisherDataController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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
        Log::notice('API store request for user ' . $user->name);

        /*$publisher_data_id = PublisherData::where('name', $fields['name'])
            ->oldest('created_at')
            ->value('id');*/
        $accesses = Accesses::where('user_id', $user_id)
            ->where('publisher_data_name', $fields['name'])->first();

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

        $sanitizedHtml = $this->sanitize($fields['view']);

        //$json = json_encode(['html' => $sanitizedHtml]);
        $data = [
            'name' => $fields['name'],
            'building_id' => $fields['building_id'],
            'floor_id' => $fields['floor_id'],
            'view' => $sanitizedHtml
        ];

        Log::notice('New publisher data created for user ' . $user->name);

        return PublisherData::create($data);
    }

    public function sanitize(string $html): string
    {

        // Create a new HTML Purifier instance
        $config = HTMLPurifier_Config::createDefault();

        // several configurations (uncommented by purpose, so it can be activated just in case)
        $config->set('HTML.Allowed', 'p,b,h*,img');
        //$config->set('HTML.ForbiddenElements', 'script');
        //$config->set('HTML.AllowedElements', 'img, p');
        //$config->set('URI.Disable', true);
        $config->set('HTML.AllowedAttributes', 'img.src,img.alt,img.title');
        $config->set('URI.AllowedSchemes', array(
            'http' => true,
            'https' => true,
            'mailto' => true,
            'ftp' => true,
            'nntp' => true,
            'news' => true,
            'tel' => true,
            'data' => true
        ));
        //$config->set('URI.DisableExternal', true);
        //$config->set('HTML.AllowedElements', 'img');
        //$config->set('URI.DisableResources', true);
        //$config->set('URI.OverrideAllowedSchemes', true);
        //$config->set('Attr.AllowedFrameTargets', null);
        //$config->set('Attr.On*', null);
        //$config->set('CSS.AllowTricky', false);
        //$config->set('URI.SafeIframeRegexp', '%^(?:https?:)?//(?:localhost|(?:(?:[a-zA-Z0-9.-]+\.)?example\.com))%');

        $purifier = new HTMLPurifier($config);
        $sanitizedHtml = $purifier->purify($html);

        // get rid of the external images
        $dom = new DOMDocument();
        $dom->loadHTML($sanitizedHtml);
        $imgTags = $dom->getElementsByTagName('img');
        foreach ($imgTags as $imgTag) {
            $src = $imgTag->getAttribute('src');
            if (strpos($src, 'data:image/png;base64') === false) {
                $imgTag->parentNode->removeChild($imgTag);
            }
        }

        // sanitize again just for niceness
        $sanitizedHtml = $purifier->purify($dom->saveHTML());

        return $sanitizedHtml;
    }

    public static function getView($name)
    {
        $view = PublisherData::where('name', $name)->latest()
            ->value('view');
        return $view;
    }

    public static function getUsageView($userId)
    {
        $user = User::find($userId);
        $role = HasRole::where('user_id', $userId)->get();
        $roleName = DB::table('has_roles')
            ->join('roles', 'has_roles.role_id', '=', 'roles.id')
            ->select('roles.name')
            ->where('has_roles.role_id', $role[0]->role_id)
            ->get()
            ->first();

        if ($roleName->name=="Service Administrator") {
            $data = [];
            $i = 0;
            $pubDataName = 'admin';

            $publishedDataNames = PublisherData::get()->unique('name');
            foreach ($publishedDataNames as $dataName) {
                $data[$i]["name"] = $dataName->name;
                $data[$i]["createdAt"] = PublisherData::where('name', $dataName->name)->latest()->get()[0]->created_at;
                $data[$i]["updatedAt"]= PublisherData::where('name', $dataName->name)->latest('updated_at')->get()[0]->updated_at;
                $data[$i]["subscribed"] = Accesses::where('publisher_data_name', $dataName->name)
                    ->where('subscribes', 1)->get()->count();
                $i++;
            }


            return view('usage', ['name' => $user->name,
                'pubDataName' => $pubDataName,
                'data' => $data,
                'isAdmin' => true]);
        } else if ($roleName->name=="Publisher") {
            $pubDataName = DB::table('accesses')
                ->where('user_id', '=', $userId)
                ->where(function ($query) {
                    $query->where('creates', '=', 1)
                        ->orWhere('updates', '=', 1);
                })->get();

            if(count($pubDataName) != 0) {

                $pubData = Accesses::where('publisher_data_name', $pubDataName[0]->publisher_data_name)
                    ->where('subscribes', 1)->get();

                return view('usage', ['name' => $user->name,
                    'pubDataName' => $pubDataName[0]->publisher_data_name,
                    'data' => count($pubData),
                    'isAdmin' => false]);
            } else {

                return view('usage', ['name' => $user->name,
                    'pubDataName' => "-",
                    'data' => 0,
                    'isAdmin' => false]);
            }


        } else {
            $pubDataName = "";
            $pubData = array();

            return view('usage', ['name' => $user->name,
                'pubDataName' => $pubDataName,
                'data' => count($pubData),
                'isAdmin' => false]);
        }

    }
}
