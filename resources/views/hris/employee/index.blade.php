@extends('layouts.app')

@section('content')
<h1 class="h3 text-gray-800">Employee Management</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Employee Management</li>
    </ol>
</nav>

<div class="mt-3">
    <button type="button" class="btn mr-0 mb-0 d-inline-block">UPDATE : </button>

    <div class="btn-group shadow">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#" disabled>
            <i class='fas fa-plus'></i> New Employee
        </button>
        <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('contract.index') }}">» Contract</a>
            <a class="dropdown-item" href="{{ route('education.index') }}">» Education</a>
            <a class="dropdown-item" href="{{ route('experience.index') }}">» Experience</a>
            <a class="dropdown-item" href="{{ route('family.index') }}">» Family</a>
            <a class="dropdown-item" href="{{ route('leaveapproval.index') }}">» Leave Manager</a>
            <a class="dropdown-item" href="{{ route('rewpun.index') }}">» P&R</a>
            <a class="dropdown-item" href="{{ route('sickness.index') }}">» Sickness</a>
            <a class="dropdown-item" href="{{ route('training.index') }}">» Training</a>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="exampleModal3Label">Add Employee</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('employee.store') }}">
                    @csrf

                    <table class="table table-borderless">
                        <tr>
                            <td><label for="name">Nama</label></td>
                            <td><input type="text" class="form-control" id="name" name="name"></td>
                        </tr>
                        <tr>
                            <td><label for="gender">Jenis Kelamin</label></td>
                            <td><input type="text" class="form-control" id="gender" name="gender"></td>
                        </tr>
                        <tr>
                            <td><label for="npwp">NPWP</label></td>
                            <td><input type="number" class="form-control" id="npwp" name="npwp"></td>
                        </tr>
                        <tr>
                            <td><label for="nik">NIK</label></td>
                            <td><input type="number" class="form-control" id="nik" name="nik"></td>
                        </tr>
                        <tr>
                            <td><label for="religion">Agama</label></td>
                            <td><input type="text" class="form-control" id="religion" name="religion"></td>
                        </tr>
                        <tr>
                            <td><label for="bornplace">Tempat Lahir</label></td>
                            <td><input type="text" class="form-control" id="bornplace" name="bornplace"></td>
                        </tr>
                        <tr>
                            <td><label for="borndate">Tanggal Lahir</label></td>
                            <td><input type="date" class="form-control" id="borndate" name="borndate"></td>
                        </tr>
                        <tr>
                            <td><label for="status_perkawinan">Status Perkawinan</label></td>
                            <td><input type="text" class="form-control" id="status_perkawinan" name="status_perkawinan">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="address">Alamat</label></td>
                            <td><textarea class="form-control" name="address" id="" cols="30" rows="3"></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="phone">No. Handphone</label></td>
                            <td><input type="number" class="form-control" id="phone" name="phone"></td>
                        </tr>
                        <tr>
                            <td><label for="joindate">Tanggal bergabung</label></td>
                            <td><input type="date" class="form-control" id="joindate" name="joindate"></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td><input type="email" class="form-control" id="email" name="email"></td>
                        </tr>
                        <tr>
                            <td><label for="file">Photo</label></td>
                            <td>
                                <input type="file" name="file" id="file">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card mt-3 shadow-sm">
    <div class="card-body">
        <table class="table table-hover nowrap" id="employee-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Role</th>
                    <th>Level</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Join date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $user)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        <a href="{{ url('/employee/detail/'.$user->id) }}" class="" data-placement="top" title="Tampilkan">{{$user->name }}</a>
                    </td>
                    <td>
                        @if (!empty($user->contract->last()))
                        {{ $user->contract->last()->department->name }}
                        @else
                        <p class="text-danger text-italic">belum kontrak</p>
                        @endif
                    </td>
                    <td>
                        @if (!empty($user->contract->last()))
                        {{ $user->contract->last()->jobtitle }}
                        @else
                        <p class="text-danger text-italic">belum kontrak</p>
                        @endif
                    </td>
                    <td>
                        @if (!empty($user->contract->last()))
                        {{ $user->contract->last()->level }}
                        @else
                        <p class="text-danger text-italic">belum kontrak</p>
                        @endif
                    </td>
                    <td>
                        {{ $user->employee->phone }}
                    </td>
                    <td>
                        {{ $user->email  }}
                    </td>
                    <td>
                    </td>
                    <td>
                        {{ $user->joindate }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('css')

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#employee-table').DataTable({
            responsive: true
        });

    });
</script>
@endsection