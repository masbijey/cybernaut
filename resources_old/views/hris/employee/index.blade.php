@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Employee Management</h1>

<div class="mt-3">
    <button type="button" class="btn mr-0 mb-0 d-inline-block">UPDATE : </button>

    <div class="btn-group shadow">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal3">
            <i class='fas fa-plus'></i> New Employee
        </button>
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('agreement.index') }}">» Contract</a>
            <a class="dropdown-item" href="{{ route('education.index') }}">» Education</a>
            <a class="dropdown-item" href="{{ route('experience.index') }}">» Experience</a>
            <a class="dropdown-item" href="{{ route('family.index') }}">» Family</a>
            <a class="dropdown-item" href="{{ route('inventory.index') }}">» Inventory</a>
            <a class="dropdown-item" href="{{ route('leave.index') }}">» Leave</a>
            <a class="dropdown-item" href="{{ route('rewpun.index') }}">» P&R</a>
            <a class="dropdown-item" href="{{ route('sickness.index') }}">» Sickness</a>
            <a class="dropdown-item" href="{{ route('training.index') }}">» Training</a>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
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

<div class="card mt-3">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
    </div>
    <div class="card-body">
        <table class="table table-hover nowrap table-sm" id="employee-table">
            <thead class="thead-light text-center">
                <tr class="text-center">
                    <th>#</th>
                    <th>Name</th>
                    <th class="text-center">Department</th>
                    <th class="text-center">Job Title</th>
                    <th class="text-center">Level</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Join date</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employee as $employee)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td><a href="/employee/detail/{{ $employee->id }}" class="" data-placement="top" title="Tampilkan">{{
                            $employee->name }}</a></td>
                    <td class="text-center">
                        @if (!empty($employee->contract->last()))
                        {{ $employee->contract->last()->department->name }}
                        @else
                        <p class="text-danger text-italic">belum kontrak</p>
                        @endif
                    </td>
                    <td class="text-center">
                        @if (!empty($employee->contract->last()))
                        {{ $employee->contract->last()->jobtitle }}
                        @else
                        <p class="text-danger text-italic">belum kontrak</p>
                        @endif
                    </td>
                    <td class="text-center">
                        @if (!empty($employee->contract->last()))
                        {{ $employee->contract->last()->level }}
                        @else
                        <p class="text-danger text-italic">belum kontrak</p>
                        @endif
                    </td>
                    <td class="text-center">{{ $employee->phone }}</td>
                    <td class="text-center">{{ $employee->email }}</td>
                    <td class="text-center">
                        @if ($employee->status == 'active')
                        <span class="badge badge-success">active</span>
                        @else
                        <span class="badge badge-danger">non-active</span>
                        @endif
                    </td>
                    <td class="text-center">{{ $employee->joindate }}</td>
                    <td class="text-center">

                        <a href="/employee/detail/{{ $employee->id }}" class="btn btn-primary btn-sm d-sm-inline"
                            data-placement="top" title="Tampilkan"><i class='fas fa-eye'></i></a>

                        @if ($employee->status == 'active')
                        <a href="{{ route('employee.destroy', $employee->id) }}" class="btn btn-danger btn-sm d-sm-inline"
                            data-placement="top" title="Hapus">
                            <i class='fas fa-trash'></i>
                        </a>
                        @else
                        <a href="{{ route('employee.restore', $employee->id) }}" class="btn btn-success btn-sm d-sm-inline"
                            data-placement="top" title="aktifkan">
                            <i class='fas fa-check'></i>
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection

@section('css')
{{-- --}}
@endsection

@section('js')
<script>
    $(document).ready(function () {
    $('#employee-table').DataTable({
        responsive: true
    });
    
});

</script>
@endsection