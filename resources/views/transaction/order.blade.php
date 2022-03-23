@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add Order to Asset</h1>
</div>
<!-- Grid row -->
<!-- karena menggunakan resource pada routes nya, gabungan /dashboard + method post pasti akan ke store -->

<form action="/transaction" method="post">
    @csrf
    <div class="card col-6 mb-3">
        <div class="card-header">Please Fill Form</div>
        <div class="row m-lg-1">
            <!-- Grid column -->

            <div class="col-8 mt-2">
                <!-- Default input -->
                <label class="mb-2">Available Asset can be Ordered</label>

                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="asset_id" name="asset_id" required autofocus>

                    @foreach($assets as $ast)
                    @if(old('asset_id')==$ast->asset_id)
                    <option value="<?= $ast->asset_id; ?>" selected><?= $ast->asset_name; ?></option>
                    @else
                    <option value="<?= $ast->asset_id; ?>"><?= $ast->asset_name; ?></option>
                    @endif
                    @endforeach
                </select>

            </div>

        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->

            <div class="col-8 mt-2">
                <!-- Default input -->
                <label class="mb-2">Purpose in ordering Asset</label>

                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="purpose_id" name="purpose_id" required autofocus>

                    @foreach($purposes as $prp)
                    @if(old('purpose_id')==$prp->id)
                    <option value="<?= $prp->id; ?>" selected><?= $prp->purpose_name; ?></option>
                    @else
                    <option value="<?= $prp->id; ?>"><?= $prp->purpose_name; ?></option>
                    @endif
                    @endforeach
                </select>

            </div>

        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->
            <div class="col-8 mt-2">
                <label>Purpose Detail</label>
                <input class="form-control @error('purpose_desc') is-invalid @enderror" id="purpose_desc" name="purpose_desc" required value="{{ old('purpose_desc') }}"></input>
                @error('purpose_desc')
                <div class=" invalid-feedback">{{ $message }}
                </div>
                @enderror
            </div>

        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->
            <div class="col-4 mt-2">

                <label>Estimate Asset Return</label>
                <input id="estimate_return_at" type="text" class="form-control @error('estimate_return_at') is-invalid @enderror" placeholder="Return Date" name="estimate_return_at" required value="{{ old('estimate_return_at') }}">
                @error('estimate_return_at')
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
</form>


</div>
@endsection