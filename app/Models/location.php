<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class location extends Model
{
    use HasFactory;
    public static function location_based_DKM()
    {
        $location_dkm = DB::table('locations')
            ->select('asset_loc_dkm', 'asset_loc_mp')
            ->orderBy('asset_loc_mp')
            ->groupBy('asset_loc_dkm')
            ->get();

        return $location_dkm;
    }

    public static function show_on_loc($user_dkm)
    {
        $str_arr = explode("-", $user_dkm);

        $assetnya = DB::table('locations')
            ->select('locations.*')
            ->where(['locations.asset_HL_LL' => $str_arr[0], 'locations.asset_loc_mp' => $str_arr[1], 'locations.asset_loc_dkm' => $str_arr[2]])
            ->get();

        return $assetnya;
    }
}
