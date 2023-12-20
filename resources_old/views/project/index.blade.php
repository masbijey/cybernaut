@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Project Management</h1>

<div class="mt-3">
    <button type="button" class="btn mr-0 mb-0 d-inline-block">UPDATE : </button>

    <a href="{{ route('project.create') }}" class="btn btn-primary btn-sm"><i class='fas fa-plus'></i> New
        Project</a>
</div>

<div class="card mt-3">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Project List</h6>
    </div>
    <div class="card-body">
        <table class="table table-hover table-sm table-bordered table-striped" id="employee-table">
            <thead class="thead-light text-center">
                <tr class="text-center">
                    <th class="text-center">Create at</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Plan start</th>
                    <th class="text-center">Due date</th>
                    <th class="text-center">End date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($project as $data)
                <tr class="text-center">
                    <td>
                        {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/y') }}
                    </td>
                    <td>
                        <a href="/project/detail/{{ $data->id }}">{{ $data->description }}</a>
                    </td>
                    <td>
                        @if ($data->status == 'Done')
                        <span class="badge badge-success">Done</span>
                        @else
                        <span class="badge badge-danger">On Progress</span>
                        @endif
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