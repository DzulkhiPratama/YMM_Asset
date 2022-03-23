<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Models\location;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            // 'location' => location::location_based_DKM(),
            'location' => location::orderBy('asset_loc_mp', 'desc')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'name' => 'min:2|unique:users',
            'email' => 'email:dns|unique:users',
            'password' => 'min:2',
            'userid' => 'min:4',

        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['loc_dkm'] = $request->location_id;
        User::create($validatedData);

        $request->session()->flash('success', 'Registration Completed!');
        return redirect('/login');
    }
}
