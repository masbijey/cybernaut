@extends('layouts.app')

@section('title')
{{ $task->task_title }}
@endsection

@section('content')
<h1 class="h3 text-gray-800">Task Information</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('task.index') }}">Task Manager</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $task->task_title }}</li>
    </ol>
</nav>

<div class="row mb-5">
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="card my-2 shadow-sm">
            <div class="card-body">

                <div class="form-group">
                    <label class="text-primary font-weight-bolder">Task name :</label>
                    <input type="text" class="form-control" value="{{ $task->task_title }}" disabled>
                    <small class="text-info">
                        Created by {{$task->user->name}} -
                        {{ $task->created_at }}
                    </small>
                </div>

                <div class="form-group">
                    <label>Task description :</label>
                    <textarea class="form-control" disabled>{{ $task->task_desc }}</textarea>
                </div>

                <div class="form-group">
                    <label for="status">Status :</label>
                    @if($task->task_status == 'Done')
                    <a href="{{ route('task.undone', $task->id) }}" class="btn btn-success btn-success shadow btn-sm">Done</a>
                    <small>click to changes</small>
                    @else
                    <a href="{{ route('task.done', $task->id) }}" class="btn btn-danger shadow btn-sm">On Progress</a>
                    <small>click to changes</small>
                    @endif <br>
                    @if ($task->user_id !== null)
                    <small class="text-info">Updated by {{ $task->user->name }} - {{ $task->updated_at }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label>Priority :</label>
                    @if (!isset($task->priority))
                    <span class="badge badge-secondary">not set</span>
                    @else
                    @if($task->task_priority == 'Low')
                    <button class="btn btn-sm btn-outline-success">Low</button>
                    @elseif($task->task_priority == 'Medium')
                    <button class="btn btn-sm btn-outline-warning">Medium</button>
                    @else
                    <button class="btn btn-sm btn-outline-danger">High</button>
                    @endif
                    @endif
                </div>

                <div class="form-group">
                    <label>Type :</label>
                    @if (!isset($task->task_type))
                    <span class="badge badge-secondary">not set</span>
                    @else
                    <a class="btn btn-outline-info btn-sm" href="#">{{ $task->task_type }}</a>
                    @endif
                </div>
                <div class="form-group">
                    <label for="price">Budget :</label>
                    @if(isset($task->task_price))
                    <input type="number" class="form-control" value="{{ $task->task_price }}" disabled>
                    @else
                    <span class="badge badge-secondary">not set</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Vendor :</label>
                    @if(isset($task->task_vendor))
                    <input type="text" class="form-control" disabled value="{{ $task->task_vendor }} - {{ $task->task_vendor_phone }}">
                    @else
                    <span class="badge badge-secondary">not set</span>
                    @endif
                </div>

                @if ($task->task_status != 'Done') <div id="accordion">
                    <button class="btn btn-link btn-sm collapsed mb-2 text-decoration-none" data-toggle="collapse" data-target="#info" aria-expanded="false" aria-controls="collapseTwo">
                        <i class='fas fa-edit'></i> edit information
                    </button>

                    <div class="card">
                        <div id="info" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <form method="POST" action="{{ route('task.update', $task->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control form-control-sm" id="price" name="task_price" value="{{ $task->task_price }}">
                                        <small class="text-info">*If there are any costs</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="remark">Remark</label>
                                        <textarea name="task_remark" id="remark" class="form-control form-control-sm">{{ $task->task_remark }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary shadow" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-3">
        <div class="card my-2 shadow">
            <div class="card-body">
                <label class="font-weight-bold">Files :</label><br>
                @if($task->task_status != 'Done')
                <ol>
                    @foreach($task->file as $file)
                    <li>
                        <a href="{{ url('/public/'.$file->file) }}">{{ $file->remark }}</a>
                        <a href="" class="btn btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                    </li>
                    @endforeach
                </ol>

                <small>
                    <a class="btn btn-sm btn-link mb-2" href="#collapseAddDocument" data-toggle="collapse">
                        <i class='fas fa-edit'></i> add files</a>
                </small>

                <div class="collapse" id="collapseAddDocument">
                    <form method="POST" action="{{ route('task.addfile') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $task->id }}">

                        <div class="form-group">
                            <label for="file_desc">Document Name</label>
                            <input type="text" class="form-control" id="file_remark" name="file_remark" required>
                        </div>

                        <div class="form-group">
                            <input type="file" class="form-control-file" id="file" name="file" required>
                        </div>

                        <div class="form-group">
                            <button class="btn shadow-sm btn-primary btn-sm" type="submit">Save</button>
                        </div>
                    </form>
                </div>
                @else
                <ol>
                    @foreach($task->file as $file)
                    <li>
                        <a href="{{ url('/public/'.$file->file) }}">{{ $file->remark }}</a>
                    </li>
                    @endforeach
                </ol>
                @endif
            </div>
        </div>

        <div class="card my-2 shadow">
            <div class="card-body">
                <label class="font-weight-bolder">Assets :</label>

                @if ($task->task_status != 'Done')

                <ol>
                    @foreach($task->assetMany as $asset)
                    @if($asset->asset !== null)
                    <li>
                        <a href="{{ url('/asset/detail/'.$asset->asset->token) }}">{{ $asset->asset->name }}</a>
                        <a href="#" class="btn btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                    </li>
                    @endif
                    @endforeach
                </ol>

                <small>
                    <a class="btn btn-sm btn-link mb-2" href="#collapseAddAsset" data-toggle="collapse"><i class='fas fa-edit'></i> add assets</a><br>
                </small>

                <div class="collapse" id="collapseAddAsset">
                    <form method="POST" action="{{ route('task.update', $task->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <select class="js-example-basic-multiple custom-select form-control form-control-sm" id="tag-asset-edit" name="asset_ids[]" multiple="multiple" required style="width: 100%;">
                                @if(!isset($task->assetMany))
                                @foreach($task->assetMany as $data)
                                <option value="{{ $data->asset->id }}" selected>{{ $data->asset->name }}</option>
                                @endforeach
                                @endif
                                @foreach($assetlist as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-sm btn-primary shadow-sm" type="submit">Save</button>
                        </div>
                    </form>
                </div>
                @else
                <ol>
                    @foreach($task->assetMany as $asset)
                    @if($asset->asset !== null)
                    <li>
                        <a href="{{ url('/asset/detail/'.$asset->asset->token) }}">{{ $asset->asset->name }}</a>
                    </li>
                    @else
                    <span class="badge badge-secondary">not set</span>
                    @endif
                    @endforeach
                </ol>
                @endif
            </div>
        </div>

        <div class="card my-2 shadow">
            <div class="card-body">
                <label class="font-weight-bold">Locations :</label>

                @if ($task->task_status != 'Done')

                <ol>
                    @foreach($task->locationMany as $location)
                    @if($location->location !== null)
                    <li>
                        <a href="#">{{ $location->location->name }}</a>
                        <a href="" class="btn btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                    </li>
                    @endif
                    @endforeach
                </ol>

                <small>
                    <a class="btn btn-sm btn-link mb-2" href="#collapseAddLocation" data-toggle="collapse"><i class='fas fa-edit'></i> add crews</a><br>
                </small>

                <div class="collapse" id="collapseAddLocation">
                    <form method="POST" action="{{ route('task.update', $task->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <select class="js-example-basic-multiple custom-select form-control form-control-sm" id="tag-location-edit" name="location_ids[]" multiple="multiple" required style="width: 100%;">
                                @if(!isset($task->locationMany))
                                @foreach($task->locationMany as $data)
                                <option value="{{ $data->location->id }}" selected>{{ $data->location->name }}</option>
                                @endforeach
                                @endif

                                @foreach($locationlist as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-sm btn-primary shadow-sm" type="submit">Save</button>
                        </div>
                    </form>
                </div>
                @else
                <ol>
                    @foreach($task->locationMany as $location)
                    @if($location->location !== null)
                    <li>
                        <a href="#">{{ $location->location->name }}</a>
                    </li>
                    @else
                    <span class="badge badge-secondary">not set</span>
                    @endif
                    @endforeach
                </ol>
                @endif
            </div>
        </div>

        <div class="card my-2 shadow">
            <div class="card-body">
                <label class="font-weight-bolder">Crews :</label>
                @if ($task->task_status != 'Done')
                <ol>
                    @foreach($task->member as $member)
                    <li>
                        <a href="#">{{ $member->user->name }}</a>
                        <a href="" class="btn btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                    </li>
                    @endforeach
                </ol>

                <small>
                    <a class="btn btn-sm btn-link mb-2" href="#collapseAddCrew" data-toggle="collapse"><i class='fas fa-edit'></i> add crews</a><br>
                </small>

                <div class="collapse" id="collapseAddCrew">
                    <form method="POST" action="{{ route('task.update', $task->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <select class="js-example-basic-multiple js-states form-control" id="tag-employee-edit" name="member_ids[]" multiple="multiple" required style="width: 100%;">
                                @foreach($employeelist as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary shadow-sm" type="submit">Save</button>
                        </div>
                    </form>
                </div>

                @else
                <ol>
                    @foreach($task->member as $member)
                    <li>
                        <a href="#">{{ $member->user->name }}</a>
                    </li>
                    @endforeach
                </ol>
                @endif
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-5">
        <div class="card my-2 shadow-sm">
            <div class="card-body">
                <label class="font-weight-bolder">Updates :</label>
                <ol>
                    @foreach ($task->commentMany as $comment)
                    <li>
                        <small>{{ $comment->user->name }} {{ $comment->created_at }} </small>
                        <textarea class="form-control" disabled>{!! nl2br(e($comment->comment)) !!}</textarea>
                        <a href="{{ $comment->file }}">Check Files</a>
                    </li>
                    @endforeach
                </ol>

                <small>
                    <a class="btn btn-sm btn-link mb-2" href="#collapseAddComments" data-toggle="collapse"><i class='fas fa-edit'></i> add comments</a><br>
                </small>

                <div class="collapse" id="collapseAddComments">
                    <form method="POST" action="{{ route('task.addcomment') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $task->id }}">

                        <div class="form-group">
                            <label for="" class="font-weight-bold">Insert Image</label>
                            <input type="file" class="form-control-file" name="file">
                            <small class="text-info">image only</small>
                        </div>
                        <div class="form-group">
                            <label for="" class="font-weight-bold">Comments</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<!--  -->
@endsection

@section('js')
<script>
    $("#employee").select2({
        theme: 'bootstrap'
    });

    $("#tag-asset-edit").select2({
        theme: 'bootstrap',
        placeholder: "Select a Asset"
    });

    $("#tag-location-edit").select2({
        theme: 'bootstrap',
        placeholder: "Select a Location"
    });

    $("#tag-employee-edit").select2({
        theme: 'bootstrap',
        placeholder: "Select a Crew"
    });

    $("#assets").select2({
        theme: 'bootstrap'
    });

    $("#location").select2({
        theme: 'bootstrap'
    });

    $("#assets2").select2({
        theme: 'bootstrap'
    });

    $("#location2").select2({
        theme: 'bootstrap'
    });
</script>
@endsection