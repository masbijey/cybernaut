@extends('layouts.app')

@section('css')
<!--  -->
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#education-table').DataTable({
            responsive: true
        });
    });

    $(document).ready(function() {
        $('#experience-table').DataTable({
            responsive: true
        });
    });

    $(document).ready(function() {
        $('#family-table').DataTable({
            responsive: true
        });
    });
    $(document).ready(function() {
        $('#sickness-table').DataTable({
            responsive: true
        });
    });

    $(document).ready(function() {
        $('#contract-table').DataTable({
            responsive: true
        });
    });

    $(document).ready(function() {
        $('#punrew-table').DataTable({
            responsive: true
        });
    });

    $(document).ready(function() {
        $('#leaves-table').DataTable({
            responsive: true
        });
    });

    $(document).ready(function() {
        $('#inventory-table').DataTable({
            responsive: true
        });
    });

    $(document).ready(function() {
        $('#training-table').DataTable({
            responsive: true
        });
    });

    $(document).ready(function() {
        $('#attendance-table').DataTable({
            responsive: true
        });
    });

    $(document).ready(function() {
        $('#log-table').DataTable({
            responsive: true
        });
    });
</script>
@endsection

@section('title')
Employee details | {{ $employee->name }}
@endsection

@section('content')
<h3 class="h3 text-gray-800">{{ $employee->name }}</h3>
@if (!empty($role->jobtitle ))
<h5>{{ $role->jobtitle }} | {{ $role->level }}</h5>
@else
<p class="text-danger">belum kontrak</p>
@endif

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employee List</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $employee->name }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
        <div class="d-block d-sm-none d-md-none">
            <div class="card shadow-sm mb-3">
                <a href="#personal-card" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                    <h6 class="m-1 font-weight-bold">Personal Information</h6>
                </a>

                <div class="collapse" id="personal-card">
                    <div class="card-body">
                        <div class="mb-3 text-center">
                            <img src="https://yjmb.xjambi.com/kaizen/public//storage/asset/JjhsqBJeny50OqFolc20h9Vj5JrOzy7gJjSAymMz.jpg" class="img-fluid" alt="Responsive image" width="200px">
                        </div>

                        <table class="table ">
                            <tr>
                                <td class="font-weight-bolder">NIK</td>
                                <td>{{ $employee->nik}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">NAME</td>
                                <td>{{ $employee->name}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">BORN</td>
                                <td>{{ $employee->bornplace}}, {{ $employee->borndate}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">ADDRESS</td>
                                <td>{{ $employee->address}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">RELIGION</td>
                                <td>{{ $employee->religion}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">PHONE</td>
                                <td>{{ $employee->phone}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">EMAIL</td>
                                <td>{{ $employee->email }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">NPWP</td>
                                <td>{{ $employee->npwp }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-none d-sm-block">
            <div class="card shadow-sm mb-3">
                <a href="#personal-card" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                    <h6 class="m-1 font-weight-bold">Personal Information</h6>
                </a>

                <div class="collapse show" id="personal-card">
                    <div class="card-body">
                        <div class="mb-3 text-center">
                            <img src="https://yjmb.xjambi.com/kaizen/public//storage/asset/JjhsqBJeny50OqFolc20h9Vj5JrOzy7gJjSAymMz.jpg" class="img-fluid" alt="Responsive image" width="200px">
                        </div>

                        <table class="table table-sm">
                            <tr>
                                <td class="font-weight-bolder">NIK</td>
                                <td>{{ $employee->nik}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">NAME</td>
                                <td>{{ $employee->name}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">BORN</td>
                                <td>{{ $employee->bornplace}}, {{ $employee->borndate}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">ADDRESS</td>
                                <td>{{ $employee->address}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">RELIGION</td>
                                <td>{{ $employee->religion}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">PHONE</td>
                                <td>{{ $employee->phone}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">EMAIL</td>
                                <td>{{ $employee->email }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">NPWP</td>
                                <td>{{ $employee->npwp }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-8">
        <div class="card shadow-sm mb-3">
            <a href="#education-card" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Educations</h6>
            </a>

            <div class="collapse" id="education-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="education-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Institution</th>
                                    <th>Skill</th>
                                    <th>Period</th>
                                    <th>Remark</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($education as $data)
                                <tr>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->institution }}</td>
                                    <td>{{ $data->category }}</td>
                                    <td>{{ $data->start }} - {{ $data->end }}</td>
                                    <td>{{ $data->remark }}</td>
                                    <td><a class="btn btn-sm btn-outline-secondary" href="{{ url($data->file) }}">file</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <a href="#experience-card" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Experience</h6>
            </a>

            <div class="collapse" id="experience-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="experience-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Company</th>
                                    <th>Position</th>
                                    <th>Period</th>
                                    <th>Description</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($experience as $data)
                                <tr>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->company }}</td>
                                    <td>{{ $data->jobtitle }}</td>
                                    <td>{{ $data->start }} - {{ $data->end }}</td>
                                    <td>{{ $data->remark }}</td>
                                    <td><a class="btn btn-sm btn-outline-secondary" href="{{ url($data->file) }}">file</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <a href="#family-card" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Family</h6>
            </a>

            <div class="collapse" id="family-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="family-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Name</th>
                                    <th>Relationship</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <!-- <th>File</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($family as $data)
                                <tr>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->relationship }}</td>
                                    <td>{{ $data->phone }}</td>
                                    <td>{{ $data->address }}</td>
                                    <!-- <td><a class="btn btn-sm btn-outline-secondary" href="{{ url('public/'.$data->file) }}">file</a></td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <a href="#sickness-card" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Sickness History</h6>
            </a>

            <div class="collapse" id="sickness-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="sickness-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Name of Dissease</th>
                                    <th>Description</th>
                                    <th>Periode</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sickness as $data)
                                <tr>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->name_of_sick }}</td>
                                    <td>{{ $data->description }}</td>
                                    <td>{{ $data->start }} - {{ $data->end }}</td>
                                    <td><a class="btn btn-sm btn-outline-secondary" href="{{ url($data->file) }}">file</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <a href="#contract-card" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Contract</h6>
            </a>

            <div class="collapse" id="contract-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="contract-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Department</th>
                                    <th>Level</th>
                                    <th>Position</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contract as $data)
                                <tr>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->start }}</td>
                                    <td>{{ $data->end }}</td>
                                    <td>{{ $data->department->name }}</td>
                                    <td>{{ $data->level }}</td>
                                    <td>{{ $data->jobtitle }}</td>
                                    <td><a class="btn btn-sm btn-outline-secondary" href="{{ url($data->file) }}">file</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <a href="#pnr-card" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Punishment & Reward</h6>
            </a>

            <div class="collapse" id="pnr-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="punrew-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Institution</th>
                                    <th>Category</th>
                                    <th>Periode</th>
                                    <th>Description</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>test test test tes tes tes tes</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <a href="#leave-card" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Leaves History</h6>
            </a>

            <div class="collapse" id="leave-card">
                <div class="card-body">
                    <table class="table table-bordered" style="width: 30%;">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Entitle</th>
                                <th>Taken</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody class="nowrap">
                            <tr>
                                <td>Annual Leave</td>
                                <td>{{ $entitleAl }}</td>
                                <td>{{ $takenAl }}</td>
                                <td>
                                    @if ($balanceAl == '0')
                                    <h3 class="text-danger">{{ $balanceAl }}</h3>
                                    <p class="text-danger font-weight-bold"></p>
                                    @else
                                    <p class="text-success font-weight-bold">{{ $balanceAl }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Extra Off</td>
                                <td>{{ $entitleEo }}</td>
                                <td>{{ $takenEo }}</td>
                                <td>
                                    @if ($balanceEo == '0')
                                    <p class="text-danger font-weight-bold">{{ $balanceEo }}</p>
                                    @else
                                    <p class="text-success font-weight-bold">{{ $balanceEo }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Day Payment</td>
                                <td>{{ $entitlePh }}</td>
                                <td>{{ $takenPh }}</td>
                                <td>
                                    @if ($balancePh == '0')
                                    <p class="text-danger font-weight-bold">{{ $balancePh }}</p>
                                    @else
                                    <p class="text-success font-weight-bold">{{ $balancePh }}</p>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="leaves-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Type</th>
                                    <th>Valid date</th>
                                    <th>Pick date</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employee->leave as $data)
                                <tr>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        @if ($data->type == 'public_holiday')
                                        <button class="btn btn-sm btn-success">PH</button>
                                        @elseif ($data->type == 'extra_off')
                                        <button class="btn btn-sm btn-success">EO</button>
                                        @elseif ($data->type == 'annual_leave')
                                        <button class="btn btn-sm btn-success">AL</button>
                                        @elseif ($data->type == 'sick_off')
                                        <button class="btn btn-sm btn-danger">SICK</button>
                                        @endif
                                    </td>
                                    <td>{{ $data->valid_until }}</td>
                                    <td>
                                        @if ($data->pick_date == null)
                                        <span class="badge badge-success badge-sm">belum diambil</span>
                                        @else
                                        <span class="badge badge-danger badge-sm">{{ $data->pick_date }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $data->description }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <a href="#inventory-card" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Inventory</h6>
            </a>

            <div class="collapse" id="inventory-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="inventory-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Asset</th>
                                    <th>Condition</th>
                                    <th>Remark</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inventory as $data)
                                <tr>
                                    <td>{{ $data->created_at }}</td>
                                    <td><a href="{{ url('asset/detail/'. $data->asset->token) }}">{{ $data->asset->name }} {{ $data->asset->serialNumber }}</a></td>
                                    <td>@if ($data->condition == 'Good')
                                        <span class="badge badge-success">{{ $data->condition }}</span>
                                        @else
                                        <span class="badge badge-danger">{{ $data->condition }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $data->remark }}</td>
                                    <td>{{ $data->end }}
                                        @if ($data->return_date === null)
                                        <a href="{{ url('asset/allocation/'.$data->asset->token) }}" class="btn btn-sm btn-primary">Move Now</a>
                                        @else
                                        <a href="#" class="btn btn-sm btn-primary disabled">Moved: {{ $data->return_date }}</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <a href="#training-card" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Training</h6>
            </a>

            <div class="collapse" id="training-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="training-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Institution</th>
                                    <th>Category</th>
                                    <th>Periode</th>
                                    <th>Description</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>test test test tes tes tes tes</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <a href="#attendance-card" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Attendance</h6>
            </a>

            <div class="collapse" id="attendance-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="attendance-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Institution</th>
                                    <th>Category</th>
                                    <th>Periode</th>
                                    <th>Description</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>test test test tes tes tes tes</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <a href="#log-card" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Log</h6>
            </a>

            <div class="collapse" id="log-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="log-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Institution</th>
                                    <th>Category</th>
                                    <th>Periode</th>
                                    <th>Description</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>test test test tes tes tes tes</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection