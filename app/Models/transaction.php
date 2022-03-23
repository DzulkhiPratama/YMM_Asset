<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class transaction extends Model
{
    use HasFactory;
    protected $fillable = ['asset_id', 'purpose_id', 'purpose_desc', 'estimate_return_at', 'order_user_id', 'order_at', 'adm_user_id', 'adm_at', 'adm_note', 'app_user_id', 'app_at', 'app_note', 'disapp_user_id', 'disapp_at', 'disapp_note', 'return_user_id', 'return_at', 'return_note', 'order_id'];
    protected $primarykey = 'id';


    public function purposes()
    {
        return $this->belongsTo('App\Models\purposes', 'purpose_id');
    }
    public static function user_order()
    {
        // return $this->belongsTo('App\Models\User', 'order_user_id');
        $tr = DB::table('transactions')
            ->join('users', 'transactions.order_user_id', '=', 'users.id')
            ->select('transactions.return_user_id', 'users.id', 'users.name')
            ->get();
        return $tr;
    }


    // digunakan pada app, sehingga tau info terkait order
    public static function user_order_who()
    {
        $tr = DB::table('transactions')
            ->select('transactions.*', 'assets.*', 'asset_types.*', 'users.*')
            ->join('assets', 'transactions.asset_id', '=', 'assets.asset_id')
            ->join('asset_types', 'asset_types.id', '=', 'assets.type_id')
            ->join('users', 'users.id', '=', 'transactions.order_user_id')
            ->get();

        return $tr;
    }

    public static function user_app()
    {
        // return $this->belongsTo('App\Models\User', 'order_user_id');
        $tr = DB::table('transactions')
            ->join('users', 'transactions.app_user_id', '=', 'users.id')
            ->select('users.id', 'users.name')
            ->get();
        return $tr;
    }

    public static function user_return()
    {
        // return $this->belongsTo('App\Models\User', 'order_user_id');
        $tr = DB::table('transactions')
            ->join('users', 'transactions.return_user_id', '=', 'users.id')
            ->select('users.id', 'users.name')
            ->get();
        return $tr;
    }

    public static function assets_types_orders($user_dkm)
    {
        // return transaction::join('assets', 'assets.asset_id', '=', 'transactions.asset_id')->join('asset_types', 'asset_types.id', '=', 'assets.type_id')->get();

        // $tr = DB::table('transactions')
        //     ->join('assets', 'transactions.asset_id', '=', 'assets.asset_id')
        //     ->join('asset_types', 'assets.type_id', '=', 'asset_types.id')
        //     ->join('users', 'users.id', '=', 'transactions.order_user_id')
        //     ->select('transactions.id', 'transactions.asset_id', 'transactions.purpose_id', 'transactions.purpose_desc', 'transactions.estimate_return_at', 'transactions.order_user_id', 'transactions.order_at', 'transactions.app_user_id', 'transactions.app_at', 'transactions.return_user_id', 'transactions.return_at', 'assets.asset_id', 'assets.user_id', 'assets.type_id', 'assets.asset_name', 'assets.asset_desc', 'assets.added_at', 'assets.expired_date', 'assets.asset_price', 'assets.mis_id', 'assets.couse_exist', 'assets.status_id', 'assets.location_id', 'assets.asset_log', 'asset_types.asset_type_name', 'asset_types.asset_type_code', 'users.name')
        //     ->orderby('id', 'asc')
        //     ->get();

        $str_arr = explode("-", $user_dkm);
        $ordernya = DB::table('transactions')
            ->select('transactions.*', 'locations.*', 'assets.*', 'asset_types.*', 'users.*')
            ->join('assets', 'transactions.asset_id', '=', 'assets.asset_id')
            ->join('locations', 'locations.id', '=', 'assets.location_id')
            ->join('asset_types', 'asset_types.id', '=', 'assets.type_id')
            ->join('users', 'users.id', '=', 'transactions.order_user_id')
            ->where(['locations.asset_HL_LL' => $str_arr[0], 'locations.asset_loc_mp' => $str_arr[1], 'locations.asset_loc_dkm' => $str_arr[2]])
            ->get();
        return $ordernya;
    }

    public static function user_order_whoa($order_user_id)
    {
        $tr = DB::table('transactions')
            ->join('users', 'transactions.order_user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'transactions.order_id')
            ->where('order_user_id', '=', $order_user_id)
            ->get();
        return $tr;
    }

    public static function user_adm_who($adm_user_id)
    {
        $tr = DB::table('transactions')
            ->join('users', 'transactions.adm_user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'transactions.order_id')
            ->where('adm_user_id', '=', $adm_user_id)
            ->get();
        return $tr;
    }

    public static function user_app_who($app_user_id)
    {
        $tr = DB::table('transactions')
            ->join('users', 'transactions.app_user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'transactions.order_id')
            ->where('app_user_id', '=', $app_user_id)
            ->get();
        return $tr;
    }

    public static function user_disapp_who($disapp_user_id)
    {
        $tr = DB::table('transactions')
            ->join('users', 'transactions.disapp_user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'transactions.order_id')
            ->where('disapp_user_id', '=', $disapp_user_id)
            ->get();
        return $tr;
    }

    public static function user_return_who($return_user_id)
    {
        $tr = DB::table('transactions')
            ->join('users', 'transactions.return_user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'transactions.order_id')
            ->where('return_user_id', '=', $return_user_id)
            ->get();
        return $tr;
    }
}
