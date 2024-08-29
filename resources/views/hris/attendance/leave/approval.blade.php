@extends('layouts.app')

@section('title')
Employee Leave Form
@endsection

@section('content')
<h1 class="h3 text-gray-800">Employee Leave Form</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('leave') }}">Leave Management</a></li>
        <li class="breadcrumb-item">Employee Leave Form</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3 shadow">
            <!-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Employee Leave Form</h6>
            </div> -->
            <div class="card-body">
                <table class="table table-hover " id="employee-table">
                    <thead>
                        <th>Employee Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Work Date</th>
                        <th>HR Approval</th>
                        <th>Leader Approval (1)</th>
                        <th>Leader Approval (2)</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $history)
                        <tr>
                            <td>{{ $history->employee->name }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($history->start_date)->format('d/m/y') }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($history->end_date)->format('d/m/y') }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($history->work_date)->format('d/m/y') }}
                            </td>
                            <td class="text-center"><span class="badge badge-warning">Waiting</span></td>
                            <td class="text-center"><span class="badge badge-warning">Waiting</span></td>
                            <td class="text-center"><span class="badge badge-warning">Waiting</span></td>
                            <td><a href="#" class="btn btn-sm btn-outline-primary"><i class='fas fa-eye'></i> Detail</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
{{-- --}}
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
            responsive: false,
            "order": [
                [0, 'desc']
            ]
        });

        $('#table_test1').DataTable({
            responsive: true,
            "order": [
                [0, 'desc']
            ]
        });

        $('#table_test2').DataTable({
            responsive: false,
            "order": [
                [0, 'desc']
            ]
        });
    });
</script>
@endsection