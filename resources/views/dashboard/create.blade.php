@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add Assets</h1>
</div>
<!-- Grid row -->
<!-- karena menggunakan resource pada routes nya, gabungan /dashboard + method post pasti akan ke store -->
<form action="/dashboard" method="post">
    @csrf
    <div class="card col-6 mb-3">
        <div class="card-header">Please Fill Form</div>
        <div class="row m-lg-1">
            <!-- Grid column -->

            <div class="col-8 mt-2">
                <!-- Default input -->
                <label class="mb-2">Input Asset Type</label>

                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="type_id" name="type_id" required autofocus>

                    @foreach($type as $ty)
                    @if(old('type_id')==$ty->id)
                    <option value="<?= $ty->id; ?>" selected><?= $ty->asset_type_name; ?></option>
                    @else
                    <option value="<?= $ty->id; ?>"><?= $ty->asset_type_name; ?></option>
                    @endif
                    @endforeach
                </select>

            </div>

        </div>

        <!-- Small input -->
        <div class="row m-lg-1">
            <!-- Grid column -->
            <div class="col-8 mt-2">
                <label>Asset Name</label>
                <input type="text" class="form-control @error('asset_name') is-invalid @enderror" placeholder="Your Asset Name" id="asset_name" name="asset_name" required value="{{ old('asset_name') }}">
                @error('asset_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->
            <div class="col-8 mt-2">
                <label>Asset Price, If been bought (IDR)</label>
                <input type="text" class="form-control" placeholder="Price of Asset" id="asset_idr_str" name="asset_idr_str" value="">
            </div>
        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->
            <div class="col-8 mt-2">
                <label>Asset Desc</label>
                <input class="form-control @error('asset_desc') is-invalid @enderror" id="asset_desc" name="asset_desc" rows="3" required value="{{ old('asset_desc') }}"></input>
                @error('asset_desc')
                <div class=" invalid-feedback">{{ $message }}
                </div>
                @enderror
            </div>

        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->
            <div class="col-8 mt-2">
                <label>Asset Couse Of Existance</label>
                <input class="form-control @error('couse_exist') is-invalid @enderror" id="couse_exist" name="couse_exist" rows="3" required value="{{ old('couse_exist') }}"></input>
                @error('couse_exist')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->
            <div class="col-4 mt-2">

                <label>Asset Added Date</label>
                <input id="added_at" type="text" class="form-control @error('added_at') is-invalid @enderror" placeholder="Added Date" name="added_at" required value="{{ old('added_at') }}">
                @error('added_at')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-4 mt-2">
                <label>Asset Expired Date</label>
                <!-- <input id="datepickers" class="form-control form-control-sm" type="text" placeholder="Expired Date"> -->
                <input id="expired_date" type="text" class="form-control" placeholder="Expired Date" name="expired_date" value="{{ old('expired_date') }}">

            </div>
        </div>

        <div class="row m-lg-1">
            <div class="col-8 mt-2">
                <!-- Default input -->
                <label class="mb-2">Asset Status</label>

                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="status_id" name="status_id" required>

                    @foreach ($asset_status as $stat)
                    @if(old('status_id') == $stat->id)
                    <option value="<?= $stat->id; ?>" selected><?= $stat->asset_status_name; ?></option>
                    @else
                    <option value="<?= $stat->id; ?>"><?= $stat->asset_status_name; ?></option>
                    @endif
                    @endforeach
                </select>

            </div>
        </div>

        <div class="row m-lg-1">
            <div class="col-8 mt-2">
                <!-- Default input -->
                <label class="mb-2">Asset Location</label>

                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="location_id" name="location_id" required>

                    @foreach ($location as $loc)
                    @if(old('location_id')==$loc->id)
                    <option value="<?= $loc->id; ?>" selected><?= $loc->asset_HL_LL; ?>-<?= $loc->asset_loc_mp; ?>-<?= $loc->asset_loc_dkm; ?>- Room <?= $loc->asset_loc_dkm_room; ?></option>
                    @else
                    <option value="<?= $loc->id; ?>"><?= $loc->asset_HL_LL; ?>-<?= $loc->asset_loc_mp; ?>-<?= $loc->asset_loc_dkm; ?>- Room <?= $loc->asset_loc_dkm_room; ?></option>
                    @endif

                    @endforeach
                </select>

            </div>
        </div>

        <div class="row m-lg-1">
            <div class="col mt-2">
                <label>Please provide MIS Id, If any</label>

            </div>
        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->
            <div class="col-8 mt-1">
                <input type="number" class="form-control @error('mis_id') is-invalid @enderror" placeholder="Asset MIS Id" id="mis_id" name="mis_id" value="{{ old('mis_id') }}">
                @error('mis_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row m-lg-1">
            <div class="col-8 mt-3 mb-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>

    <input type="number" class="form-control" placeholder="Your Asset Price" id="asset_price" name="asset_price" hidden>

</form>


</div>
@endsection