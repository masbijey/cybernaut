@extends('layouts.app')

@section('title')
Employee Leave Form
@endsection

@section('content')
<h1 class="h3 text-gray-800">Employee Leave Form</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('leave.index') }}">Leave Management</a></li>
        <li class="breadcrumb-item">Employee Leave Form</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="card mb-3 shadow">
            <div class="card-header text-primary py-3">
                <h6 class="m-0 font-weight-bold">Leave Information</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('leaveapproval.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="start_date" class="font-weight-bold">Start date:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="end_date" class="font-weight-bold">End date:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="work_date" class="font-weight-bold">Work date:</label>
                                <input type="date" id="work_date" name="work_date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="totalDays" class="font-weight-bold">Total Days:</label>
                                <input type="text" id="totalDays" class="form-control" readonly>
                            </div>
                        </div>
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

                    <!-- <button type="Reset" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')

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

    $('#employee-table').DataTable({
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