@extends('layouts.app')

@section('content')
<h1 class="h3 text-gray-800">WORK ORDER MANAGEMENT</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Work Order Management</li>
    </ol>
</nav>

<button type="button" class="btn d-inline-block">UPDATE : </button>
<a href="{{ route('workorder.create') }}" class="btn btn-primary btn-sm"><i class='fas fa-plus'></i> New Work Order</a>

<div class="card mt-3 shadow">
    <div class="card-header bg-gradient-primary text-light">
        <h6 class="m-0 font-weight-bold">Work Order List</h6>
    </div>
    <div class="card-body">
        <table class="table table-sm" id="employee-table">
            <thead>
                <tr>
                    <th>Due Date</th>
                    <th>No. WO</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Departments</th>
                    <th>Assets</th>
                    <th>Locations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($workorder as $data)
                <tr>
                    <td>
                        {{ $data->due_date }}
                    </td>
                    <td>
                        <a href="/workorder/detail/{{ $data->order_no }}">{{ $data->order_no }}</a>
                    </td>
                    <td>
                        {{ $data->title }}
                    </td>
                    <td>
                        @if($data->status !== 'Done')
                        <span class="badge badge-danger">Open</span>
                        @else
                        <span class="badge badge-success">Done</span>
                        @endif
                    </td>
                    <td>
                        @if($data->priority == 'Low')
                        <span class="badge badge-success">Low</span>
                        @elseif($data->priority == 'Medium')
                        <span class="badge badge-warning">Medium</span>
                        @else
                        <span class="badge badge-danger">High</span>
                        @endif
                    </td>
                    <td class="text-wrap">
                        @foreach ($data->departmentMany as $deptMany)
                        @if ($deptMany !== null && $deptMany->department !== null)
                        <a href="#">{{ $deptMany->department->name }}</a> <br>
                        @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($data->assetMany as $assMany)
                        @if ($assMany !== null && $assMany->asset !== null)
                        <a href="#">{{ $assMany->asset->name }}</a> <br>
                        @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($data->LocationMany as $locMany)
                        @if ($locMany !== null && $locMany->location !== null)
                        <a href="#">{{ $locMany->location->name }}</a> <br>
                        @endif
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection

@section('css')
<!--  -->
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#employee-table').DataTable({
            responsive: true
        });
    });

    $("#employee").select2({
        theme: 'bootstrap'
    });

    $("#category").select2({
        theme: 'bootstrap'
    });

    $("#location").select2({
        theme: 'bootstrap'
    });
</script>
@endsection