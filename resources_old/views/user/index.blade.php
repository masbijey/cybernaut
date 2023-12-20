@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">User Administration</h1>
<p class="mb-4">user untuk akses ke aplikasi</p>

<div class="col">

    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal3">
        <i class='fas fa-plus'></i> New User
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModal3Label">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf

                        <h5 class="text-center bg-info text-white">login information</h5>
                        <table class="table">
                            <tr>
                                <td><label>Name</label></td>
                                <td><input type="text" class="form-control" name="name" required placeholder="fullname"></td>
                            </tr>
                            <tr>
                                <td><label>Email</label></td>
                                <td><input type="email" class="form-control" name="email" required placeholder="email"></td>
                            </tr>
                            <tr>
                                <td><label>Password</label></td>
                                <td><input type="password" class="form-control" name="password" required placeholder="password | min.6 character"></td>
                            </tr>
                        </table>

                        <h5 class="text-center bg-danger text-white">access definition</h5>
                        <table class="table table-sm py-3">
                            <th class="text-center">
                                Fitur
                            </th>
                            <th class="text-center">
                                Akses
                            </th>
                            <th class="text-center"> 
                                Keterangan
                            </th>
                            <tr>
                                <td class="w-25"><label for="Admin">User Management</label></td>
                                <td class="w-25"><input type="number" class="form-control-sm" name="admin" required></td>
                                <td><i>0 = no access, 1 = full access</i></td>
                            </tr>
                            <tr>
                                <td><label for="Admin">Signage</label></td>
                                <td class="w-25"><input type="number" class="form-control-sm" name="signage" required></td>
                                <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = special</i></td>
                
                            </tr>
                            <tr>
                                <td><label for="Admin">Workorder</label></td>
                                <td class="w-25"><input type="number" class="form-control-sm" name="workorder" required></td>
                                <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = approval, 4 = special </i></td>
                            </tr>
                            <tr>
                                <td><label for="Admin">Maintenance</label></td>
                                <td class="w-25"><input type="number" class="form-control-sm" name="maintenance" required></td>
                                <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = approval, 4 = special </i></td>
                            </tr>
                            <tr>
                                <td><label for="Admin">Asset</label></td>
                                <td class="w-25"><input type="number" class="form-control-sm" name="asset" required></td>
                                <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = approval, 4 = special </i></td>
                            </tr>
                            <tr>
                                <td><label for="Admin">Voucher</label></td>
                                <td class="w-25"><input type="number" class="form-control-sm" name="voucher" required></td>
                                <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = approval, 4 = special </i></td>
                            </tr>
                            <tr>
                                <td><label for="Admin">BEO</label></td>
                                <td class="w-25"><input type="number" class="form-control-sm" name="beo" required></td>
                                <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = approval, 4 = special </i></td>
                            </tr>
                            <tr>
                                <td><label for="Admin">HRIS</label></td>
                                <td class="w-25"><input type="number" class="form-control-sm" name="hris" required></td>
                                <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = approval, 4 = special </i></td>
                            </tr>
                            <tr>
                                <td><label for="Admin">Attendance</label></td>
                                <td class="w-25"><input type="number" class="form-control-sm" name="attendance" required></td>
                                <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = approval, 4 = special </i></td>
                            </tr>
                            <tr>
                                <td><label for="Admin">Leave</label></td>
                                <td class="w-25"><input type="number" class="form-control-sm" name="leave" required></td>
                                <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = approval, 4 = special </i></td>
                            </tr>
                        </table>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>

                            <button class="btn btn-dark" type="reset">Cancel</button>
                        </div>
                
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User List</h6>
        </div>
        <div class="card-body">
            <table class="table table-hover table-responsive-lg nowrap" id="pegawai-table">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td>{{ $user->name }}</td>
                        <td class="text-center">-- null --</td>
                        <td class="text-center">-- null --</td>
                        <td class="text-center">{{ $user->email }}</td>
                        <td class="text-center">
                            @if ($user->deleted_at == null)
                            <span class="badge badge-success">active</span>
                            @else
                            <span class="badge badge-danger">non-active</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="/user/show/{{ $user->id }}" class="btn btn-primary btn-sm" data-placement="top"
                                title="Tampilkan"><i class='fas fa-eye'></i></a>

                            @if ($user->deleted_at == null)
                            <a href="/user/delete/{{ $user->id }}" class="btn btn-danger btn-sm" data-placement="top"
                                title="Hapus"><i class='fas fa-trash'></i></a>
                            @else
                            <a href="/user/restore/{{ $user->id }}" class="btn btn-success btn-sm" data-placement="top"
                                title="aktifkan"><i class='fas fa-check'></i></a>
                            @endif
                        </td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection