<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\assets;
use App\Models\location;
use App\Models\asset_types;
use App\Models\transaction;
use Illuminate\Support\Facades\DB;

class AssetController extends Controller
{
    public function resume()
    {
        return view('dashboard/resume', [
            "tittle" => "Resume"

        ]);
    }

    public function index()
    {

        return view('dashboard/index', [
            "tittle" => "Dashboard",
            'state' => 'Dashboard',
            'assets' => assets::index(),
            'assets_price' => assets::assets_price(),
            'assets_tot_price' => assets::assets_tot_price(),
            'assets_count' => assets::assets_count(),
            'assets_tot_count' => assets::assets_tot_count(),
            'list_type' => asset_types::get_type()
        ]);
    }

    public function show($assetid)
    {
        // return view('dashboard/detail', [
        //     "tittle" => "Dashboard",
        //     'state' => 'Detail',
        //     "assets" => assets::show($assetid)
        // ]);
        $assetnya = DB::table('assets')->where('asset_id', $assetid)->get();
        return view('dashboard.detail', [
            'assety' => $assetnya,
            'state' => 'detail',
            "tittle" => "Dashboard",
            'type' => asset_types::all(),
            'pic' => assets::asset_pic_who($assetid)->first(),
            'location' => location::orderBy('asset_loc_mp', 'desc')->get()
        ]);
    }
}
