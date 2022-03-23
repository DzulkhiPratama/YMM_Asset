<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaction;
use Illuminate\Support\Facades\Auth;

class UserorderController extends Controller
{
    public function index()
    {
        return view('transaction.user_order', [
            "tittle" => "Order",
            'state' => 'transaction',
            'transactions' => transaction::user_order_who()->where('order_user_id', auth()->id()),
            // 'transactions' => transaction::where('order_user_id', auth()->id())->get(),
            'user' => Auth::user(),
        ]);
    }
}
