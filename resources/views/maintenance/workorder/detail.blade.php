@extends('layouts.app')

@section('title')
Tickets detail | {{ $workorder->title }}
@endsection

@section('content')
<h3 class="h3 text-gray-800">Tickets Detail</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('workorder.index') }}">Ticket List</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $workorder->title }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-8">
        <div class="card mb-3 shadow">
            <div class="card-body">
                <table class="table table-hover" style="width: 100%;">
                    <tr>
                        <td class="font-weight-bold">No. Ticket</td>
                        <td class="font-weight-bold text-success">
                            {{ $workorder->order_no }}
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Due date</td>
                        <td>
                            <input type="text" class="form-control" disabled value="{{ \Carbon\Carbon::parse($workorder->due_date)->format('d M Y') }}">
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Subject</td>
                        <td>
                            <input type="text" disabled value="{{ $workorder->title }}" class="form-control font-weight-bolder">
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Description</td>
                        <td>
                            <textarea disabled class="form-control">{{ $workorder->description }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Priority </td>
                        <td>
                            @php
                            $priorities = ['Low', 'Medium', 'High'];
                            @endphp

                            @foreach($priorities as $priority)
                            <button class="btn btn-sm btn-{{ $workorder->priority == $priority ? 'success' : 'secondary' }} shadow"
                                {{ $workorder->priority == $priority ? '' : 'disabled' }}>
                                {{ $priority }}
                            </button>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Progress </td>
                        <td>
                            @if ($workorder->status == 'Open')
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#openModal">
                                Open
                            </button>

                            <button type="button" class="btn btn-secondary btn-sm" disabled data-toggle="modal" data-target="#openModal">
                                On Progress
                            </button>

                            <button type="button" class="btn btn-secondary btn-sm" disabled data-toggle="modal" data-target="#openModal">
                                Done
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
                                                    <label for="checkbox">I have received this tickets. [{{ Auth::user()->name }}]</label>
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

                            <button type="button" class="btn btn-secondary btn-sm" disabled data-toggle="modal" data-target="#onProgressModal">
                                Open
                            </button>

                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#onProgressModal">
                                On Progress
                            </button>

                            <button type="button" class="btn btn-secondary btn-sm" disabled data-toggle="modal" data-target="#onProgressModal">
                                Done
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
                                                        @foreach($userlist as $data)
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
                            <button class="btn btn-secondary btn-sm shadow" disabled>Open</button>
                            <button class="btn btn-secondary btn-sm shadow" disabled>On Progress</button>
                            <button class="btn btn-success btn-sm shadow">Done</button>
                            @endif

                            <br>

                            <small>
                                Log File :
                                <ol>
                                    <li>
                                        created by <b>{{ $workorder->createdBy->name }}</b> at <b>{{ $workorder->created_at }}</b>
                                    </li>
                                    <li>
                                        @if ($workorder->receivedBy !== null)
                                        received by <b> {{ $workorder->receivedBy->name }}</b> at <b>{{ $workorder->received_date }}</b>
                                        @else
                                        received by <i>null</i>
                                        @endif
                                    </li>
                                    <li>
                                        @if ($workorder->finishedBy !== null)
                                        finished by <b>{{ $workorder->finishedBy->name }}</b> at <b>{{ $workorder->finished_date }}</b>
                                        @else
                                        finished by <i>null</i>
                                        @endif
                                    </li>
                                </ol>
                            </small>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="card mb-3 shadow">
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td class="font-weight-bold">Departments :</td>
                        <td>
                            @if ($workorder->status !== 'Done')
                            <table class="table table-sm table-borderless table-hover">
                                <tbody>
                                    @foreach ($workorder->departmentMany as $department)
                                    @if ($department->department !== null)
                                    <tr>
                                        <td><a href="#">{{ $department->department->name }}</a></td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-sm text-decoration-none" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
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
                                        <td><a class="btn btn-sm btn-outline-secondary" href="#">{{ $department->department->name }}</a></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Locations :</td>
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
                        <td class="font-weight-bold">Assets :</td>
                        <td>
                            @if ($workorder->status !== 'Done')
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    @foreach($workorder->assetMany as $asset)
                                    @if($asset->asset !== null)
                                    <tr>
                                        <td><a href="#">{{ $asset->asset->name }}</a></td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
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
                        <td class="font-weight-bold">Finished by :</td>
                        <td>
                            @if ($workorder->status !== 'Done')
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    @foreach($workorder->memberMany as $member)
                                    @if($member->user !== null)
                                    <tr>
                                        <td><a href="#">{{ $member->user->name }}</a></td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <small class="">
                                <a href="#collapseAddMember" data-toggle="collapse"><i class='fas fa-edit'></i> add people</a><br>
                            </small>

                            <div class="collapse" id="collapseAddMember">
                                <div class="card card-body">
                                    <form method="POST" action="{{ route('workorder.addrelation') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $workorder->id }}">
                                        <div class="form-group">
                                            <select class="js-example-basic-multiple custom-select" id="select-member-add" name="member_ids[]" multiple="multiple" required style="width: 100%;">
                                                @if(!isset($workorder->memberMany))
                                                @foreach($workorder->memberMany as $data)
                                                <option value="{{ $data->member->id }}" selected>{{ $data->member->name }}</option>
                                                @endforeach
                                                @endif

                                                @foreach($userlist as $data)
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
                                    @foreach($workorder->memberMany as $member)
                                    @if($member->user !== null)
                                    <small>
                                        <ol>
                                            <li>{{ $member->user->name }}</li>
                                        </ol>
                                    </small>
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

        <div class="card mb-3 shadow">

            <div class="card-body">
                @foreach($workorder->commentMany as $comment)
                <div class="media mb-0">
                    <a href="{{ $comment->file }}" target="_blank"><img class="d-flex mr-3" data-src="holder.js/64x64?theme=sky" alt="64x64" src="{{ $comment->file }}" data-holder-rendered="true" style="width: 64px; height: 64px;"></a>
                    <div class="media-body">
                        <small class="text-info">{{ $comment->user->name }} | {{ $comment->created_at }} </small>
                        <p>{!! nl2br(e($comment->comment)) !!}</p>
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

    $("#select-member-add").select2({
        theme: 'bootstrap',
        placeholder: "Select member"
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