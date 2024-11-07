@extends('layouts.app')

@section('title')
Task Management
@endsection

@section('content')
<h1 class="h3 text-gray-800">Task Manager</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Task Manager</li>
    </ol>
</nav>

<button type="button" class="btn d-inline-block">UPDATE : </button>
<a href="{{ route('task.create') }}" class="btn btn-primary btn-sm shadow"><i class='fas fa-plus'></i> New Task</a>

<div class="card mt-2 shadow">
    <div class="card-body">
        <table class="table table-hover table-striped table-bordered" id="employee-table" style="width: 100%;">
            <thead class="">
                <tr>
                    <th style="width: 10%;">Due Date</th>
                    <th>Task information</th>
                    <th style="width: 15%;">Status</th>
                    <th style="width: 10%;">Priority</th>
                    <th style="width: 10%;">Type</th>
                    <th style="width: 10%;">Asset</th>
                    <th style="width: 10%;">Location</th>
                </tr>
            </thead>
            <tbody>
                @foreach($task as $data)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($data->due_date)->format('d/m/y') }}</td>
                    <td>
                        <small>Created by {{ $data->user->name }} {{ $data->created_at }}</small> <br>
                        <a href="{{ url('/task/detail/'.$data->id) }}"><b>{{ $data->task_title }}</b></a> <br>
                        {{ $data->task_desc }}
                    </td>
                    <td>
                        @if ($data->task_status == 'Done')
                        <button class="btn btn-sm btn-success shadow"><b>Done</b></button>
                        @else
                        <button class="btn btn-sm btn-danger shadow"><b>On Progress</b></button>
                        @endif
                    </td>
                    <td>
                        @if ($data->task_priority == 'Low')
                        <button class="btn btn-sm btn-outline-success shadow">Low</button>
                        @elseif ($data->task_priority == 'Medium')
                        <button class="btn btn-sm btn-outline-warning shadow">Medium</button>
                        @else
                        <button class="btn btn-sm btn-outline-danger shadow">High</button>
                        @endif
                    </td>
                    <td>
                        @if(isset($data->task_type))
                        <button class="btn btn-sm btn-outline-info">{{ $data->task_type }}</button>
                        @else
                        <span class="badge badge-secondary">not set</span>
                        @endif
                    </td>
                    <td>
                        <ol>
                            @foreach($data->assetMany as $asset)
                            @if($asset->asset !== null)
                            <li>
                                <button class="btn btn-sm btn-outline-secondary">{{ $asset->asset->name }}</button>
                            </li>
                            @endif
                            @endforeach
                        </ol>
                    </td>
                    <td>
                        <ol>
                            @foreach($data->locationMany as $location)
                            @if($location->location !== null)
                            <li>
                                {{ $location->location->name }}
                            </li>
                            @endif
                            @endforeach
                        </ol>
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