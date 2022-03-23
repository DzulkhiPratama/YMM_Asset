@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add User</h1>
</div>
<!-- Grid row -->
<!-- karena menggunakan resource pada routes nya, gabungan /dashboard + method post pasti akan ke store -->

<form action="/admin/{{ $user[0]->userid }}" method="post">
    @method('put')
    @csrf
    <div class="card col-6 mb-3">
        <div class="card-header">Please Fill Form</div>
        <div class="row m-lg-1">
            <!-- Grid column -->

            <div class="col-8 mt-2">
                <!-- Default input -->
                <!-- <label for="name">Full Name</label> -->
                <input type="checkbox" id="cgfullname" name="cgfullname" value="Yes">Change Full Name</input>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror mb-2" id="name" placeholder="name" required value="{{ old('name', $user[0]->name) }}" disabled>

                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->
            <div class="col-8 mt-2">
                <!-- Default input -->
                <input type="checkbox" id="cgemail" name="cgemail" value="Yes">Change Email Address</input>
                <input type="email" name="email" class="form-control mb-2" id="email" placeholder="name@example.com" required value="{{ old('email', $user[0]->email) }}" disabled>
            </div>
        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->
            <div class="col-8 mt-2">
                <input type="checkbox" id="cgpass" name="cgpass" value="Yes">Change Account Password</input>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror mb-2" id="password" placeholder="Password" required disabled>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->
            <div class="col-8 mt-2">
                <input type="checkbox" id="cguserid" name="cguserid" value="Yes">Change Account ID</input>
                <input type="number" name="userid" class="form-control @error('userid') is-invalid @enderror mb-2" id="userid" placeholder="FI User ID" required value="{{ old('userid', $user[0]->userid) }}" disabled>
                @error('userid')
                <div class=" alert alert-danger">{{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->
            <div class="col-8 mt-2">
                <label class="mb-2 mt-3">Which role will be assigned to this User ?</label>

                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="role_id" name="role_id" required>
                    @foreach ($roles as $role)
                    @if(old('role_id',$user[0]->role_id) == $role->id)
                    <option value="<?= $role->id; ?>" selected><?= $role->roles_type_name; ?></option>
                    @else
                    <option value="<?= $role->id; ?>"><?= $role->roles_type_name; ?></option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row m-lg-1">
            <!-- Grid column -->
            <div class="col-8 mt-2">
                <label class="mb-2 mt-3">Which DKM you want to join with ?</label>

                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="location_id" name="location_id" required>
                    @foreach ($location as $loc)
                    <option value="<?= $loc->asset_HL_LL; ?>-<?= $loc->asset_loc_mp; ?>-<?= $loc->asset_loc_dkm; ?>"><?= $loc->asset_HL_LL; ?>-<?= $loc->asset_loc_mp; ?>-<?= $loc->asset_loc_dkm; ?></option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row m-lg-1">
            <div class="col-8 mt-3 mb-2">
                <button type="submit" class="btn btn-primary">Update User</button>
            </div>
        </div>
    </div>
</form>


</div>
@endsection