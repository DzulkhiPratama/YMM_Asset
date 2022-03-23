<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\useradmin;
use Illuminate\Http\Request;
use \App\Models\location;
use \App\Models\users_role;
use Illuminate\Support\Facades\DB;

class UseradminController extends Controller
{
    public function index()
    {

        return view('useradmin/index', [
            "tittle" => "admin",
            'state' => 'admin',
            'users' => useradmin::user_role()
        ]);
    }

    public function show($transaction)
    {
        return view('useradmin/show', [
            "tittle" => "admin",
            'state' => 'admin',
            'users' => useradmin::user_role()
        ]);
    }

    public function create()
    {
        return view('useradmin/adduser', [
            "tittle" => "admin",
            'state' => 'admin',
            // 'location' => location::location_based_DKM(),
            'roles' => users_role::all(),
            'location' => location::orderBy('asset_loc_mp', 'desc')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'name' => 'min:2|unique:users',
            'email' => 'email:dns|unique:users',
            'password' => 'min:2',
            'userid' => 'min:4|unique:users',

        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['loc_dkm'] = $request->location_id;
        $validatedData['role_id'] = $request->role_id;

        User::create($validatedData);

        $request->session()->flash('success', 'Registration Completed!');
        return redirect('/admin');
    }

    public function edit($userid)
    {
        $usr = DB::table('users')->where('userid', $userid)->get();

        return view('useradmin.edit', [
            'state' => 'edit_adm',
            "tittle" => "admin",
            'user' => $usr,
            'roles' => users_role::all(),
            'location' => location::orderBy('asset_loc_mp', 'desc')->get(),
        ]);
    }

    public function update(Request $request, $userid)
    {
        $usr = User::where('userid', $userid)->first();

        if ($request->cgfullname == 'Yes') {
            $request->validate([
                'name' => 'min:2|unique:users',
            ]);
            $usr->update([
                'name' => $request->name,
            ]);
        }

        if ($request->cgemail == 'Yes') {
            $validatedData = $request->validate([
                'email' => 'email:dns|unique:users',
            ]);
            $usr->update([
                'email' => $validatedData['email'],
            ]);
        }

        if ($request->cgpass == 'Yes') {
            $validatedData = $request->validate([
                'password' => 'min:2',
            ]);
            $validatedData['password'] = bcrypt($validatedData['password']);
            $usr->update([
                'password' => $validatedData['password'],
            ]);
        }

        if ($request->cguserid == 'Yes') {
            $validatedData = $request->validate([
                'userid' => 'min:4|unique:users',
            ]);
            $usr->update([
                'userid' => $validatedData['userid'],
            ]);
        }

        $usr->update([
            'role_id' => $request->role_id,
            'loc_dkm' => $request->location_id,
        ]);

        // dd($request->cgfullname);
        // return redirect('/admin')->with('success', 'User Info been Updated');
        return redirect()->route('admin.index')->with('success', 'User Info been Updated');
    }

    public function destroy($userid)
    {
        DB::table('users')->where('userid', $userid)->delete();
        return redirect()->route('admin.index')->with('danger', 'User been Deleted');
    }
}
