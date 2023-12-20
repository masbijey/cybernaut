@extends('layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">WORK ORDER MANAGEMENT</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Work Order Management</li>
    </ol>
</nav>

<div class="card mt-3">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Work Order List</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('workorder.create') }}" class="btn btn-primary btn-icon-split mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">New Work Order</span>
        </a>

        <table class="table nowrap" id="employee-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Status</th>
                    <!-- <th>Description</th> -->
                    <th>Priority</th>
                    <th>Department</th>
                    <th>Asset</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($workorder as $data)
                    <tr>
                        <td>
                            {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/y') }}
                        </td>
                        <td><a href="/workorder/detail/{{ $data->id }}">{{ $data->title }}</a></td>
                        <td>
                            @if($data->status == 'Done')
                                <span class="badge badge-success">Done</span>
                            @else
                                <span class="badge badge-danger">On Progress</span>
                            @endif
                        </td>
                        <!-- <td>{{ $data->description }}</td> -->
                        <td>
                            @if($data->priority == 'Low')
                                <span class="badge badge-success">Low</span>
                                <blade
                            @elseif ($data->priority == 'Medium')
                                <span class="badge badge-warning">Medium</span>
                            @else
                                <span class="badge badge-danger">High</span>
                            @endif
                        </td>
                        
                        <td>{{ $data->department->name }}</td>
                        <td>
                            @if(isset($data->asset_id))
                                {{ $data->asset->name }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if(isset($data->location_id))
                                {{ $data->location->name }}
                            @else
                                -
                            @endif
                        </td>
                        <td>Show</td>
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
