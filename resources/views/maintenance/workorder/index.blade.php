@extends('layouts.app')

@section('title')
Helpdesk Management
@endsection

@section('content')
<h1 class="h3 text-gray-800">Helpdesk Management</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">All Tickets</li>
    </ol>
</nav>

<a href="{{ route('workorder.create') }}" class="btn btn-primary btn-sm shadow"><i class='fas fa-plus'></i> New Ticket</a>

<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#helpdesk_filter">
    <i class='fas fa-eye'></i> Filter Data
</button>

<div class="modal" id="helpdesk_filter" tabindex="-1" role="dialog" aria-labelledby="helpdesk_filter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary font-weight-bolder" id="exampleModalCenteredLabel">Search data by filter </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="department" class="font-weight-bold">Department :</label>
                    <select name="department" id="department" class="custom-select">
                        <option value="" selected>select a department</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status" class="font-weight-bold">Status :</label>
                    <select name="status" id="status" class="custom-select">
                        <option value="" selected>select a status</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="priority" class="font-weight-bold">Priority :</label>
                    <select name="priority" id="priority" class="custom-select">
                        <option value="" selected>select a priority</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="user" class="font-weight-bold">Finisher :</label>
                    <select name="user" id="user" class="custom-select">
                        <option value="" selected>select a user</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3 mt-2">
    <div class="col-xl-3 col-md-6 my-2">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-danger text-uppercase mb-1">
                            <a href="#" class="text-decoration-none font-weight-bold text-danger text-uppercase">Tickets Open</a>
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $totalOpen}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 my-2">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm mb-1">
                            <a href="#" class="text-decoration-none font-weight-bold text-warning text-uppercase">Tickets Progress</a>
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $totalOnProgress }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 my-2">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-success text-uppercase mb-1">
                            <a href="#" class="text-decoration-none font-weight-bold text-success text-uppercase">Tickets Done</a>
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $totalDone }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 my-2">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-info text-uppercase mb-1">
                            <a href="#" class="text-decoration-none font-weight-bold text-info text-uppercase">Tickets Closed</a>
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $totalClosed }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-2 shadow">
    <div class="card-body">
        <table class="table table-hover table-striped table-bordered" id="employee-table" style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 3%;">Due Date</th>
                    <th style="width: 20%;">No. Ticket</th>
                    <th style="width: 3%;">Status</th>
                    <th style="width: 3%;">Priority</th>
                    <th style="width: 3%;">Departments</th>
                    <th style="width: 3%;;">Assets</th>
                    <th style="width: 3%;;">Locations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($workorder as $data)
                <tr>
                    <td>
                        {{ \Carbon\Carbon::parse($data->due_date)->format('d M Y') }}
                    </td>
                    <td>
                        <a class="text-success font-weight-bolder" href="/workorder/detail/{{ $data->order_no }}">#{{ $data->order_no }}</a> <br>
                        <h5>{{ $data->title }}</h5>
                        <p>{{ $data->description }}</p>
                    </td>
                    <td>
                        @if($data->status === 'Open')
                        <a href="/workorder/detail/{{ $data->order_no }}" class="btn btn-danger">Open</a>
                        @elseif($data->status === 'On Progress')
                        <a href="/workorder/detail/{{ $data->order_no }}" class="btn btn-warning">Progress</a>
                        @elseif($data->status === 'Done')
                        <a href="/workorder/detail/{{ $data->order_no }}" class="btn btn-success">Done</a>
                        @elseif($data->status === 'Closed')
                        <a href="/workorder/detail/{{ $data->order_no }}" class="btn btn-info">Closed</a>
                        @endif
                    </td>
                    <td>
                        @if($data->priority == 'Low')
                        <button class="btn btn-success">Low</button>
                        @elseif($data->priority == 'Medium')
                        <button class="btn btn-warning">Medium</button>
                        @else
                        <button class="btn btn-danger">High</button>
                        @endif
                    </td>
                    <td>
                        <ol>
                            @foreach ($data->departmentMany as $deptMany)
                            @if ($deptMany !== null && $deptMany->department !== null)
                            <li><a href="#">{{ $deptMany->department->name }}</a></li>
                            @endif
                            @endforeach
                        </ol>
                    </td>
                    <td>
                        <ol>
                            @foreach ($data->assetMany as $assMany)
                            @if ($assMany !== null && $assMany->asset !== null)
                            <li><a href="#">{{ $assMany->asset->name }}</a></li>
                            @endif
                            @endforeach
                        </ol>
                    </td>
                    <td>
                        <ol>
                            @foreach ($data->LocationMany as $locMany)
                            @if ($locMany !== null && $locMany->location !== null)
                            <li><a href="#">{{ $locMany->location->name }}</a></li>
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

    $("#tag-asset").select2({
        theme: 'bootstrap'
    });

    $("#tag-location").select2({
        theme: 'bootstrap'
    });

    $("#tag-department").select2({
        theme: 'bootstrap'
    });
</script>
@endsection