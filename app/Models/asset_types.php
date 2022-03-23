<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\asset;
use Illuminate\Support\Facades\DB;

class asset_types extends Model

{
    use HasFactory;
    public static function get_type()
    {

        $type = [];

        $tr = DB::table('asset_types')
            ->join('assets', 'asset_types.id', '=', 'assets.type_id')
            ->select('asset_types.id', 'asset_types.asset_type_name')
            ->orderBy('asset_types.id')
            ->get();

        $types = asset_types::all();

        foreach ($tr as $ty) {
            if (in_array($ty->asset_type_name, $type)) {
                // nilai ditambahkan karena sudah ada sebelumnya
            } else {
                $type[] = $ty->asset_type_name;
            }
        }

        return $type;
    }
}
