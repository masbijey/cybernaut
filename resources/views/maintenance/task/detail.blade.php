@extends('layouts.app')

@section('content')
<h1 class="h3 text-gray-800">TASK INFORMATION</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('task.index') }}">Task List</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $task->task_title }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="card my-2 shadow-sm">
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="font-weight-bold"><label for="task_desc">Title</label></td>
                        <td>
                            <b>{{ $task->task_title }}</b> <br>
                            <small class="text-info">
                                Created by {{$task->user->name}} <br>
                                {{ $task->created_at }}
                            </small>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold"><label for="task_desc">Description</label></td>
                        <td>{{ $task->task_desc }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold"><label for="status">Status</label></td>
                        <td>
                            @if($task->task_status == 'Done')
                            <a href="{{ route('task.undone', $task->id) }}" class="btn btn-success btn-success shadow-sm">Done</a>
                            @else
                            <a href="{{ route('task.done', $task->id) }}" class="btn btn-danger shadow-sm">On Progress</a>
                            @endif <br>

                            @if ($task->user_id !== null)
                            <small class="text-info">Updated by : {{ $task->user->name }} <br> {{ $task->updated_at }}</small>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold"><label for="task_priority">Priority</label></td>
                        <td>
                            @if($task->task_priority == 'Low')
                            <button class="btn btn-sm btn-outline-success">Low</button>

                            @elseif($task->task_priority == 'Medium')
                            <button class="btn btn-sm btn-outline-warning">Medium</button>

                            @else
                            <button class="btn btn-sm btn-outline-danger">High</button>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold"><label for="type">Type</label></td>
                        <td>
                            <a class="btn btn-outline-info btn-sm" href="#">{{ $task->task_type }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold"><label for="price">Budget</label></td>
                        <td>
                            @if($task->task_price !== null)
                            {{ $task->task_price }}
                            @else
                            <i>-</i>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold"><label for="">Vendor</label></td>
                        <td>
                            @if($task->task_vendor !== null)
                            {{ $task->task_vendor }} / {{ $task->task_vendor_phone }}
                            @endif
                        </td>
                    </tr>
                </table>

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
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><label for="price">Price</label></td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm" id="price" name="task_price" value="{{ $task->task_price }}">
                                                <small class="text-info">*If there are any costs</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="remark">Remark</label></td>
                                            <td>
                                                <textarea name="task_remark" id="remark" class="form-control form-control-sm">{{ $task->task_remark }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button class="btn btn-primary shadow-sm btn-sm" type="submit">Save</button>
                                            </td>
                                        </tr>
                                    </table>
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
        <div class="card my-2 shadow-sm">
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td class="font-weight-bold"><label for="">Files</label></td>
                        <td>
                            @if($task->task_status != 'Done')
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    @foreach($task->file as $file)
                                    <tr>
                                        <td><a href="{{ $file->file }}" target="_blank">{{ $file->remark }}</a><br></td>
                                        <td class="text-right"> <a href="" class="btn btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <small><a class="btn btn-sm btn-link mb-2" href="#collapseAddDocument" data-toggle="collapse"><i class='fas fa-edit'></i> add document</a><br></small>

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
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    @foreach($task->file as $file)
                                    <tr>
                                        <td><a class="btn btn-sm btn-outline-secondary" href="{{ $file->file }}" target="_blank">{{ $file->remark }}</a><br></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold"><label for="">Assets</label></td>
                        <td>
                            @if ($task->task_status != 'Done')
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    @if($task->assetMany == null)
                                    <small class="text-center text-danger">Aset belum ditambahkan</small>
                                    @endif

                                    @foreach($task->assetMany as $asset)
                                    @if($asset->asset !== null)
                                    <tr>
                                        <td><a href="#">{{ $asset->asset->name }}</a></td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <small class="">
                                <a class="btn btn-sm btn-link mb-2" href="#collapseAddAsset" data-toggle="collapse"><i class='fas fa-edit'></i> add asset</a><br>
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
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    @if($task->assetMany == null)
                                    <small class="text-center text-danger">Aset belum ditambahkan</small>
                                    @endif

                                    @foreach($task->assetMany as $asset)
                                    @if($asset->asset !== null)
                                    <tr>
                                        <td><a class="btn btn-sm btn-outline-secondary" href="#">{{ $asset->asset->name }}</a></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold"><label for="">Locations</label></td>
                        <td>
                            @if ($task->task_status != 'Done')
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    @if($task->locationMany == null)
                                    <small class="text-danger">Lokasi belum ditambahkan</small>
                                    @endif

                                    @foreach($task->locationMany as $location)
                                    @if($location->location !== null)
                                    <tr>
                                        <td><a href="#">{{ $location->location->name }}</a></td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <small class="">
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
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    @if($task->locationMany == null)
                                    <small class="text-danger">Lokasi belum ditambahkan</small>
                                    @endif

                                    @foreach($task->locationMany as $location)
                                    @if($location->location !== null)
                                    <tr>
                                        <td><a class="btn btn-sm btn-outline-secondary" href="#">{{ $location->location->name }}</a></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold"><label for="">Crews</label></td>
                        <td>
                            @if ($task->task_status != 'Done')
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    @foreach($task->member as $member)
                                    <tr>
                                        <td>
                                            <a href="#">{{ $member->user->name }}</a>
                                        </td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>

                            <small class="">
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
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    @foreach($task->member as $member)
                                    <tr>
                                        <td>
                                            <a class="btn btn-sm btn-outline-secondary" href="#">{{ $member->user->name }}</a>
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-5">
        <div class="card my-2 shadow-sm">
            <div class="card-body">
                @foreach ($task->commentMany as $comment)

                <div class="media mb-2">
                    <img class="d-flex mr-3" alt="64x64" src="{{ $comment->file }}" data-holder-rendered="true" style="width: 64px; height: 64px;">
                    <div class="media-body">
                        <small class="text-info">{{ $comment->user->name }} | {{ $comment->created_at }} </small>
                        <p>{!! nl2br(e($comment->comment)) !!}</p>
                    </div>
                </div>

                @endforeach
                <small class="">
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