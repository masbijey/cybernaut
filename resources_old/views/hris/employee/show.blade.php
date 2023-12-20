@extends('layouts.app')

@section('content')
<div class="bg-light">
    <h1 class="h3 mb-2">{{ $employee->name }}</h1>
    <p class="my-1">
        @if (!empty($role->jobtitle ))
    <h5>{{ $role->jobtitle }} | {{ $role->level }}</h5>
    @else
    <p class="text-danger">belum kontrak</p>
    @endif
    </p>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Employee Details</h6>
    </div>

    <div class="card-body">
        <div class="form-group">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#profile" data-placement="top"
                        title="Summary profile">
                        Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#journey" data-placement="top" title="Journey">
                        <i class='fas fa-user-secret'></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#leave" data-placement="top" title="Leave">
                        <i class='fas fa-child'></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#inventory" data-placement="top" title="Inventory">
                        <i class='fas fa-biking'></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#training" data-placement="top" title="Training">
                        <i class='fas fa-user-graduate'></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#log" data-placement="top" title="Log">
                        <i class='fas fa-list'></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#attendance" data-placement="top" title="Attendance">
                        <i class='fas fa-user-clock'></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <div class="tab-pane active" id="profile">
                <div class="row">
                    <div class="col-md-8 order-sm-2 order-md-1">
                        <table class="table table-borderless">
                            <tr>
                                <td>NIK</td>
                                <td><input type="text" class="form-control" value="{{ $employee->nik}}" disabled></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td><input type="text" class="form-control" value="{{ $employee->name}}" disabled></td>
                            </tr>
                            <tr>
                                <td>Born</td>
                                <td><input type="text" class="form-control" value="{{ $employee->bornplace}}, {{ $employee->borndate}}" disabled></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td><input type="text" class="form-control" value="{{ $employee->address}}" disabled></td>
                            </tr>
                            <tr>
                                <td>Religion</td>
                                <td><input type="text" class="form-control" value="{{ $employee->religion}}" disabled></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td><input type="text" class="form-control" value="{{ $employee->phone}}" disabled></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><input type="text" class="form-control" value="{{ $employee->email }}" disabled></td>
                            </tr>
                            <tr>
                                <td>NPWP</td>
                                <td><input type="text" class="form-control" value="{{ $employee->npwp }}" disabled></td>
                            </tr>
                        </table>        
                    </div>
                    <div class="col-md-4 text-center order-sm-1 order-md-1 py-3">
                        <img src="https://source.unsplash.com/K4mSJ7kc0As/600x800" alt="" width="50%">
                        <p class="py-3">{{ $employee->name}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Education</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-responsive-sm table-sm" id="edu-table">
                                    <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Institution</th>
                                            <th>Skill</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Description</th>
                                            <th>File</th>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach($employee->education as $edu)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $edu->institution }}
                                            </td>
                                            <td>{{ $edu->category }}</td>
                                            <td>{{ \Carbon\Carbon::parse($edu->start)->format('d/m/y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($edu->end)->format('d/m/y') }}</td>
                                            <td>{{ $edu->description }}</td>
                                            <td>
                                                <a href="{{ $edu->file }}" class="btn btn-primary btn-sm"
                                                    target="_blank">
                                                    <i class='far fa-eye'></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Experience</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-responsive-sm table-sm">
                                    <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Company</th>
                                            <th>Job title</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Description</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employee->experience as $exp)
                                        <tr class="text-center">
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $exp->company }}
                                            </td>
                                            <td>{{ $exp->jobtitle }}</td>
                                            <td>{{ \Carbon\Carbon::parse($edu->start)->format('d/m/y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($edu->end)->format('d/m/y') }}</td>
                                            <td>{{ $exp->description }}</td>
                                            <td>
                                                <a href="{{ $exp->file }}" class="btn btn-primary btn-sm"
                                                    target="_blank">
                                                    <i class='far fa-eye'></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Family</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-responsive-sm table-sm">
                                    <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employee->family as $fml)
                                        <tr class="text-center">
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $fml->name }}
                                            </td>
                                            <td>{{ $fml->address }}</td>
                                            <td>{{ $fml->status }}</td>
                                            <td>
                                                <a href="http://wa.me/{{ $fml->phone }}" target="_blank">{{ $fml->phone
                                                    }}</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Sickness</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-responsive-sm table-sm">
                                    <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Disease name</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employee->sickness as $sick)
                                        <tr class="text-center">
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $sick->name }}
                                            </td>
                                            <td>
                                                {{ $sick->description }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="journey">
                <div class="col-md-5">
                    <table class="table table-borderless">
                        <tr>
                            <td>Employee number</td>
                            <td><input type="text" class="form-control" disabled value="{{ $employee->nip }}"></td>
                        </tr>
                        <tr>
                            <td>Join date</td>
                            <td><input type="text" class="form-control" disabled value="{{ $employee->joindate }}"></td>
                        </tr>
                    </table>
                </div>

                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Contract</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-responsive-sm table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Department</th>
                                    <th>Jobtitle</th>
                                    <th>Level</th>
                                    <th>Description</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            @foreach($employee->contract as $crt)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($crt->start)->format('d/m/y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($crt->end)->format('d/m/y') }}</td>
                                <td>{{ $crt->department->name }}</td>
                                <td>{{ $crt->jobtitle }}</td>
                                <td>{{ $crt->level }}</td>
                                <td>{{ $crt->description }}</td>
                                <td><a href="{{ $crt->file }}" class="btn btn-primary btn-sm" target="_blank"><i
                                            class='far fa-eye'></i></a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Punishment & Reward</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-responsive-sm table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th class="font-weight-bold">#</th>
                                    <th>Type</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Description</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($employee->rewpun as $data)
                                <tr>
                                    <td class="text-center font-weight-bold">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        @if ($data->type == 'Reward')
                                        <span class="badge badge-success">Reward</span>
                                        @else
                                        <span class="badge badge-danger">Pusnishment</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($data->start)->format('d/m/y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->end)->format('d/m/y') }}</td>
                                    <td>{{ $data->description }}</td>
                                    <td><a href="{{ $data->file }}" class="btn btn-primary btn-sm" target="_blank"><i
                                                class='far fa-eye'></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="leave">
                <table class="table table-bordered table-responsive" style="border: none;">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Entitle</th>
                            <th>Taken</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Annual Leave</td>
                            <td class="text-center">{{ $entitleAl }}</td>
                            <td class="text-center">{{ $takenAl }}</td>
                            <td class="text-center">
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
                            <td class="text-center">{{ $entitleEo }}</td>
                            <td class="text-center">{{ $takenEo }}</td>
                            <td class="text-center">
                                @if ($balanceEo == '0')
                                    <p class="text-danger font-weight-bold">{{ $balanceEo }}</p>
                                @else 
                                    <p class="text-success font-weight-bold">{{ $balanceEo }}</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Day Payment</td>
                            <td class="text-center">{{ $entitlePh }}</td>
                            <td class="text-center">{{ $takenPh }}</td>
                            <td class="text-center">
                                @if ($balancePh == '0')
                                    <p class="text-danger font-weight-bold">{{ $balancePh }}</p>
                                @else 
                                    <p class="text-success font-weight-bold">{{ $balancePh }}</p>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">History of Leave</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-responsive-sm table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Created At</th>
                                    <th>Type</th>
                                    <th>Valid</th>
                                    <th>Pick</th>
                                    <th>Description</th>
                                    <th>Request form</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employee->leave as $data)
                                <tr class="text-center">
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/y') }}</td>
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
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="inventory">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Inventory</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-responsive-sm table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Created At</th>
                                    <th>Return</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($employee->inventory as $inv)
                                <tr class="text-center">
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $inv->start }}
                                    </td>
                                    <td>
                                        {{ $inv->end }}
                                    </td>
                                    <td>
                                        {{ $inv->description }}
                                    </td>
                                    <td>
                                        @if ($inv->end == null)
                                        <span class="badge badge-info">Belum dikembalikan</span>
                                        @else
                                        <span class="badge badge-success">Sudah dikembalikan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ $inv->file }}" target="_blank" class="btn btn-primary btn-sm">file</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm">return now</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="training">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Training</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-responsive-sm table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Duration</th>
                                    <th>Title</th>
                                    <th>Trainer</th>
                                    <th>Venue</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employee->training as $learn)
                                <tr class="text-center">
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $learn->start }}
                                    </td>
                                    <td>
                                        {{ $learn->end }}
                                    </td>
                                    <td>
                                        {{ $learn->duration }}
                                    </td>
                                    <td>
                                        {{ $learn->description }}
                                    </td>
                                    <td>
                                        {{ $learn->trainer }}
                                    </td>
                                    <td>
                                        {{ $learn->venue }}
                                    </td>
                                    <td>
                                        <a href="{{ $learn->file }}" target="_blank">file</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="log">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Log</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-responsive-sm table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th>Date</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="attendance">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Attendance</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-responsive-sm table-sm">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td>07/03/2023</td>
                                            <td>08:30 AM</td>
                                            <td><span class="badge badge-primary">Check-In</span></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td>07/03/2023</td>
                                            <td>17:30 PM</td>
                                            <td><span class="badge badge-primary">Check-In</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Canteen</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-responsive-sm table-sm">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td>07/03/2023</td>
                                            <td>08:30 AM</td>
                                            <td><span class="badge badge-primary">Check-In</span></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td>07/03/2023</td>
                                            <td>17:30 PM</td>
                                            <td><span class="badge badge-primary">Check-In</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
{{--  --}}
@endsection

@section('js')
<script>
    $("#employee").select2({
        theme: 'bootstrap'
    });

    $("#department").select2({
        theme: 'bootstrap'
    });

    $(document).ready(function () {
        $('#rewpun').DataTable({
            responsive: true
        });
    });


</script>
@endsection