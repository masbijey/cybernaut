@extends('layouts.app')

@section('title')
Helpdesk Management
@endsection

@section('content')
<h1 class="h3 text-gray-800">Helpdesk Management</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Helpdesk Management</li>
        <li class="breadcrumb-item active" aria-current="page">All Tickets</li>
    </ol>
</nav>

<!-- <a href="{{ route('workorder.create') }}" class="btn btn-primary shadow"><i class='fas fa-plus'></i> New Ticket</a> -->

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
    <i class='fas fa-plus'></i> New Ticket
</button>

<!-- Modal -->
<div class="modal" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('workorder.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title text-primary font-weight-bolder" id="exampleModalCenteredLabel">Create new Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="department" class="font-weight-bolder">To Department :</label>
                        <select class="js-example-basic-multiple custom-select form-control-sm" id="tag-department" name="department_ids[]" multiple="multiple" style="width: 100%;" required>
                            @foreach($department as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select> <br>
                        <small class="text-info">*tandai department tujuan | dapat memilih lebih dari satu</small>
                    </div>

                    <div class="form-group">
                        <label for="file" class="font-weight-bolder">Insert image :</label> <br>
                        <input type="file" name="file" id="file"> <br>
                    </div>

                    <div class="form-group">
                        <label for="title" class="font-weight-bolder">Subject :</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="description" class="font-weight-bolder">Message :</label>
                        <textarea name="description" id="description" name="description" class="form-control form-control-sm" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="due_date" class="font-weight-bolder">Due date :</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="priority" class="font-weight-bolder">Priority :</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="Low" name="priority" class="custom-control-input" value="Low" required>
                            <label class="custom-control-label text-success font-weight-bolder" for="Low">Low</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="Medium" name="priority" class="custom-control-input" value="Medium" required>
                            <label class="custom-control-label text-warning font-weight-bolder" for="Medium">Medium</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="High" name="priority" class="custom-control-input" value="High" required>
                            <label class="custom-control-label text-danger font-weight-bolder" for="High">High</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row mb-3 mt-3">
    <div class="col-xl-3 col-md-6">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                            Tickets Open
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-success text-uppercase mb-1">
                            Tickets Progress
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-info text-uppercase mb-1">
                            Tickets Done
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">0</div>
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
                    <th style="width: 5%;">Due Date</th>
                    <th style="width: 20%;">No. Ticket</th>
                    <th style="width: 3%;">Status</th>
                    <th style="width: 3%;">Priority</th>
                    <th style="width: 5%;">Departments</th>
                    <!-- <th style="width: 10%;">Assets</th>
                    <th style="width: 10%;">Locations</th> -->
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
                        <small>{{ $data->description }}</small>
                    </td>
                    <td>
                        @if($data->status !== 'Done')
                        <a href="/workorder/detail/{{ $data->order_no }}" class="btn btn-sm btn-danger">Open</a>
                        @else
                        <a href="/workorder/detail/{{ $data->order_no }}" class="btn btn-sm btn-success">Done</a>
                        @endif
                    </td>
                    <td>
                        @if($data->priority == 'Low')
                        <button class="btn btn-sm btn-success">Low</button>
                        @elseif($data->priority == 'Medium')
                        <button class="btn btn-sm btn-warning">Medium</button>
                        @else
                        <button class="btn btn-sm btn-danger">High</button>
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
                    <!-- <td>
                        <ol>
                            @foreach ($data->assetMany as $assMany)
                            @if ($assMany !== null && $assMany->asset !== null)
                            <li><a href="#" >{{ $assMany->asset->name }}</a></li>
                            @endif
                            @endforeach
                        </ol>
                    </td>
                    <td>
                        <ol>
                            @foreach ($data->LocationMany as $locMany)
                            @if ($locMany !== null && $locMany->location !== null)
                            <li><a href="#" >{{ $locMany->location->name }}</a></li>
                            @endif
                            @endforeach
                        </ol>
                    </td> -->
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