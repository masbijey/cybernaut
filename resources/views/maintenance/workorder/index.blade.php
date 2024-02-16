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
<a href="{{ route('workorder.create') }}" class="btn btn-outline-secondary btn-sm"><i class='fas fa-plus'></i> New Work Order</a>

<div class="card mt-3 shadow">
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
                        <a class="text-danger" href="/workorder/detail/{{ $data->order_no }}"><b>#{{ $data->order_no }}</b></a>
                    </td>
                    <td>
                        {{ $data->title }}
                    </td>
                    <td>
                        @if($data->status !== 'Done')
                        <button class="btn btn-sm btn-outline-danger">Open</button>
                        @else
                        <button class="btn btn-sm btn-outline-success">Done</button>
                        @endif
                    </td>
                    <td>
                        @if($data->priority == 'Low')
                        <button class="btn btn-sm btn-outline-success">Low</button>
                        @elseif($data->priority == 'Medium')
                        <button class="btn btn-sm btn-outline-warning">Medium</button>
                        @else
                        <button class="btn btn-sm btn-outline-danger">High</button>
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