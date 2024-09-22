@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Project Detail</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href=" url('/') ">Home</a></li>
        <li class="breadcrumb-item"><a href=" route('project.index') ">Project List</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $detail_project->name }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="card shadow mb-3">
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="font-weight-bolder">Project name :</label>
                    <input type="text" class="form-control" value="{{ $detail_project->name }}" disabled>
                    <small class="text-info">Created by: {{ $detail_project->owner->name }} - {{ $detail_project->created_at }}</small>
                </div>

                <div class="form-group">
                    <label for="">Project description :</label>
                    <textarea class="form-control" cols="20" rows="5" disabled>{{ $detail_project->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="">Budget :</label>
                    <input type="number" class="form-control" value="{{ $detail_project->budget }}">
                </div>
            </div>
        </div>

        <div class="card shadow mb-3">
            <div class="card-body">
                <div class="form-group">
                    Status :
                    @switch($detail_project->status)
                    @case('planning')
                    <span class="badge badge-info">Planning</span>
                    @break

                    @case('ongoing')
                    <span class="badge badge-primary">Ongoing</span>
                    @break

                    @case('completed')
                    <span class="badge badge-success">Completed</span>
                    @break

                    @case('on_hold')
                    <span class="badge badge-warning">On Hold</span>
                    @break

                    @case('cancelled')
                    <span class="badge badge-danger">Cancelled</span>
                    @break

                    @default
                    <span class="badge badge-secondary">Unknown</span>
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
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Project tasks list</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group w-50 mb-4 pl-3 pr-3">
                        <label for="">Add task to project :</label>
                        <select name="add_new_task" class="custom-select">
                            <option value="test">select task :</option>
                        </select>
                        <small class="text-info">select from existing task</small> <br>
                        <button class="btn btn-success btn-sm shadow">add</button>
                    </div>

                    <div class="form-group w-50 pr-3">
                        <label for="">Task name :</label>
                        <input type="text" class="form-control">
                        <small class="text-info">for add new task</small><br>
                        <button class="btn btn-primary btn-sm shadow">Add</button>
                    </div>

                </div>
                <table class="table">
                    <thead class="thead-light">
                        <th>Date</th>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Score</th>
                        <th>Detail</th>
                    </thead>
                    <tbody>

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
    ("#employee").select2({
        theme: 'bootstrap'
    });

    ("#employee2").select2({
        theme: 'bootstrap'
    });

    ("#assets").select2({
        theme: 'bootstrap'
    });

    ("#locations").select2({
        theme: 'bootstrap'
    });

    ("#assets2").select2({
        theme: 'bootstrap'
    });

    ("#location2").select2({
        theme: 'bootstrap'
    });

    (document).ready(function() {
        ('js-example-basic-multiple').select2();
    });

    (document).ready(function() {
        ('#task-table').DataTable({
            responsive: true
        });
    });

    (document).ready(function() {
        ('#maintenance-table').DataTable({
            responsive: true
        });
    });
</script>
@endsection