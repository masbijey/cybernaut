@extends('layouts.app')

@section('title')
Leave Management 
@endsection

@section('content')
<h1 class="h3 text-gray-800">Employee Leave Data</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('leave.index') }}">Leave Management</a></li>
        <li class="breadcrumb-item">Employee Leave Data</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3 shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Leave Data</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover table-striped table-bordered" id="employee-table">
                    <thead>
                        <th>Created At</th>
                        <th>Employee</th>
                        <th>Type</th>
                        <th>Valid Date</th>
                        <th>Pick Date</th>
                        <th>Remark</th>
                    </thead>
                    <tbody>
                        @foreach($leave as $data)
                        @if(!empty($data->employee))
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/y H:i:s') }}</td>
                            <td> <a href="{{ url('/employee/detail/'.$data->user_id) }}">{{ $data->employee->name}}</a></td>
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
                        @endif
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
            responsive: true,
            "order": [
                [0, 'desc']
            ]
        });
    });
</script>
@endsection