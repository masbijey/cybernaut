@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Task Management</h1>

<div class="mt-3">
    <button type="button" class="btn mr-0 mb-0 d-inline-block">UPDATE : </button>

    <a href="{{ route('task.create') }}" class="btn btn-primary btn-sm"><i class='fas fa-plus'></i> New
        Task</a>
</div>

<div class="card mt-3">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Task List</h6>
    </div>
    <div class="card-body">
        <table class="table table-hover table-sm table-bordered table-striped" id="employee-table">
            <thead class="thead-light text-center">
                <tr class="text-center">
                    <th class="text-center">Due Date</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Priority</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Asset</th>
                    <th class="text-center">Location</th>
                    {{-- <th class="text-center">Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($task as $data)
                <tr class="text-center">
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
                        @if ($data->asset_id == null)
                        null
                        @else
                        <a href="/asset/detail/{{ $data->asset->token }}" class="">{{ $data->asset->name }}</a>
                        @endif
                    </td>
                    <td>
                        @if ($data->location_id == null)
                        null
                        @else
                        <a href="/location/detail/{{ $data->location_id }}">{{ $data->location->name }}</a>
                        @endif
                    </td>
                    {{-- <td>
                        <a href="/task/detail/{{ $data->id }}" class="btn btn-sm btn-primary text-center"
                            data-placement="top" title="Show"><i class='fas fa-eye'></i></a>
                        <a href="/task/edit/{{ $data->id }}" class="btn btn-sm btn-danger text-center"
                            data-placement="top" title="Edit"><i class='fas fa-edit'></i></a>
                    </td> --}}
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
    $(document).ready(function () {
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