<?php

namespace App\Http\Controllers;

use App\Models\asset_status;
use App\Models\assets;
use App\Models\location;
use App\Models\asset_types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AssetDashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { {
            // to get total prize base on category
            $user_dkm = Auth::user()->loc_dkm;

            return view('dashboard/index', [
                "tittle" => "Dashboard",
                'state' => 'Dashboard',
                'assets' => assets::show_on_loc($user_dkm),
                'assets_price' => assets::assets_price(),
                'assets_tot_price' => assets::assets_tot_price(),
                'assets_count' => assets::assets_count(),
                'assets_tot_count' => assets::assets_tot_count(),
                'list_type' => asset_types::get_type(),

            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_dkm = Auth::user()->loc_dkm;

        return view('dashboard.create', [
            "tittle" => "Dashboard",
            'state' => 'create',
            'location' => location::show_on_loc($user_dkm),
            'type' => asset_types::all(),
            'asset_status' => asset_status::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_id' => ['required'],
            'asset_name' => ['required'],
            'asset_price' => ['numeric'],
            'asset_desc' => ['required'],
            'couse_exist' => ['required'],
            'added_at' => ['required'],
            'location_id' => ['required'],
            'mis_id' => ['numeric']
        ]);


        $max_asset_id = assets::max('asset_id') + 1;

        $asset = assets::create([
            'asset_id' => strval($max_asset_id),
            'user_id' => auth()->id(),
            'type_id' => $request->type_id,
            'asset_name' => $request->asset_name,
            'asset_desc' => $request->asset_desc,
            'added_at' => $request->added_at,
            'expired_date' => $request->expired_date,
            'asset_price' => $request->asset_price,
            'mis_id' => $request->mis_id,
            'couse_exist' => $request->couse_exist,
            'status_id' => $request->status_id,
            'location_id' => $request->location_id,
            'asset_log' => "created"
            // saat create, langsung avalable (staus_id = 1)
        ]);


        return redirect()->route('dashboard.index')->with('success', 'new asset been registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function show(assets $assets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function edit($assetid)
    {
        $user_dkm = Auth::user()->loc_dkm;
        $assetnya = DB::table('assets')->where('asset_id', $assetid)->get();
        return view('dashboard.edit', [
            'assety' => $assetnya,
            'state' => 'edit',
            "tittle" => "Dashboard",
            'type' => asset_types::all(),
            'location' => location::show_on_loc($user_dkm),
            'asset_status' => asset_status::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $assetid)
    {
        $request->validate([
            'type_id' => 'required',
            'asset_name' => 'required',
            'asset_price' => 'numeric',
            'asset_desc' => 'required',
            'couse_exist' => 'required',
            'added_at' => 'required',
            'location_id' => 'required',
            'mis_id' => 'numeric',

        ]);

        // PIC dan status asset tidak diubah

        $request['asset_log'] = "edittedA";

        $assets = assets::where('asset_id', $assetid)->first();

        $assets->update($request->all());

        return redirect('dashboard')->with('success', 'Asset been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function destroy($assetid)
    {
        // dd($assets);
        // assets::destroy(1);
        // $asset->delete();
        DB::table('assets')->where('asset_id', $assetid)->delete();
        DB::table('transactions')->where('asset_id', $assetid)->delete();

        return redirect('dashboard')->with('danger', 'Asset been Unregistered');
    }
}
