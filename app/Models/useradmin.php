<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class useradmin extends Model
{
    public static function user_role()
    {
        $tr = DB::table('users')
            ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
            ->select('users.*', 'users_roles.roles_type_name')
            ->get();
        return $tr;
    }
}
