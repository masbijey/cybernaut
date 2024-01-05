@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">User Administration</h1>
<p class="mb-4">user untuk akses ke aplikasi</p>

<div class="col-sm-12 col-md-12 col-lg-7">

    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal3">
        <i class='fas fa-plus'></i> New User
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title" id="exampleModal3Label">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="fullname">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="email">
                        </div>

                        <div class="form-group">
                            <label for="password">Email</label>
                            <input type="password" class="form-control" id="password" name="password" required placeholder="password">
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

    <div class="card mt-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User List</h6>
        </div>
        <div class="card-body">
            <table class="table table-hover" id="pegawai-table">
                <thead class="thead-light">
                    <tr>
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
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>-- null --</td>
                        <td>-- null --</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->deleted_at == null)
                            <span class="badge badge-success">active</span>
                            @else
                            <span class="badge badge-danger">non-active</span>
                            @endif
                        </td>
                        <td>
                            <a href="/user/show/{{ $user->id }}" class="btn btn-sm" data-placement="top" title="Tampilkan"><i class='fas fa-eye'></i></a>

                            @if ($user->deleted_at == null)
                            <a href="/user/delete/{{ $user->id }}" class="btn btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                            @else
                            <a href="/user/restore/{{ $user->id }}" class="btn btn-sm" data-placement="top" title="aktifkan"><i class='fas fa-check'></i></a>
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