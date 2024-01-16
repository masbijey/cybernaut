@extends('layouts.app')

@section('css')

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
            <div class="card shadow mb-3">
                <a href="#personal-card" class="d-block card-header bg-primary text-light" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                    <h6 class="m-1 font-weight-bold">Personal Information</h6>
                </a>

                <div class="collapse" id="personal-card">
                    <div class="card-body">
                        <div class="mb-3 text-center">
                            <img src="https://source.unsplash.com/K4mSJ7kc0As/600x800" class="img-fluid" alt="Responsive image" width="200px">
                        </div>

                        <table class="table table-sm">
                            <tr>
                                <td class="font-weight-bolder">NIK</td>
                                <td>{{ $employee->nik}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">Name</td>
                                <td>{{ $employee->name}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">Born</td>
                                <td>{{ $employee->bornplace}}, {{ $employee->borndate}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">Address</td>
                                <td>{{ $employee->address}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">Religion</td>
                                <td>{{ $employee->religion}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">Phone</td>
                                <td>{{ $employee->phone}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">Email</td>
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
            <div class="card shadow mb-3">
                <a href="#personal-card" class="d-block card-header bg-primary text-light" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                    <h6 class="m-1 font-weight-bold">Personal Information</h6>
                </a>

                <div class="collapse show" id="personal-card">
                    <div class="card-body">
                        <div class="mb-3 text-center">
                            <img src="https://source.unsplash.com/K4mSJ7kc0As/600x800" class="img-fluid" alt="Responsive image" width="200px">
                        </div>

                        <table class="table table-sm">
                            <tr>
                                <td class="font-weight-bolder">NIK</td>
                                <td>{{ $employee->nik}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">Name</td>
                                <td>{{ $employee->name}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">Born</td>
                                <td>{{ $employee->bornplace}}, {{ $employee->borndate}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">Address</td>
                                <td>{{ $employee->address}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">Religion</td>
                                <td>{{ $employee->religion}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">Phone</td>
                                <td>{{ $employee->phone}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bolder">Email</td>
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
        <div class="card shadow mb-3">
            <a href="#education-card" class="d-block card-header bg-primary text-light" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Educations</h6>
            </a>

            <div class="collapse" id="education-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="detail-table" style="width: 100%;">
                            <thead class="text-nowrap">
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

        <div class="card shadow mb-3">
            <a href="#experience-card" class="d-block card-header bg-primary text-light" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Experience</h6>
            </a>

            <div class="collapse" id="experience-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="detail-experience" style="width: 100%;">
                            <thead class="text-nowrap">
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

        <div class="card shadow mb-3">
            <a href="#family-card" class="d-block card-header bg-primary text-light" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Family</h6>
            </a>

            <div class="collapse" id="family-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-nowrap">
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

        <div class="card shadow mb-3">
            <a href="#sickness-card" class="d-block card-header bg-primary text-light" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Sickness</h6>
            </a>

            <div class="collapse" id="sickness-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-nowrap">
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

        <div class="card shadow mb-3">
            <a href="#contract-card" class="d-block card-header bg-primary text-light" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Contract</h6>
            </a>

            <div class="collapse" id="contract-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-nowrap">
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

        <div class="card shadow mb-3">
            <a href="#pnr-card" class="d-block card-header bg-primary text-light" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Punishment & Reward</h6>
            </a>

            <div class="collapse" id="pnr-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-nowrap">
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

        <div class="card shadow mb-3">
            <a href="#leave-card" class="d-block card-header bg-primary text-light" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Leaves History</h6>
            </a>

            <div class="collapse" id="leave-card">
                <div class="card-body">
                    <table class="table table-sm table-bordered" style="width: 30%;">
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
                        <table class="table">
                            <thead class="text-nowrap">
                                <tr>
                                    <th>Created At</th>
                                    <th>Type</th>
                                    <th>Valid date</th>
                                    <th>Pick date</th>
                                    <th>Description</th>
                                    <th>Leader Approved</th>
                                    <th>HR Approved</th>
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
                                    <td>{{ \Carbon\Carbon::parse($data->valid_until)->format('d/m/y') }}</td>
                                    <td>
                                        @if ($data->pick_date == null)
                                        <span class="badge badge-success badge-sm">belum diambil</span>
                                        @else
                                        <span class="badge badge-danger badge-sm">{{
                                \Carbon\Carbon::parse($data->pick_date)->format('d/m/y') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $data->description }}</td>
                                    <td>null</td>
                                    <td>null</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-3">
            <a href="#inventory-card" class="d-block card-header bg-primary text-light" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Inventory</h6>
            </a>

            <div class="collapse" id="inventory-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-nowrap">
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

        <div class="card shadow mb-3">
            <a href="#training-card" class="d-block card-header bg-primary text-light" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Training</h6>
            </a>

            <div class="collapse" id="training-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-nowrap">
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

        <div class="card shadow mb-3">
            <a href="#attendance-card" class="d-block card-header bg-primary text-light" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Attendance</h6>
            </a>

            <div class="collapse" id="attendance-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-nowrap">
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

        <div class="card shadow mb-3">
            <a href="#log-card" class="d-block card-header bg-primary text-light" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold">Log</h6>
            </a>

            <div class="collapse" id="log-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-nowrap">
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
    @endsection

    @section('css')

    @endsection

    @section('js')
    <script>
        $(document).ready(function() {
            $('#detail-table').DataTable({
                responsive: true
            });

        });

        $(document).ready(function() {
            $('#detail-experience').DataTable({
                responsive: true
            });

        });
    </script>

    @endsection