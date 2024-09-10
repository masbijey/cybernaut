@extends('layouts.app')

@section('title')
Leave Management
@endsection

@section('content')
<h1 class="h3 text-gray-800">Leave Management</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Leave Management</li>
    </ol>
</nav>

<div class="mb-3">
    @php
    $userRole = Auth::user()->role->hris;
    @endphp

    <button type="button" class="btn btn-primary shadow btn-sm"
        data-toggle="modal"
        data-target="#leaveForm"
        @if(!in_array($userRole, [2,3,4,5])) disabled @endif>
        <i class='fas fa-plus'></i> Form Request
    </button>

    <div class="modal" id="leaveForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('leaveapproval.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Leave Form Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="start_date" class="font-weight-bold">Start date:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="end_date" class="font-weight-bold">End date:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="work_date" class="font-weight-bold">Work date:</label>
                            <input type="date" id="work_date" name="work_date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="totalDays" class="font-weight-bold">Total Days:</label>
                            <input type="text" id="totalDays" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Your leave:</label>
                            <table class="table table-hover table-sm">
                                <thead class="table-dark">
                                    <th class="text-center">Check</th>
                                    <th>Expired</th>
                                    <th>Type</th>
                                    <th>Remark</th>
                                </thead>
                                <tbody>
                                    @foreach ($leave_data as $data)
                                    <tr>
                                        <td class="text-center">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="{{ $data->id }}" value="{{ $data->id }}" name="leave_ids[]">
                                                <label for="{{ $data->id }}" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($data->valid_until)->format('d/m/y') }}</td>
                                        <td>
                                            @if ($data->type == 'public_holiday')
                                            <span class="badge badge-success">PH</span>
                                            @elseif ($data->type == 'extra_off')
                                            <span class="badge badge-success">EO</span>
                                            @elseif ($data->type == 'annual_leave')
                                            <span class="badge badge-success">AL</span>
                                            @elseif ($data->type == 'sick_off')
                                            <span class="badge badge-danger">SICK</span>
                                            @endif
                                        </td>
                                        <td>{{ $data->description }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group">
                            <label for="reason" class="font-weight-bold">Reason:</label>
                            <textarea name="remark" id="reason" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="Reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary shadow btn-sm"
        data-toggle="modal"
        data-target="#addleave"
        @if(!in_array($userRole, [4,5])) disabled @endif>
        <i class='fas fa-plus'></i> New Leave
    </button>

    <div class="modal" id="addleave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('leave.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Leave - HR Only</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="font-weight-bolder">Employee</label>
                            <select class="custom-select" id="select-employee" name="employee" style="width: 100%;">
                                <option value="" selected>Select a employee:</option>
                                @foreach ($employee as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type" class="font-weight-bolder">Type</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio1" name="type" class="custom-control-input"
                                    value="annual_leave">
                                <label class="custom-control-label" for="customRadio1">Annual Leave</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio2" name="type" class="custom-control-input"
                                    value="public_holiday">
                                <label class="custom-control-label" for="customRadio2">Day Payment</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio3" name="type" class="custom-control-input"
                                    value="extra_off">
                                <label class="custom-control-label" for="customRadio3">Extra Off</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="entitled" class="font-weight-bolder">Entitled</label>
                            <input type="number" name="entitled" id="entitled" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="valid_until" class="font-weight-bolder">Valid until</label>
                            <input type="date" name="valid_until" id="valid_until" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="description" class="font-weight-bolder">Remark</label>
                            <input type="text" name="description" id="description" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="Reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <a href="{{ route('leavedata.index') }}"
        class="btn btn-primary btn-sm @if(!in_array($userRole, [3,4,5])) disabled @endif">
        <i class='fas fa-list'></i> Leaves Data
    </a>

    <a href="{{ route('leaveapproval.index') }}"
        class="btn btn-primary btn-sm @if(!in_array($userRole, [3,4,5])) disabled @endif">
        <i class='fas fa-sign'></i> Approval
    </a>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                            Annual Leave
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $al }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-success text-uppercase mb-1">
                            Extra Off
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $eo }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-info text-uppercase mb-1">
                            Day Payment
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $dp }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                            Total Off Day</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $al }} / {{ $al }}</div>
                            </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card mb-3 shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Leave Form History</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover table-sm" id="history-table" style="width: 100%;">
                    <thead>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Work Date</th>
                        <th>Leader Approval (1)</th>
                        <th>Leader Approval (2)</th>
                        <th>HR Approval</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($history as $history)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($history->start_date)->format('d-m-Y') }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($history->end_date)->format('d-m-Y') }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($history->work_date)->format('d-m-Y') }}
                            </td>
                            <td class="text-center">
                                @if ($history->approved_1_by == null )
                                <span class="badge badge-warning">waiting</span>
                                @elseif ($history->approved_1_status == 'approved')
                                <span class="badge badge-success">{{ $history->approved_1_status }}</span>
                                @else ($history->approved_1_status == 'rejected')
                                <span class="badge badge-danger">{{ $history->approved_1_status }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($history->approved_2_by == null )
                                <span class="badge badge-warning">waiting</span>
                                @elseif ($history->approved_2_status == 'approved')
                                <span class="badge badge-success">{{ $history->approved_2_status }}</span>
                                @else ($history->approved_2_status == 'rejected')
                                <span class="badge badge-danger">{{ $history->approved_2_status }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($history->approved_3_by == null )
                                <span class="badge badge-warning">waiting</span>
                                @elseif ($history->approved_3_status == 'approved')
                                <span class="badge badge-success">{{ $history->approved_3_status }}</span>
                                @else ($history->approved_3_status == 'rejected')
                                <span class="badge badge-danger">{{ $history->approved_3_status }}</span>
                                @endif
                            </td>
                            <td><a href="{{ url('hris/leave/approval/'.$history->id) }}" class="btn btn-sm btn-outline-primary">Detail</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- </div>

<div class="row"> -->
    <div class="col-lg-6">
        <div class="card mb-3 shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Leave Data</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover table-sm" id="employee-table" style="width: 100%;">
                    <thead>
                        <th>Created At</th>
                        <th>Type</th>
                        <th>Valid Date</th>
                        <th>Pick Date</th>
                        <th>Remark</th>
                    </thead>
                    <tbody>
                        @foreach($leave as $data)
                        <!-- @if(!empty($data->employee)) -->
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/y H:i:s') }}</td>
                            <td>
                                @if ($data->type == 'public_holiday')
                                <span class="badge badge-success">PH</span>
                                @elseif ($data->type == 'extra_off')
                                <span class="badge badge-success">EO</span>
                                @elseif ($data->type == 'annual_leave')
                                <span class="badge badge-success">AL</span>
                                @elseif ($data->type == 'sick_off')
                                <span class="badge badge-danger">SICK</span>
                                @endif
                            </td>
                            <td>
                                @if (\Carbon\Carbon::parse($data->valid_until)->isPast())
                                <span class="badge badge-danger">{{
                                    \Carbon\Carbon::parse($data->valid_until)->format('d/m/y') }}</span>

                                @elseif (\Carbon\Carbon::parse($data->valid_until)->isToday())
                                <span class="badge badge-warning">{{
                                    \Carbon\Carbon::parse($data->valid_until)->format('d/m/y') }}</span>

                                @elseif (\Carbon\Carbon::parse($data->valid_until)->isFuture())
                                <span class="badge badge-success">{{
                                    \Carbon\Carbon::parse($data->valid_until)->format('d/m/y') }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->pick_date == null)
                                <span class="badge badge-success badge-sm">belum diambil</span>
                                @else
                                <span class="badge badge-danger badge-sm">{{ $data->pick_date }}</span>
                                @endif
                            </td>
                            <td>{{ $data->description }}</td>
                        </tr>
                        <!-- @endif -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .table-selectable tbody tr.selected {
        background-color: #d1e7dd;
    }
</style>
@endsection

@section('js')
<script>
    $("#employee").select2({
        theme: 'bootstrap'
    });

    $("#select-employee").select2({
        theme: 'bootstrap'
    });


    $("#department").select2({
        theme: 'bootstrap'
    });

    $("#type").select2({
        theme: 'bootstrap'
    });

    $(document).ready(function() {
        $('#employee-table').DataTable({
            responsive: true,
            "order": [
                [0, 'desc']
            ]
        });
    });

    $('#history-table').DataTable({
        responsive: true,
        "order": [
            [0, 'desc']
        ]
    });
</script>

<script>
    function calculateTotalDays() {
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;

        if (startDate && endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);

            // Calculate the difference in time
            const timeDifference = end - start;

            // Convert time difference from milliseconds to full days
            const totalDays = Math.floor(timeDifference / (1000 * 60 * 60 * 24)) + 1; // +1 to include both start and end dates

            document.getElementById('totalDays').value = totalDays;
        } else {
            document.getElementById('totalDays').value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('start_date').addEventListener('change', calculateTotalDays);
        document.getElementById('end_date').addEventListener('change', calculateTotalDays);
    });
</script>
@endsection