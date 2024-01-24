@extends('layouts.app')

@section('content')
<h1 class="h3 text-gray-800">Tasks Management</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Task Management</li>
    </ol>
</nav>

<button type="button" class="btn d-inline-block">UPDATE : </button>
<a href="{{ route('task.create') }}" class="btn btn-primary btn-sm"><i class='fas fa-plus'></i> New Task</a>

<div class="card mt-3 shadow">
    <div class="card-header bg-gradient-primary text-light">
        <h5 class="m-0 font-weight-bold">Task List</h5>
    </div>
    <div class="card-body">
        <div class="">
            <table class="table" id="employee-table">
                <thead class="thead-light">
                    <tr>
                        <th style="width:10%">Created at</th>
                        <th style="width:10%">Due Date</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Type</th>
                        <th>Asset</th>
                        <th>Location</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($task as $data)
                    <tr>
                        <td>
                            {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/y') }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($data->task_date)->format('d/m/y') }}
                        </td>
                        <td>
                            <a href="/task/detail/{{ $data->id }}">{{ $data->task_title }}</a>
                        </td>
                        <td>
                            @if ($data->task_status == 'Done')
                            <span class="badge badge-success">Done</span>
                            @else
                            <span class="badge badge-danger">On Progress</span>
                            @endif
                        </td>
                        <td>
                            @if ($data->task_priority == 'Low')
                            <span class="badge badge-success">Low</span>
                            @elseif ($data->task_priority == 'Medium')
                            <span class="badge badge-warning">Medium</span>
                            @else
                            <span class="badge badge-danger">High</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $data->task_type }}</span>
                        </td>
                        <td>
                            @foreach($data->assetMany as $asset)
                            @if($asset->asset !== null)
                            {{ $asset->asset->name }}
                            @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($data->locationMany as $location)
                            @if($location->location !== null)
                            <a href="#">{{ $location->location->name }}</a> <br>
                            @endif
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('css')
{{-- --}}
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