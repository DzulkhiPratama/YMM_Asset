<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class assets extends Model
{
    use HasFactory;
    // public static function index()
    // {
    //     return asset::all();
    // }
    protected $fillable = ['asset_id', 'user_id', 'type_id', 'asset_name', 'asset_desc', 'added_at', 'expired_date', 'asset_price', 'mis_id', 'couse_exist', 'status_id', 'location_id', 'asset_log'];

    protected $table = 'assets';

    public static function index()
    {

        $assetnya = DB::table('assets')
            ->select('assets.*', 'asset_types.*', 'asset_statuses.*', 'users.*')
            ->join('asset_types', 'asset_types.id', '=', 'assets.type_id')
            ->join('asset_statuses', 'asset_statuses.id', '=', 'assets.status_id')
            ->join('users', 'users.id', '=', 'assets.user_id')
            ->get();

        return $assetnya;
    }

    public static function show($assetid)
    {
        // load ditambahkan agar setiap pemanggilan bisa langsung menyertai asset_types 'clock work'
        return assets::where('asset_id', $assetid)->orderBy('added_at', 'asc')->get()->load(['asset_types']);
    }

    public static function asset_pic_who($asset_id)
    {
        $tr = DB::table('assets')
            ->join('users', 'assets.user_id', '=', 'users.id')
            ->select('users.*', 'assets.asset_id')
            ->where('asset_id', '=', $asset_id)
            ->get();
        return $tr;
    }

    public function asset_types()
    {
        return $this->belongsTo('App\Models\asset_types', 'type_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function asset_status()
    {
        return $this->belongsTo('App\Models\asset_status', 'status_id');
    }

    public function location()
    {
        return $this->belongsTo('App\Models\location', 'location_id');
    }

    public static function show_on_loc($user_dkm)
    {
        $str_arr = explode("-", $user_dkm);

        $assetnya = DB::table('assets')
            ->select('assets.*', 'locations.*', 'asset_types.*', 'asset_statuses.*', 'users.*')
            ->join('locations', 'locations.id', '=', 'assets.location_id')
            ->join('asset_types', 'asset_types.id', '=', 'assets.type_id')
            ->join('asset_statuses', 'asset_statuses.id', '=', 'assets.status_id')
            ->join('users', 'users.id', '=', 'assets.user_id')
            ->where(['locations.asset_HL_LL' => $str_arr[0], 'locations.asset_loc_mp' => $str_arr[1], 'locations.asset_loc_dkm' => $str_arr[2]])
            ->get();

        return $assetnya;
    }

    public static function assets_price()
    {

        $assets_price = assets::select(DB::raw("SUM(asset_price) as total"))
            ->groupBy("type_id")
            ->get();

        $price = [];
        foreach ($assets_price as $ty) {
            $price[] = ($ty->total) / 1000;
        }

        return $price;
    }

    public static function assets_tot_price()
    {

        $assets_price = assets::select(DB::raw("SUM(asset_price) as total"))
            ->get();

        $price = [];
        foreach ($assets_price as $ty) {
            $price[] = ($ty->total);
        }

        return $price;
    }

    public static function assets_count()
    {
        $assets_count = assets::select(DB::raw("COUNT(type_id) as total"))
            ->groupBy("type_id")
            ->get();

        $type = [];
        foreach ($assets_count as $ty) {
            $type[] = ($ty->total);
        }

        return $type;
    }

    public static function assets_tot_count()
    {
        $assets_count = assets::select(DB::raw("COUNT(type_id) as total"))
            ->get();

        $type = [];
        foreach ($assets_count as $ty) {
            $type[] = ($ty->total);
        }

        return $type;
    }
}
