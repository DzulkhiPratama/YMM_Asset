@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $user->name }}'s Order List</h1>

</div>


@if(session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>

@elseif(session()->has('danger'))
<div class="alert alert-danger" role="alert">
    {{ session('danger') }}
</div>
@endif

<div class="card mb-4">
    <div class="card-header">Submitted Order</div>
    <div class="card-body">

        <table id="apporderlist" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Asset ID</th>
                    <th>Asset Name</th>
                    <th>Requestor</th>
                    <th>Status</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($transactions as $tr)

                <tr>
                    <td><a href="/transaction/{{ $tr->order_id }}"><?= $tr->asset_type_Code; ?><?= $tr->asset_id; ?></a></td>
                    <td><?= $tr->asset_name; ?></td>
                    <td><?= $tr->name; ?></td>

                    @if ($tr->adm_user_id == 0)
                    <td style="background-color:#ffb347">
                        Waiting for Admin Check
                    </td>

                    @elseif ($tr->adm_user_id !== 0)

                    @if ($tr->disapp_user_id !== 0 and $tr->return_user_id == 0)
                    <td style="background-color:#da2c43">
                        Order Been Disapproved
                    </td>
                    @elseif ($tr->app_user_id == 0)
                    <td style="background-color:#da2c43">
                        Waiting for Approval
                    </td>
                    @elseif ($tr->app_user_id !== 0 and $tr->return_user_id == 0)
                    <td style="background-color:#da2c43">
                        Order been approved & Asset already out
                    </td>
                    @elseif ($tr->app_user_id !== 0 and $tr->return_user_id !== 0)
                    <td style="background-color:#adff2f">
                        Completed
                    </td>
                    @endif

                    @endif


                </tr>

                @endforeach
            </tbody>

        </table>


    </div>
</div>

@endsection