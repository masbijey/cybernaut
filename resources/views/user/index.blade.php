@extends('layouts.app')

@section('content')
<h1 class="h3 text-gray-800">User Management</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">User Management</li>
    </ol>
</nav>

<div class="col-sm-12 col-md-12 col-lg-12">

    <button type="button" class="btn btn-primary shadow mb-3" data-toggle="modal" data-target="#exampleModal3">
        <i class='fas fa-plus'></i> New User
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary text-light">
                    <h5 class="modal-title" id="exampleModal3Label">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('user.store') }}" autocomplete="off">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="font-weight-bolder">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="" placeholder="fullname" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="font-weight-bolder">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="" placeholder="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password" class="font-weight-bolder">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="" placeholder="password" autocomplete="new-password" required>
                        </div>

                        <div class="form-group">
                            <label for="joindate" class="font-weight-bolder">Join Date</label>
                            <input type="date" class="form-control" id="joindate" name="joindate" value="" placeholder="joindate" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User List</h6>
        </div>
        <div class="card-body">
            <table class="table table-hover nowrap" id="pegawai-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Join Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->joinDate }}</td>
                        <td>
                            @if ($user->deleted_at == null)
                            <span class="badge badge-success">active</span>
                            @else
                            <span class="badge badge-danger">non-active</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('/user/show/'.$user->id) }}" class="btn btn-sm" data-placement="top" title="Tampilkan"><i class='fas fa-eye'></i></a>

                            @if ($user->deleted_at == null)
                            <a href="{{ url('/user/delete/'.$user->id) }}" class="btn btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                            @else
                            <a href="{{ url('/user/restore/'.$user->id) }}" class="btn btn-sm" data-placement="top" title="aktifkan"><i class='fas fa-check'></i></a>
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

@section('js')
<script>
    $(document).ready(function() {
        $('#pegawai-table').DataTable({
            responsive: true
        });
    });
</script>
@endsection