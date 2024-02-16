@extends('layouts.app')

@section('content')
<h1 class="h3 text-gray-800">TASK MANAGEMENT</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Task Management</li>
    </ol>
</nav>

<button type="button" class="btn d-inline-block">UPDATE : </button>
<a href="{{ route('task.create') }}" class="btn btn-outline-secondary btn-sm shadow-sm"><i class='fas fa-plus'></i> New Task</a>

<div class="card mt-2 shadow-sm">
    <div class="card-body">
        <table class="table table-sm" id="employee-table">
            <thead>
                <tr>
                    <th>Due Date</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Type</th>
                    <th>Asset</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                @foreach($task as $data)
                <tr>
                    <!-- <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/y') }}</td> -->
                    <td>{{ $data->task_date }}</td>
                    <td><a href="/task/detail/{{ $data->id }}">{{ $data->task_title }}</a></td>
                    <td>
                        @if ($data->task_status == 'Done')
                        <button class="btn btn-sm btn-success"><b>Done</b></button>
                        @else
                        <button class="btn btn-sm btn-danger"><b>On Progress</b></button>
                        @endif
                    </td>
                    <td>
                        @if ($data->task_priority == 'Low')
                        <button class="btn btn-sm btn-outline-success">Low</button>
                        @elseif ($data->task_priority == 'Medium')
                        <button class="btn btn-sm btn-outline-warning">Medium</button>
                        @else
                        <button class="btn btn-sm btn-outline-danger">High</button>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-outline-info">{{ $data->task_type }}</button>
                    </td>
                    <td class="text-wrap">
                        <p>
                            @foreach($data->assetMany as $asset)
                            @if($asset->asset !== null)
                            <button class="btn btn-sm btn-outline-secondary">{{ $asset->asset->name }}</button>
                            @endif
                            @endforeach
                        </p>
                    </td>
                    <td>
                        <p>
                            @foreach($data->locationMany as $location)
                            @if($location->location !== null)
                            <button class="btn btn-sm btn-outline-secondary">{{ $location->location->name }}</button>
                            @endif
                            @endforeach
                        </p>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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