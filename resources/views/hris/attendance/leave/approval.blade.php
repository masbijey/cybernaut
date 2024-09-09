@extends('layouts.app')

@section('title')
Employee Leave Form
@endsection

@section('content')
<h1 class="h3 text-gray-800">Employee Leave Form</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/hris/leave') }}">Leave Management</a></li>
        <li class="breadcrumb-item">Employee Leave Form</li>
    </ol>
</nav>

<div class="row">
    <div class="d-block d-sm-none d-md-none container">
        @foreach ($data as $history)
        <div class="card mb-3 shadow">
            <div class="card-body">
                <h5 class="card-title">{{ $history->employee->name }}</h5>
                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <td>Start date</td>
                            <td>{{ \Carbon\Carbon::parse($history->start_date)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td>End date</td>
                            <td>{{ \Carbon\Carbon::parse($history->end_date)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td>Work date</td>
                            <td>{{ \Carbon\Carbon::parse($history->work_date)->format('d-m-Y') }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ url('hris/leave/approval/'.$history->id) }}" class="btn btn-primary btn-sm shadow">detail</a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-none d-sm-block w-100">
        <div class="col-12">
            <div class="card mb-3 shadow">
                <div class="card-body">
                    <table class="table table-hover" id="employee-table" style="width: 100%;">
                        <thead>
                            <th>Employee Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Work Date</th>
                            <th>Leader Approval (1)</th>
                            <th>Leader Approval (2)</th>
                            <th>HR Approval</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $history)
                            <tr>
                                <td>{{ $history->employee->name }}</td>
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
                                <td>
                                    <a href="{{ url('hris/leave/approval/'.$history->id) }}" class="btn btn-primary shadow">DETAIL</a>
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