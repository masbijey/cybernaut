@extends('layouts.app')

@section('content')
<div class="mb-2">
    <h4 class="d-inline bg-dark text-white">Detail Project :</h4> <br>
    <h3 class="text-white d-inline bg-gradient-primary">{{ $project->description }}</h3>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow mt-3">
            <div class="card-header text-primary">
                <h6 class="m-1 font-weight-bold">Project Information</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><label for="date">Created</label></td>
                        <td>
                            <input type="datetime" class="form-control form-control-sm"
                                value="{{ \Carbon\Carbon::parse($project->created_at)->format('d M Y H:i:s') }}"
                                disabled>
                            <small>by : {{ $project->employee->name }}</small>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="description">Description</label></td>
                        <td>
                            <textarea class="form-control form-control-sm"
                                disabled>{{ $project->description }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="status">Status</label></td>
                        <td>
                            @if ($project->status == 'Done')
                            <span class="badge badge-success">Done</span>
                            @elseif ($project->status == 'On progress')
                            <span class="badge badge-danger">On progress</span>
                            @else
                            <span class="badge badge-info">Hold</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><label for="due_date">Due date</label></td>
                        <td><input type="date" class="form-control form-control-sm" value="{{ $project->due_date }}"
                                disabled></td>
                    </tr>
                    <tr>
                        <td><label for="end_date">End date</label></td>
                        <td><input type="date" class="form-control form-control-sm" value="{{ $project->end_date }}"
                                disabled></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card shadow mt-3">
            <div class="card-header text-primary">
                <h6 class="m-1 font-weight-bold">Asset & Location</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-sm table-hover">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th>Asset</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>Test</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col">
                        <table class="table table-bordered table-sm table-hover">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th>Location</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div id="accordion">
                    <button class="btn btn-primary btn-sm collapsed mb-2 shadow-none text-decoration-none"
                        data-toggle="collapse" data-target="#asset-add" aria-expanded="false"
                        aria-controls="collapseTwo">
                        <b>+</b> asset or location
                    </button>

                    <div class="card">
                        <div id="asset-add" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <form method="POST" action="{{ route('project.addassloc') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="w-25"><label for="asset">Asset</label></td>
                                            <td>
                                                <select class="js-example-basic-multiple custom-select"
                                                    name="asset_ids[]" multiple="multiple" style="width:100%;" id="assets">
                                                    @foreach ($asset as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="location">Location</label></td>
                                            <td>
                                                <select class="js-example-basic-multiple custom-select"
                                                    name="location_ids[]" multiple="multiple" style="width:100%;" id="locations">
                                                    @foreach ($location as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button class="btn btn-primary btn-sm shadow"
                                                    type="submit">Save</button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card shadow mt-3 mb-3">
            <a href="#doclist" class="d-block card-header" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="doclist">
                <h6 class="m-1 font-weight-bold text-primary">Project Document</h6>
            </a>
            <div class="collapse show" id="doclist">
                <div class="card-body">
                    <table class="table table-bordered table-sm table-hover">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>File</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td><a href="">show file</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <div id="accordion">
                        <button class="btn btn-primary btn-sm collapsed mb-2 shadow-none text-decoration-none"
                            data-toggle="collapse" data-target="#file" aria-expanded="false"
                            aria-controls="collapseTwo">
                            <b>+</b> new file
                        </button>

                        <div class="card">
                            <div id="file" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('project.addfile') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file" name="file"
                                                    required>
                                                <label class="custom-file-label" for="file">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="task_description">Description</label>
                                            <textarea name="task_description" id="task_description"
                                                class="form-control form-control-sm"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-sm btn-primary shadow">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mt-3 mb-3">
            <a href="#commentlist" class="d-block card-header" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="commentlist">
                <h6 class="m-1 font-weight-bold text-primary">Project Comment</h6>
            </a>
            <div class="collapse show" id="commentlist">
                <div class="card-body">
                    <table class="table table-sm table-hover">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th colspan="2">Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($project->comment as $comment)
                            <tr>
                                <td class="w-25 text-center">
                                    <small>{{ $comment->employee->name }}</small> <br>
                                    <small>{{ $comment->created_at }}</small>
                                </td>
                                <td>{{ $comment->comment }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="accordion">
                        <button class="btn btn-primary btn-sm collapsed mb-2 shadow-none text-decoration-none"
                            data-toggle="collapse" data-target="#comment" aria-expanded="false"
                            aria-controls="collapseTwo">
                            <b>+</b> new comment
                        </button>

                        <div class="card">
                            <div id="comment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('project.addcomm') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $project->id}}">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Comment</label>
                                            <textarea name="comment" id="formGroupExampleInput"
                                                class="form-control form-control-sm" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-sm btn-primary shadow">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow mt-3">
            <a href="#projectlist" class="d-block card-header" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="projectlist">
                <h6 class="m-1 font-weight-bold text-primary">Project Task's</h6>
            </a>
            <div class="collapse show" id="projectlist">
                <div class="card-body">
                    <table class="table table-bordered table-sm table-hover" style="width:100%" id="task-table">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>Status</th>
                                <th style="width:50%">Description</th>
                                <th>Start date</th>
                                <th>Due date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($project->task as $task)
                            <tr class="text-center">
                                <td style="width:20%;">
                                    {{-- <div class="mb-2">
                                        <img src="https://www.w3schools.com/tags/img_girl.jpg" width="auto"
                                            class="img-thumbnail">
                                    </div> --}}

                                    @if ($task->status == 'Done')
                                    <a href="{{ route('task.undone', $task->id) }}"
                                        class="btn btn-sm btn-success shadow-none">DONE</a> <br>
                                    <small>{{ \Carbon\Carbon::parse($task->end_date)->format('d/m/y H:i:s') }}</small>
                                    <br>
                                    <small>{{ $task->end_by }}</small>
                                    @else
                                    <a href="{{ route('task.done', $task->id) }}"
                                        class="btn btn-sm btn-warning shadow-none">On
                                        progress</a> <br>
                                    <small>{{ \Carbon\Carbon::parse($task->end_date)->format('d/m/y H:i:s') }}</small>
                                    <br>
                                    <small>{{ $task->end_by }}</small>
                                    @endif
                                    <br>
                                </td>
                                <td class="text-left">
                                    <small>Created by : {{ $task->employee->name }} {{ $task->created_at }}</small>
                                    <p class="text-body text-capitalize">{{ $task->description }}</p>
                                    <small>Assign to : <br>
                                        @foreach ($task->taskemployee as $taskemp)
                                        - {{ $taskemp->employee->name }} <br>
                                        @endforeach</small>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($task->planStartDate)->format('d/m/y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d/m/y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="accordion">
                        <button class="btn btn-primary btn-sm collapsed mb-2 shadow-none text-decoration-none"
                            data-toggle="collapse" data-target="#task" aria-expanded="false"
                            aria-controls="collapseTwo">
                            <b>+</b> new task
                        </button>

                        <div class="card">
                            <div id="task" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('project.addtask') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $project->id }}">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="task_start_date">Start date</label>
                                                    <input type="date" name="task_start_date" id="task_start_date"
                                                        class="form-control form-control-sm">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="task_due_date">Due date</label>
                                                    <input type="date" name="task_due_date" id="task_due_date"
                                                        class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="members">Assign to</label>
                                            <select
                                                class="js-example-basic-multiple custom-select form-control form-control-sm"
                                                id="employee" name="member_ids[]" multiple="multiple" required
                                                style="width:100%;">
                                                @foreach ($employee as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="task_description">Task description</label>
                                            <textarea name="task_description" id="task_description"
                                                class="form-control form-control-sm"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-sm btn-primary shadow">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mt-3">
            <a href="#maintenancelist" class="d-block card-header" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="maintenancelist">
                <h6 class="m-1 font-weight-bold text-primary">Project Maintenance's</h6>
            </a>
            
            <div class="collapse show" id="maintenancelist">
                <div class="card-body">
                    <table class="table table-bordered table-sm table-hover" style="width:100%" id="maintenance-table">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>Status</th>
                                <th style="width:50%">Description</th>
                                <th>Start date</th>
                                <th>Due date</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- --}}
                        </tbody>
                    </table>
                    <div id="accordion">
                        <button class="btn btn-primary btn-sm collapsed mb-2 shadow-none text-decoration-none"
                            data-toggle="collapse" data-target="#maintenance" aria-expanded="false"
                            aria-controls="collapseTwo">
                            <b>+</b> new task
                        </button>

                        <div class="card">
                            <div id="maintenance" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('project.addtask') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $project->id }}">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="task_start_date">Start date</label>
                                                    <input type="date" name="task_start_date" id="task_start_date"
                                                        class="form-control form-control-sm">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="task_due_date">Due date</label>
                                                    <input type="date" name="task_due_date" id="task_due_date"
                                                        class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="members">Assign to</label>
                                            <select
                                                class="js-example-basic-multiple custom-select form-control form-control-sm"
                                                id="employee2" name="member_ids[]" multiple="multiple" required
                                                style="width:100%;">
                                                @foreach ($employee as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="task_description">Task description</label>
                                            <textarea name="task_description" id="task_description"
                                                class="form-control form-control-sm"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-sm btn-primary shadow">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
{{-- --}}
@endsection

@section('js')
<script>
    $("#employee").select2({
        theme: 'bootstrap'
    });

    $("#employee2").select2({
        theme: 'bootstrap'
    });

    $("#assets").select2({
        theme: 'bootstrap'
    });

    $("#locations").select2({
        theme: 'bootstrap'
    });

    $("#assets2").select2({
        theme: 'bootstrap'
    });

    $("#location2").select2({
        theme: 'bootstrap'
    });

    $(document).ready(function() {
        $('js-example-basic-multiple').select2();
    }); 

    $(document).ready(function () {
        $('#task-table').DataTable({
            responsive: true
        }); 
    });

    $(document).ready(function () {
        $('#maintenance-table').DataTable({
            responsive: true
        }); 
    });
</script>
@endsection