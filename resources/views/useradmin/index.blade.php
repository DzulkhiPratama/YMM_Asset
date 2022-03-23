@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">YMM PT FI Assets Users</h1>
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
    <div class="card-header">User List</div>
    <div class="card-body">
        @auth
        @if ( auth()->user()->role_id >= 1)
        <a href="/admin/create" class="btn btn-primary mb-3">Add User +</a>
        @endif
        @endauth

        <table id="apporderlist" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>User DKM</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $usr)

                <tr>
                    <td><?= $usr->userid ?></td>
                    <td><?= $usr->name; ?></td>
                    <td><?= $usr->email; ?></td>
                    <td><?= $usr->loc_dkm; ?></td>
                    <td><?= $usr->roles_type_name; ?></td>
                    <td>
                        @auth
                        @if (auth()->user()->role_id >= 2)
                        <a href="/admin/{{ $usr->userid }}/edit" class="badge bg-info"><span data-feather="edit"></span></a>

                        <form action="/admin/{{ $usr->userid }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf

                            <button href="" class="badge bg-warning border-0" onclick="return confirm('Want to delete this order?')"><span data-feather="trash-2"></span></button>
                        </form>

                        @else
                        <!-- nothing to show when not adm -->

                        @endif

                        <!-- bila tidak log in -->
                        @else

                        @endauth
                    </td>
                </tr>

                @endforeach
            </tbody>

        </table>


    </div>
</div>

@endsection