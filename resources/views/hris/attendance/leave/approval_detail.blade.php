@extends('layouts.app')

@section('title')
Employee Leave Form
@endsection

@section('content')
<h1 class="h3 text-gray-800">Leave Form Detail</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('leave.index') }}">Leave Management</a></li>
        <li class="breadcrumb-item">Employee Leave Form Detail</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="card mb-3 shadow">
            <div class="card-header text-primary py-3">
                <h6 class="m-0 font-weight-bold">Leave Information</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>: <b>{{ $data->user->name }}</b></td>
                        </tr>
                        <tr>
                            <td>Department</td>
                            <td>
                                @if (!empty($data->user->contract->last()))
                                : {{ $data->user->contract->last()->department->name }}
                                @else
                                : <span class="badge badge-danger">belum kontrak</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Join date</td>
                            <td>: {{ \Carbon\Carbon::parse($data->user->joinDate )->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td>Start date</td>
                            <td>: <b>{{ \Carbon\Carbon::parse($data->start_date)->format('d-m-Y') }}</b></td>
                        <tr>
                            <td>End date</td>
                            <td>: <b>{{ \Carbon\Carbon::parse($data->end_date)->format('d-m-Y') }}</b></td>
                        </tr>
                        <tr>
                            <td>Work date</td>
                            <td>: <b>{{ \Carbon\Carbon::parse($data->work_date)->format('d-m-Y') }}</b></td>
                        </tr>
                        <tr>
                            <td>Reason</td>
                            <td>: {{ $data->remark }}</td>
                        </tr>
                        <tr>
                            <td>Leaves</td>
                            <td>
                                <table class="table table-hover table-sm table-bordered">
                                    <thead class="thead-light">
                                        <th>Expired</th>
                                        <th>Type</th>
                                        <th>Remark</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($leaves as $leave)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($leave->valid_until)->format('d-m-Y') }}</td>
                                            <td>
                                                @if ($leave->type == 'public_holiday')
                                                <span class="badge badge-success">PH</span>
                                                @elseif ($leave->type == 'extra_off')
                                                <span class="badge badge-success">EO</span>
                                                @elseif ($leave->type == 'annual_leave')
                                                <span class="badge badge-success">AL</span>
                                                @elseif ($leave->type == 'sick_off')
                                                <span class="badge badge-danger">SICK</span>
                                                @endif
                                            </td>
                                            <td>{{ $leave->description }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="card mb-3 shadow">
            <div class="card-header text-primary py-3">
                <h6 class="m-0 font-weight-bold">Approval</h6>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="form-group">
                        <label for="test" class="font-weight-bold">Leader 1</label>
                        @if ($data->approved_2_by == null)
                        <select class="custom-select" name="leader1_status">
                            <option selected="" disabled>select type:</option>
                            <option value="1">Approved</option>
                            <option value="2">Rejected</option>
                        </select>
                        <small>supervisor / hod</small>
                        @else
                        <input type="text" class="form-control" disabled value="Approved by {{ $data->approval2->name }} {{ $data->approved_2_at }}">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="test" class="font-weight-bold">Leader 2</label>
                        @if ($data->approved_3_by == null)
                        <select class="custom-select" name="leader2_status">
                            <option selected="" disabled>select type:</option>
                            <option value="1">Approved</option>
                            <option value="2">Rejected</option>
                        </select>
                        <small>hod / general manager</small>
                        @else
                        <input type="text" class="form-control" disabled value="Approved by {{ $data->approval3->name }} {{ $data->approved_3_at }}">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="test" class="font-weight-bold">HR Approval</label>
                        @if ($data->approved_1_by == null)
                        <select class="custom-select" name="hr_status">
                            <option selected="" disabled>select type:</option>
                            <option value="1">Approved</option>
                            <option value="2">Rejected</option>
                        </select>
                        <small>hr manager / hr admin</small>
                        @else
                        <input type="text" class="form-control" disabled value="Approved by {{ $data->approval1->name }} {{ $data->approved_1_at }}">
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary shadow">Save</button>
                    </div>
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
@endsection