@extends('layouts.app')

@section('title')
Workoder detail | {{ $workorder->title }}
@endsection

@section('content')
<h3 class="h3 text-gray-800">Work Order Details</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('workorder.index') }}">Work Order List</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $workorder->title }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="card mb-2 shadow">
            <div class="card-header bg-primary text-light">
                <h6 class="m-0 font-weight-bold">Work Order Information</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td class="font-weight-bold">No. Work Order</td>
                        <td>
                            <p class="text-danger font-weight-bold">{{ $workorder->order_no }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Title</td>
                        <td>
                            {{ $workorder->title }}
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Due date</td>
                        <td>
                            <p>{!! nl2br(e($workorder->due_date)) !!}</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Description</td>
                        <td>
                            <p>{!! nl2br(e($workorder->description)) !!}</p>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Prioriy</td>
                        <td>
                            @if($workorder->prioriy == 'Low')
                            <span class="badge badge-success">Low</span>
                            @elseif($workorder->priority == 'medium')
                            <span class="badge badge-warning">Medium</span>
                            @else
                            <span class="badge badge-danger">High</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Progress</td>
                        <td>
                            @if ($workorder->status == 'Open')
                            <button type="button" class="btn btn-danger shadow-sm btn-sm" data-toggle="modal" data-target="#openModal">
                                Open
                            </button>

                            <div class="modal" id="openModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">WO Receive Confirmation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <form method="POST" action="{{ route('workorder.received') }}" enctype="multipart/form-data">
                                            @csrf

                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="{{ $workorder->id }}">
                                                <input type="hidden" name="receivedBy" value="{{ Auth::user()->id }}">

                                                <div class="form-group">
                                                    <input type="checkbox" id="checkbox" required>
                                                    <label for="checkbox">I have received this work order. [{{ Auth::user()->name }}]</label>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary shadow">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            @elseif ($workorder->status == 'On Progress')
                            <button type="button" class="btn btn-warning shadow-sm btn-sm" data-toggle="modal" data-target="#onProgressModal">
                                On Progress
                            </button>

                            <div class="modal" id="onProgressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Completion Confirmation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <form method="POST" action="{{ route('workorder.done') }}" enctype="multipart/form-data">
                                            @csrf

                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="{{ $workorder->id }}">

                                                <div class="form-group">
                                                    <label class="font-weight-bolder">Upload image :</label>
                                                    <input type="file" class="form-control-file" id="file" name="file" required>
                                                    <small class="text-info">Masukkan foto bukti pekerjaan telah selesai.</small>
                                                </div>

                                                <div class="form-group">
                                                    <label class="font-weight-bolder">Finished by :</label>
                                                    <select class="js-example-basic-multiple js-states form-control" id="tag-employee-edit" name="member_ids[]" multiple="multiple" style="width: 100%;" required>
                                                        @foreach($employeelist as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary shadow">Yes, It's Done !</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @else ($workorder->status == 'Done')
                            <a href="#" class="btn btn-success btn-sm">Done</a>
                            @endif

                            <small class="">
                                <a href="#collapseExample" class="text-decoration-none" data-toggle="collapse"> <i class="fas fa-exclamation"></i> info</a><br>
                            </small>

                            @if ($workorder->status !== 'Done')
                            <small class="text-info">press button to change.</small>
                            @endif

                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <small class="text-info">
                                        created by <b>{{ $workorder->createdBy->name }}</b> at <b>{{ $workorder->created_at }}</b> <br>

                                        @if ($workorder->receivedBy !== null)
                                        received by <b> {{ $workorder->receivedBy->name }}</b> at <b>{{ $workorder->received_date }}</b> <br>
                                        @endif

                                        @if ($workorder->finishedBy !== null)
                                        finished by <b>{{ $workorder->finishedBy->name }}</b> at <b>{{ $workorder->finished_date }}</b>
                                        @endif

                                    </small>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">To Departments</td>
                        <td>
                            @if ($workorder->status !== 'Done')
                            <table class="table table-sm table-borderless table-hover">
                                <tbody>
                                    @foreach ($workorder->departmentMany as $department)
                                    @if ($department->department !== null)
                                    <tr>
                                        <td><a href="#">{{ $department->department->name }}</a></td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <small class="">
                                <a href="#collapseAddDepartment" data-toggle="collapse"><i class='fas fa-edit'></i> add departments</a><br>
                            </small>

                            <div class="collapse" id="collapseAddDepartment">
                                <div class="card card-body">
                                    <form method="POST" action="{{ route('workorder.addrelation') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $workorder->id }}">
                                        <div class="form-group">
                                            <select class="js-example-basic-multiple custom-select" id="select-dept-add" name="department_ids[]" multiple="multiple" style="width: 100%;" required>
                                                @if(!isset($workorder->departmentMany))
                                                @foreach($workorder->departmentMany as $data)
                                                <option value="{{ $data->location->id }}" selected>{{ $data->department->name }}</option>
                                                @endforeach
                                                @endif

                                                @foreach($departmentlist as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary shadow">Save</button>
                                    </form>
                                </div>
                            </div>

                            @else
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    @foreach($workorder->departmentMany as $department)
                                    @if($department->department !== null)
                                    <tr>
                                        <td><a href="#">{{ $department->department->name }}</a></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="card mb-2 shadow">
            <div class="card-header bg-primary text-light">
                <h6 class="m-0 font-weight-bold">Related Information</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td class="font-weight-bold">Locations</td>
                        <td>
                            @if ($workorder->status !== 'Done')
                            <table class="table table-borderless table-hover">
                                <tbody>
                                    @foreach($workorder->locationMany as $location)
                                    @if($location->location !== null)
                                    <tr>
                                        <td><a href="#">{{ $location->location->name }}</a></td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <small class="">
                                <a href="#collapseAddLocation" data-toggle="collapse"><i class='fas fa-edit'></i> add location</a><br>
                            </small>

                            <div class="collapse" id="collapseAddLocation">
                                <div class="card card-body">
                                    <form method="POST" action="{{ route('workorder.addrelation') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $workorder->id }}">
                                        <div class="form-group">
                                            <select class="js-example-basic-multiple custom-select form-control form-control-sm" id="select-location-add" name="location_ids[]" multiple="multiple" style="width: 100%;">
                                                @if(!isset($workorder->locationMany))
                                                @foreach($workorder->locationMany as $data)
                                                <option value="{{ $data->location->id }}" selected>{{ $data->location->name }}</option>
                                                @endforeach
                                                @endif

                                                @foreach($locationlist as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary shadow btn-sm">Save</button>
                                    </form>
                                </div>
                            </div>

                            @else
                            <table class="table table-borderless">
                                <tbody>
                                    @if($workorder->locationMany == null)
                                    <small class="text-danger">Location belum ditambahkan</small>
                                    @endif

                                    @foreach($workorder->locationMany as $location)
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
                        <td class="font-weight-bold">Assets</td>
                        <td>
                            @if ($workorder->status !== 'Done')
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    @foreach($workorder->assetMany as $asset)
                                    @if($asset->asset !== null)
                                    <tr>
                                        <td>{{ $asset->asset->name }}</td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <small class="">
                                <a href="#collapseAddAsset" data-toggle="collapse"><i class='fas fa-edit'></i> add assets</a><br>
                            </small>

                            <div class="collapse" id="collapseAddAsset">
                                <div class="card card-body">
                                    <form method="POST" action="{{ route('workorder.addrelation') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $workorder->id }}">
                                        <div class="form-group">
                                            <select class="js-example-basic-multiple custom-select" id="select-asset-add" name="asset_ids[]" multiple="multiple" required style="width: 100%;">
                                                @if(!isset($workorder->assetMany))
                                                @foreach($workorder->assetMany as $data)
                                                <option value="{{ $data->asset->id }}" selected>{{ $data->asset->name }}</option>
                                                @endforeach
                                                @endif

                                                @foreach($assetlist as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary shadow btn-sm">Save</button>
                                    </form>
                                </div>
                            </div>

                            @else

                            <table class="table table-sm table-borderless">
                                <tbody>
                                    @foreach($workorder->assetMany as $asset)
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
                        @if ($workorder->status !== 'Done')
                        @else
                        <td class="font-weight-bold">Finished by</td>
                        <td>
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    @foreach($workorder->memberMany as $member)
                                    @if($member->employee !== null)
                                    <tr>
                                        <td><a href="#">{{ $member->employee->name }}</a></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        @endif
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="card mb-2 shadow">
            <div class="card-header bg-primary text-light">
                <h6 class="m-0 font-weight-bold">Comments</h6>
            </div>
            <div class="card-body">
                @foreach($workorder->commentMany as $comment)
                <div class="media mb-0">
                    <a href="{{ $comment->file }}" target="_blank"><img class="d-flex mr-3" data-src="holder.js/64x64?theme=sky" alt="64x64" src="{{ $comment->file }}" data-holder-rendered="true" style="width: 64px; height: 64px;"></a>
                    <div class="media-body">
                        <small class="text-info">{{ $comment->employee->name }} | {{ $comment->created_at }} </small>
                        <p>{!! nl2br(e($comment->description)) !!}</p>
                    </div>
                </div>
                <hr>
                @endforeach

                <small class="">
                    <a href="#collapseAddComment" data-toggle="collapse"><i class='fas fa-edit'></i> add comments</a><br>
                </small>

                <div class="collapse" id="collapseAddComment">
                    <div class="card card-body">
                        <form method="POST" action="{{ route('workorder.addcomment') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $workorder->id }}">

                            <div class="form-group">
                                <label for="" class="font-weight-bold">Insert Image <small class="text-danger">*</small></label>
                                <input type="file" class="form-control-file" id="file" name="file" required>
                                <small class="text-info">image only</small>
                            </div>

                            <div class="form-group">
                                <label for="file_remark" class="font-weight-bold">Description <small class="text-danger">*</small></label>
                                <textarea name="description" id="file_remark" class="form-control" required rows="5"></textarea>
                            </div>

                            <button class="btn shadow btn-primary btn-sm" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('css')
@endsection

@section('js')
<script>
    $("#employee").select2({
        theme: 'bootstrap'
    });

    $("#tag-asset-edit").select2({
        theme: 'bootstrap'
    });

    $("#tag-location-edit").select2({
        theme: 'bootstrap'
    });

    $("#wo-add-assets").select2({
        theme: 'bootstrap'
    });

    $("#select-dept-add").select2({
        theme: 'bootstrap',
        placeholder: "Select department"
    });

    $("#select-location-add").select2({
        theme: 'bootstrap',
        placeholder: "Select location"
    });

    $("#select-asset-add").select2({
        theme: 'bootstrap',
        placeholder: "Select asset"
    });


    $("#tag-employee-edit").select2({
        theme: 'bootstrap'
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