@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Project Detail</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href=" url('/') ">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Project List</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $detail_project->name }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="card shadow mb-3">
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="font-weight-bolder text-primary">Project name :</label>
                    <input type="text" class="form-control" value="{{ $detail_project->name }}" disabled>
                    <small class="text-info">Created by: {{ $detail_project->owner->name }} - {{ $detail_project->created_at }}</small>
                </div>

                <div class="form-group">
                    <label for="">Project description :</label>
                    <textarea class="form-control" cols="20" rows="5" disabled>{{ $detail_project->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="">Budget :</label>
                    <input type="text" class="form-control" value="{{ $detail_project->budget }}">
                </div>
            </div>
        </div>

        <div class="card shadow mb-3">
            <div class="card-body">
                <div class="form-group">
                    Status :
                    @switch($detail_project->status)
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
                </div>

                <div class="form-group">
                    <label for="">Change status :</label>
                    <select name="change_status" class="custom-select">
                        <option value="" selected disabled>Select a status:</option>
                        <option value="planning">1. Planning</option>
                        <option value="ongoing">2. Ongoing</option>
                        <option value="completed">3. Completed</option>
                        <option value="on_hold">4. On Hold</option>
                        <option value="cancelled">5. Cancelled</option>
                    </select>
                    @if (isset($detail_project->update_by))
                    <small class="text-info">last update: {{ $detail_project->completedBy->name }} - {{ $detail_project->created_at }}</small>
                    @else
                    <small class="text-info">last update: {{ $detail_project->owner->name }} - {{ $detail_project->updated_at }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Start date :</label>
                    <input type="date" class="form-control" disabled value="{{ $detail_project->start_date }}">
                </div>
                <div class="form-group">
                    <label for="">Due date :</label>
                    <input type="date" class="form-control" disabled value="{{ $detail_project->due_date }}">
                </div>

                @if ($detail_project->end_date !== null)
                <div class="form-group">
                    <label for="">End date :</label>
                    <input type="date" class="form-control" disabled value="{{ $detail_project->end_date }}">
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8 col-sm-12">
        <div class="card shadow mb-3">
            <!-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Project task manager</h6>
            </div> -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="">Add task to project :</label>
                            <select name="add_new_task" class="custom-select">
                                <option value="test">select task :</option>
                            </select>
                            <small class="text-info">select from existing task</small> <br>
                            <button class="btn btn-success shadow btn-sm">
                                <i class="fas fa-plus"></i> Add Task
                            </button>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="">Task name :</label>
                            <input type="text" class="form-control" placeholder="enter task name">
                            <small class="text-info">for add new task</small><br>
                            <button class="btn btn-primary shadow btn-sm">
                                <i class="fas fa-plus"></i> Add Task
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Project Task List</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover table-striped" id="table-task" style="width:100%">
                    <thead>
                        <th style="width: 15%;">Date</th>
                        <th>Task</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 10%;">Score</th>
                        <th style="width: 10%;">Detail</th>
                    </thead>
                    <tbody>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <button class="btn btn-info btn-sm btn-circle shadow-sm" data-toggle="tooltip"
                                data-placement="top" title="view task details">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <button class="btn btn-danger btn-sm btn-circle shadow-sm" data-toggle="tooltip"
                                data-placement="top" title="remove task form this project">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- section css ready -->

@section('js')
<script>
    // ("#employee").select2({
    //     theme: 'bootstrap'
    // });

    $(document).ready(function() {
        $('#table-task').DataTable({
            responsive: true
        });
    });
</script>
@endsection