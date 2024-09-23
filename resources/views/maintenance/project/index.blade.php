@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Project Management</h1>

@section('title')
Project Management
@endsection

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Project List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add New Project</li>
    </ol>
</nav>

<div class="mt-3">
    <button type="button" class="btn mr-0 mb-0 d-inline-block">UPDATE : </button>

    <a href="{{ route('project.create') }}" class="btn btn-primary btn-sm shadow"><i class='fas fa-plus'></i> New
        Project</a>
</div>

<div class="card mt-3">
    <div class="card-body">
        <table class="table table-hover table-bordered table-striped" id="employee-table">
            <thead>
                <tr>
                    <th>Project</th>
                    <th>Status</th>
                    <th>Start date</th>
                    <th>Due date</th>
                    <th>End date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_project as $data)
                <tr>
                    <td>
                        <!-- {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/y') }} <br> -->
                        {{ $data->created_at }} <br>
                        <a href="/project/detail/{{ $data->id }}" class="font-weight-bolder">{{ $data->name }}</a> <br>
                        {{ $data->description }}
                    </td>
                    <td>
                        @switch($data->status)
                        @case('planning')
                        <button class="btn btn-info btn-sm">Planning</button>
                        @break

                        @case('ongoing')
                        <button class="btn btn-primary btn-sm">Ongoing</button>
                        @break

                        @case('completed')
                        <button class="btn btn-success btn-sm">Completed</button>
                        @break

                        @case('on_hold')
                        <button class="btn btn-warning btn-sm">On Hold</button>
                        @break

                        @case('cancelled')
                        <button class="btn btn-danger btn-sm">Cancelled</button>
                        @break

                        @default
                        <button class="btn btn-secondary btn-sm">Unknown</button>
                        @endswitch
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($data->planStartDate)->format('d/m/y') }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($data->due_date)->format('d/m/y') }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($data->end_date)->format('d/m/y') }}
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