@extends('layouts.app')

@section('content')
<h1 class="h3 text-gray-800">Details Of Task</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('task.index') }}">Task List</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $task->task_title }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-5">
        <div class="card mt-3 shadow-sm">
            <div class="card-header py-3 text-primary">
                <h6 class="m-0 font-weight-bold">Task Information</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="font-weight-bold"><label for="task_desc">Title</label></td>
                        <td>
                            {{ $task->task_title }} <br>
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
                            <a href="{{ route('task.undone', $task->id) }}" class="btn btn-success shadow-sm">Done</a>
                            @else
                            <a href="{{ route('task.done', $task->id) }}" class="btn btn-danger shadow-sm">On Progress</a>
                            @endif <br>

                            @if ($task->employee_id !== null)
                            <small class="text-info">Updated by : {{ $task->employee->name }} <br> {{ $task->updated_at }}</small>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold"><label for="task_priority">Priority</label></td>
                        <td>
                            @if($task->task_priority == 'Low')
                            <span class="badge badge-success">Low</span>
                            @elseif($task->task_priority == 'Medium')
                            <span class="badge badge-warning">Medium</span>
                            @else
                            <span class="badge badge-danger">High</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold"><label for="type">Type</label></td>
                        <td>
                            <span class="badge badge-info">{{ $task->task_type }}</span>
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
                    <tr>
                        <td class="font-weight-bold"><label for="">Documents</label></td>
                        <td>
                            @if($task->task_status != 'Done')
                            <table class="table">
                                <tbody>
                                    @foreach($task->file as $file)
                                    <tr>
                                        <td><a href="{{ $file->file }}" target="_blank">{{ $file->remark }}</a><br></td>
                                        <td class="text-right"> <a href="" class="btn btn-danger btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

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
                                    <button class="btn shadow-sm btn-primary btn-sm" type="submit">+add file</button>
                                </div>
                            </form>
                            @else
                            <table class="table">
                                <tbody>
                                    @foreach($task->file as $file)
                                    <tr>
                                        <td><a href="{{ $file->file }}" target="_blank">{{ $file->remark }}</a><br></td>
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
                            <table class="table table-sm table-bordered">
                                <tbody>
                                    @if($task->assetMany == null)
                                    <small class="text-center text-danger">Aset belum ditambahkan</small>
                                    @endif

                                    @foreach($task->assetMany as $asset)
                                    @if($asset->asset !== null)
                                    <tr>
                                        <td><a href="#">{{ $asset->asset->name }}</a></td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-danger btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <form method="POST" action="{{ route('task.update', $task->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <select class="js-example-basic-multiple custom-select form-control form-control-sm" id="tag-asset-edit" name="asset_ids[]" multiple="multiple" required>
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
                                    <button class="btn btn-sm btn-primary shadow-sm" type="submit">+ add asset</button>
                                </div>
                            </form>

                            @else

                            <table class="table table-sm table-bordered">
                                <tbody>
                                    @if($task->assetMany == null)
                                    <small class="text-center text-danger">Aset belum ditambahkan</small>
                                    @endif

                                    @foreach($task->assetMany as $asset)
                                    @if($asset->asset !== null)
                                    <tr>
                                        <td><a href="#">{{ $asset->asset->name }}</a></td>
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
                            <table class="table table-sm">
                                <tbody>
                                    @if($task->locationMany == null)
                                    <small class="text-danger">Lokasi belum ditambahkan</small>
                                    @endif

                                    @foreach($task->locationMany as $location)
                                    @if($location->location !== null)
                                    <tr>
                                        <td><a href="#">{{ $location->location->name }}</a></td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-danger btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <form method="POST" action="{{ route('task.update', $task->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <select class="js-example-basic-multiple custom-select form-control form-control-sm" id="tag-location-edit" name="location_ids[]" multiple="multiple" required>
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
                                    <button class="btn btn-sm btn-primary shadow-sm" type="submit">+ add location</button>
                                </div>
                            </form>
                            @else
                            <table class="table table-sm">
                                <tbody>
                                    @if($task->locationMany == null)
                                    <small class="text-danger">Lokasi belum ditambahkan</small>
                                    @endif

                                    @foreach($task->locationMany as $location)
                                    @if($location->location !== null)
                                    <tr>
                                        <td><a href="#">{{ $location->location->name }}</a></td>
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
                            <table class="table table-sm">
                                <tbody>
                                    @foreach($task->member as $member)
                                    <tr>
                                        <td>
                                            <a href="#">{{ $member->employee->name }}</a>
                                        </td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-danger btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            <form method="POST" action="{{ route('task.update', $task->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <select class="js-example-basic-multiple js-states form-control" id="tag-employee-edit" name="member_ids[]" multiple="multiple" required>
                                        @foreach($employeelist as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-sm btn-primary shadow-sm" type="submit">+ add crew</button>
                                </div>
                            </form>
                            @else
                            <table class="table table-sm">
                                <tbody>
                                    @foreach($task->member as $member)
                                    <tr>
                                        <td>
                                            <a href="#">{{ $member->employee->name }}</a>
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            @endif
                        </td>
                    </tr>
                </table>

                @if ($task->task_status != 'Done') <div id="accordion">
                    <button class="btn btn-primary btn-sm collapsed mb-2 shadow-sm-none text-decoration-none" data-toggle="collapse" data-target="#info" aria-expanded="false" aria-controls="collapseTwo">
                        <b>+</b> edit information
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

    <div class="col-sm-12 col-md-12 col-lg-5">
        <div class="card mt-3 shadow-sm">
            <div class="card-header py-3 text-primary">
                <h6 class="m-0 font-weight-bold">Task Timeline</h6>
            </div>
            <div class="card-body">
                <div class="media">
                    <img class="d-flex mr-3" data-src="holder.js/64x64?theme=sky" alt="64x64" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_18c87c0112a%20text%20%7B%20fill%3A%23FFFFFF%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_18c87c0112a%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%230D8FDB%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.17521858215332%22%20y%3D%2236.55999994277954%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="width: 64px; height: 64px;">
                    <div class="media-body">
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <br>

                <form action="">
                    <div class="form-group">
                        <label for=""  class="font-weight-bold">Insert Image</label>
                        <input type="file" class="form-control-file" name="">
                        <small class="text-info">image only</small>
                    </div>
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">+ add timeline</button>
                    </div>
                </form>
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