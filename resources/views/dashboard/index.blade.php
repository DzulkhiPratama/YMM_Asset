@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">YMM PT FI Assets</h1>

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
    <div class="card-header">Assets Statistic</div>
    <div class="card-body" height="50">
        <div class="row">
            <div class="col-7">
                <h6 class="mt-2" id="total_asset_price"></h6>
                <h6 class="mt-1">Total Registered Asset: <?= $assets_tot_count[0] ?></h6>
                <div class="mt-5">
                    <div class="chart-area"><canvas id="bar-chart" width="300" height="100"></canvas></div>
                </div>
            </div>

            <div class="col-5 d-inline-flex">
                <div class="chart-area mt-5"><canvas id="pie-chart" height="200"></canvas></div>
                <div>
                    <div class="row mb-2 mt-5">
                        <div class="d-inline-flex">
                            <div class="box red" style="width:20px;height:20px;background:rgba(255, 99, 132, 0.2);"></div>
                            <div>Elektronik</div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="d-inline-flex">
                            <div class="box red" style="width:20px;height:20px;background:rgba(54, 162, 235, 0.2);"></div>
                            <div>Furniture</div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="d-inline-flex">
                            <div class="box red" style="width:20px;height:20px;background:rgba(255, 206, 86, 0.2);"></div>
                            <div>Cookware</div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="d-inline-flex">
                            <div class="box red" style="width:20px;height:20px;background:rgba(75, 192, 192, 0.2);"></div>
                            <div>Book</div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="d-inline-flex">
                            <div class="box red" style="width:20px;height:20px;background:rgba(153, 102, 255, 0.2);"></div>
                            <div>Book</div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">

        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">Assets List</div>
    <div class="card-body">

        @auth
        @if ( auth()->user()->role_id >= 2)
        <a href="/dashboard/create" class="btn btn-primary mb-3">Add Assets +</a>
        @endif
        @endauth

        <table id="assetlist" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Asset ID</th>
                    <th>Asset Name</th>
                    <th>PIC</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($assets as $asset)

                <tr>

                    @auth
                    <td><a href="/detail/<?= $asset->asset_id; ?>"><?= $asset->asset_type_Code; ?><?= $asset->asset_id; ?></a></td>
                    <td><?= $asset->asset_name; ?></td>
                    <td><?= $asset->name; ?></td>
                    <td style="background-color:<?= ($asset->asset_status_name === "Available") ? '#adff2f' : '' ?>">
                        <?= $asset->asset_status_name; ?>
                    </td>

                    @if ( auth()->user()->role_id >= 2)
                    <td>
                        <a href="/dashboard/{{ $asset->asset_id }}/edit" class="badge bg-info"><span data-feather="edit"></span></a>

                        <form action="/dashboard/{{ $asset->asset_id }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf

                            <button href="" class="badge bg-warning border-0" onclick="return confirm('Want to Unregister this asset?')"><span data-feather="trash-2"></span></button>
                        </form>
                    </td>
                    @else
                    <td>

                    </td>
                    @endif

                    @else
                    <td><a href="/detail/<?= $asset->asset_id; ?>"><?= $asset->asset_type_Code; ?><?= $asset->asset_id; ?></a></td>
                    <td><?= $asset->asset_name; ?></td>
                    <td><?= $asset->name; ?></td>
                    <td style="background-color:<?= ($asset->asset_status_name === "Available") ? '#adff2f' : '' ?>">
                        <?= $asset->asset_status_name; ?>
                    </td>
                    <td>
                        <a><span data-feather="edit"></span></a>
                        <a><span data-feather="trash-2"></span></a>
                    </td>
                    @endauth

                </tr>

                @endforeach
            </tbody>

        </table>


    </div>
</div>


@endsection