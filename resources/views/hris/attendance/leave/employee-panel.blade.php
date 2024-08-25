@extends('layouts.app')

@section('content')
<h1 class="h3 text-gray-800">Leave Management</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Leave Management</li>
    </ol>
</nav>

<div class="mb-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary shadow" data-toggle="modal" data-target="#exampleModal">
        <i class='fas fa-plus'></i> Leave Form Request
    </button>

    <!-- Modal -->
    <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <label for="" class="font-weight-bold">Your leave:</label>
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
                        <div class="h4 mb-0 font-weight-bold text-gray-800">4</div>
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
                        <div class="h4 mb-0 font-weight-bold text-gray-800">4</div>
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
                        <div class="h4 mb-0 font-weight-bold text-gray-800">4</div>
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
                            Requestition</div>
                        <div class="h4 mb-0 font-weight-bold text-gray-800">4</div>
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
                <table class="table table-hover" id="history-table" style="width: 100%;">
                    <thead>
                        <th>No.</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Work date</th>
                        <th>HR Approval</th>
                        <th>Leader Approval (1)</th>
                        <th>Leader Approval (2)</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($history as $history)
                        <tr>
                            <td>1</td>
                            <td>{{ $history->start_date }}</td>
                            <td>{{ $history->end_date }}</td>
                            <td>{{ $history->work_date }}</td>
                            <td class="text-center"><span class="badge badge-warning">Waiting</span></td>
                            <td class="text-center"><span class="badge badge-warning">Waiting</span></td>
                            <td class="text-center"><span class="badge badge-warning">Waiting</span></td>
                            <td><a href="#" class="btn btn-sm btn-outline-primary">Detail</a></td>
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
                <table class="table table-hover" id="employee-table" style="width: 100%;">
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