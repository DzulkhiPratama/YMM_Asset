@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Approval Order to Asset</h1>
</div>
<!-- Grid row -->
<!-- karena menggunakan resource pada routes nya, gabungan /dashboard + method post pasti akan ke store -->
<form action="/transaction/{{ $transactions[0]->order_id }}" method="post">
    @method('put')
    @csrf
    <div class="card col-6 mb-3">
        <div class="row m-lg-1">
            <!-- Grid column -->

            <div class="col-8 mt-2">
                <!-- Default input -->
                <label class="mb-2">Order to Asset</label>

                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="asset_id" name="asset_id" disabled autofocus>

                    @foreach($assets as $ast)
                    @if(old('asset_id', $ast->asset_id)==$ast->asset_id)
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
                <label>Ordered By</label>
                <input class="form-control" id="order_user" name="order_user" disabled value="{{ $user_order->name }}"></input>
            </div>

        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->

            <div class="col-8 mt-2">
                <!-- Default input -->
                <label class="mb-2">Purpose in ordering Asset</label>

                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="purpose_id" name="purpose_id" disabled autofocus>

                    @foreach($purposes as $prp)
                    @if(old('purpose_id', $prp->id)==$prp->id)
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
                <input class="form-control @error('purpose_desc') is-invalid @enderror" id="purpose_desc" name="purpose_desc" disabled value="{{ old('purpose_desc',$transactions[0]->purpose_desc) }}"></input>
                @error('purpose_desc')
                <div class=" invalid-feedback">{{ $message }}
                </div>
                @enderror
            </div>

        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->
            <div class="col-4 mt-2">

                <label>Order At</label>
                <input id="order_at" type="text" class="form-control @error('order_at') is-invalid @enderror" placeholder="Return Date" name="order_at" disabled value="{{ old('order_at',$transactions[0]->order_at) }}">
                @error('order_at')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->
            <div class="col-4 mt-2">

                <label>Estimate Asset Return</label>
                <input id="estimate_return_at" type="text" class="form-control @error('estimate_return_at') is-invalid @enderror" placeholder="Return Date" name="estimate_return_at" disabled value="{{ old('estimate_return_at',$transactions[0]->estimate_return_at) }}">
                @error('estimate_return_at')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->
            <h5 class="mt-3">Approval Log</h5>


            @if(!empty($user_adm))
            <!-- Admin Cek sudah cek-->
            <div class="col-12 mt-3">
                <label id="adm_user_id" name="" value="" style="background-color: greenyellow;">Admin Check by {{ $user_adm->name }} at {{ $transactions[0]->adm_at }}</label>
            </div>
            <div class="col-10 mt-1">
                <label for="adm_note">Note:</label>
                <input type="text" id="adm_note" name="adm_note" class="form-control" placeholder="Note From Admin" disabled value="{{ $transactions[0]->adm_note }}">
            </div>

            @elseif(empty($user_adm) and empty($user_app) and empty($user_return[0]))
            <!-- Admin ketika belum cek Cek -->
            <div class="col-12 mt-3">
                <label id="" name="" value="">-->Waiting For Admin Check</label>
            </div>
            <div class="col-10 mt-1">
                <label for="adm_note">Note:</label>
                <input type="text" id="adm_note" name="adm_note" class="form-control" placeholder="Note From Admin" disabled value="">
            </div>

            @endif
            <!-- Admin ketika belum cek Cek -->


            <!-- who approval -->
            @if(!empty($user_app) && empty($user_disapp))
            <div class="col-12 mt-4">
                <label id="adm_user_id" name="" value="" style="background-color: greenyellow;">Approved by {{ $user_app->name }} at {{ $transactions[0]->app_at }}</label>
            </div>

            <div class="col-10 mt-1">
                <label for="app_note">Note:</label>
                <input type="text" id="app_note" name="app_note" class="form-control" placeholder="Note From Approval" disabled value="{{ $transactions[0]->app_note }}">
            </div>
            @elseif(empty($user_app) && !empty($user_disapp))
            <div class="col-12 mt-4">
                <label id="adm_user_id" name="" value="" style="background-color:orangered;">Disapproved by {{ $user_disapp->name }} at {{ $transactions[0]->disapp_at }}</label>
            </div>

            <div class="col-10 mt-1">
                <label for="app_note">Note:</label>
                <input type="text" id="app_note" name="app_note" class="form-control" placeholder="Note From Approval" disabled value="{{ $transactions[0]->disapp_note }}">
            </div>

            @else
            <div class="col-12 mt-4">
                <label id="" name="" value="">-->Waiting For Approval</label>
            </div>
            <div class="col-10 mt-1">
                <label for="app_note">Note:</label>
                <input type="text" id="app_note" name="app_note" class="form-control" placeholder="Note From Approval" value="" disabled>
            </div>
            @endif
            <!-- who approval -->

            <!-- returning -->
            @if(empty($user_return))
            <div class="col-12 mt-4">
                <label id="" name="" value="">-->Waiting For Returning</label>
            </div>
            <div class="col-10 mt-1">
                <label for="return_note">Note:</label>
                <input type="text" id="return_note" name="return_note" class="form-control" placeholder="Note From Admin" value="" disabled>
            </div>
            @elseif(!empty($user_return))
            <div class="col-12 mt-4">
                <label id="" name="" value="" style="background-color:greenyellow;">Received by {{ $user_return->name }} at {{ $transactions[0]->return_at }}</label>
            </div>
            <div class="col-10 mt-1">
                <label for="return_note">Note:</label>
                <input type="text" id="return_note" name="return_note" class="form-control" placeholder="Note From Admin" value="{{ $transactions[0]->return_note }}" disabled>
            </div>
            @endif
            <!--==================== batas show blade=============================== -->


        </div>

    </div>
</form>


</div>
@endsection