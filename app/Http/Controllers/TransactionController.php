<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\assets;
use Illuminate\Support\Facades\Auth;
use App\Models\purpose;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_dkm = Auth::user()->loc_dkm;
        return view('transaction/index', [
            "tittle" => "Transaction",
            'state' => 'transaction',
            'transactions' => transaction::assets_types_orders($user_dkm),
            'user_order' => transaction::user_order(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_dkm = Auth::user()->loc_dkm;
        return view('transaction.order', [
            "tittle" => "Transaction",
            'state' => 'create',
            'assets' => assets::show_on_loc($user_dkm)->where('status_id', 1),
            'purposes' => purpose::all(),

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

        $newestOrder = transaction::orderBy('order_id', 'desc')->first();

        $transaction = transaction::create([
            'order_id' => $newestOrder['order_id'] + 1,
            'asset_id' => $request->asset_id,
            'purpose_id' => $request->purpose_id,
            'purpose_desc' => $request->purpose_desc,
            'estimate_return_at' => $request->estimate_return_at,
            'order_user_id' => auth()->id(),
            'order_at' => now(),
            'app_user_id' => 0,

        ]);

        return redirect()->route('transaction.index')->with('success', 'Your Order been Set');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($transaction)
    {
        $tr = DB::table('transactions')->where('order_id', $transaction)->get();
        return view('transaction.show', [
            'transactions' => $tr,
            'state' => 'show',
            "tittle" => "Transaction",
            'assets' => assets::where('asset_id', $tr[0]->asset_id)->get(),
            'purposes' => purpose::where('id', $tr[0]->purpose_id)->get(),
            'user_order' => transaction::user_order_whoa($tr[0]->order_user_id)->where('order_id', $transaction)->first(),
            'user_adm' => transaction::user_adm_who($tr[0]->adm_user_id)->where('order_id', $transaction)->first(),
            'user_app' => transaction::user_app_who($tr[0]->app_user_id)->where('order_id', $transaction)->first(),
            'user_disapp' => transaction::user_disapp_who($tr[0]->disapp_user_id)->where('order_id', $transaction)->first(),
            'user_return' => transaction::user_return_who($tr[0]->return_user_id)->where('order_id', $transaction)->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($transaction)
    {
        $tr = DB::table('transactions')->where('order_id', $transaction)->get();
        return view('transaction.app', [
            'transactions' => $tr,
            'state' => 'edit',
            "tittle" => "Transaction",
            'assets' => assets::where('asset_id', $tr[0]->asset_id)->get(),
            'purposes' => purpose::where('id', $tr[0]->purpose_id)->get(),
            'user_order' => transaction::user_order_whoa($tr[0]->order_user_id)->where('order_id', $transaction)->first(),
            'user_adm' => transaction::user_adm_who($tr[0]->adm_user_id)->where('order_id', $transaction)->first(),
            'user_app' => transaction::user_app_who($tr[0]->app_user_id)->where('order_id', $transaction)->first(),
            'user_disapp' => transaction::user_disapp_who($tr[0]->disapp_user_id)->where('order_id', $transaction)->first(),
            'user_return' => transaction::user_return_who($tr[0]->return_user_id)->where('order_id', $transaction)->first(),
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $transaction)
    {

        $transaction = transaction::where('order_id', $transaction)->first();
        $asset = assets::where('asset_id', $transaction->asset_id)->first();

        // dd($transaction->adm_user_id);
        if ($transaction->adm_user_id == 0) {

            $asset->status_id = 1;
            $asset->asset_log = "ready to approve";
            $transaction->update([
                'adm_user_id' => auth()->id(),
                'adm_at' => now(),
                'adm_note' => $request->adm_note,
            ]);
            $stat = 'success';
            $isipesan = 'Admin Been Check The Order';
        } elseif ($transaction->adm_user_id !== 0) {
            if ($request->approve == 1) {
                if ($transaction->app_user_id == 0) {
                    $asset->status_id = 2;
                    $asset->asset_log = "approve to order";

                    $transaction->update([
                        'app_user_id' => auth()->id(),
                        'app_at' => now(),
                        'app_note' => $request->app_note,
                    ]);

                    $stat = 'success';
                    $isipesan = 'The Order Been Approved';
                } elseif ($transaction->app_user_id != 0 && $transaction->return_user_id == 0) {
                    $asset->status_id = 1;
                    $asset->asset_log = "already return";

                    $transaction->update([
                        'return_user_id' => auth()->id(),
                        'return_at' => now(),
                        'return_note' => $request->return_note,
                    ]);
                    $stat = 'success';
                    $isipesan = 'The Asset Been Returned';
                }
            } elseif ($request->disapprove == 1) {
                if ($transaction->app_user_id == 0 && $transaction->return_user_id == 0) {

                    $asset->status_id = 1;
                    $asset->asset_log = "disapprove to order";
                    $transaction->update([
                        'disapp_user_id' => auth()->id(),
                        'disapp_at' => now(),
                        'disapp_note' => $request->app_note,
                    ]);
                    $stat = 'danger';
                    $isipesan = 'The Order Been Disapproved';
                } elseif ($transaction->app_user_id != 0 && $transaction->return_user_id == 0) {
                    $asset->status_id = 1;
                    $asset->asset_log = "already return";
                    $transaction->update([
                        'return_user_id' => auth()->id(),
                        'return_at' => now(),
                        'return_note' => $request->return_note,
                    ]);
                    $stat = 'success';
                    $isipesan = 'The Asset Been Returned';
                }
            } elseif ($request->return == 1) {
                $asset->status_id = 1;
                $asset->asset_log = "already return";
                $transaction->update([
                    'return_user_id' => auth()->id(),
                    'return_at' => now(),
                    'return_note' => $request->return_note,
                ]);
                $stat = 'success';
                $isipesan = 'The Asset Been Returned';
            }
        }
        // dd($request);
        $asset->save();
        return redirect()->route('transaction.index')->with($stat, $isipesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($transaction)
    {
        DB::table('transactions')->where('order_id', $transaction)->delete();
        return redirect()->route('transaction.index')->with('danger', 'Order been Deleted');
    }
}
