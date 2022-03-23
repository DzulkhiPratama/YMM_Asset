@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">YMM PT FI Assets Approval</h1>

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
        @auth
        @if ( auth()->user()->role_id >= 1)
        <a href="/transaction/create" class="btn btn-primary mb-3">Add Order +</a>
        @endif
        @endauth

        <table id="apporderlist" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Asset ID</th>
                    <th>Asset Name</th>
                    <th>Requestor</th>
                    <th>Status</th>
                    <th>Action</th>
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
                    <td>
                        @auth
                        @if ($tr->disapp_user_id !== 0)
                        <a><span data-feather="check-square"></span></a>
                        <a><span data-feather="trash-2"></span></a>

                        @elseif ($tr->app_user_id !== 0 and $tr->return_user_id !== 0)
                        <a><span data-feather="check-square"></span></a>
                        <a><span data-feather="trash-2"></span></a>

                        @elseif (auth()->user()->role_id >= 2 and $tr->return_user_id == 0 and $tr->disapp_user_id == 0)
                        <a href="/transaction/{{ $tr->order_id }}/edit" class="badge bg-info"><span data-feather="check-square"></span></a>

                        <form action="/transaction/{{ $tr->order_id }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf

                            <button href="" class="badge bg-warning border-0" onclick="return confirm('Want to delete this order?')"><span data-feather="trash-2"></span></button>
                        </form>

                        @else
                        <!-- nothing to show when not adm -->
                        <a><span data-feather="check-square"></span></a>
                        <a><span data-feather="trash-2"></span></a>
                        @endif

                        <!-- bila tidak log in -->
                        @else
                        <a><span data-feather="check-square"></span></a>
                        <a><span data-feather="trash-2"></span></a>
                        @endauth
                    </td>

                </tr>

                @endforeach
            </tbody>

        </table>


    </div>
</div>

@endsection