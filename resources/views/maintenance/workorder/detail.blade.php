@extends('layouts.app')

@section('content')
<h1 class="h3 text-gray-800">Details of Work Order</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('workorder.index') }}">Work Order List</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $workorder->title }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="card mt-3 shadow-sm">
            <div class="card-header py-3 text-primary">
                <h6 class="m-0 font-weight-bold text-primary">Work Order Information</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
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
                            <br>
                            <small class="text-info">
                                Created by {{ $workorder->user->name }} <br>
                                {{ $workorder->created_at }}
                            </small>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Description</td>
                        <td>
                            <p>{!! nl2br(e($workorder->description)) !!}</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Status</td>
                        <td>
                            @if($workorder->status == 'Done')
                            <a href="#" class="btn btn-success shadow">Done</a> <br>
                            @else
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                On Progress
                            </button>

                            <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin menyelesaikan WO ini ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <form method="POST" action="{{ route('workorder.done') }}" enctype="multipart/form-data">
                                            @csrf

                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="{{ $workorder->id }}">
                                                <small class="text-info">Masukkan foto bukti pekerjaan telah selesai.</small>
                                                <div class="form-group">
                                                    <input type="file" class="form-control-file" id="file" name="file" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success shadow">Yes, It's Done !</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @endif
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
                        <td class="font-weight-bold">Locations</td>
                        <td>
                            <table class="table table-sm">
                                <tbody>
                                    @if($workorder->locationMany == null)
                                    <small class="text-danger">Location belum ditambahkan</small>
                                    @endif

                                    @foreach($workorder->locationMany as $location)
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
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Assets</td>
                        <td>
                            <table class="table table-sm">
                                <tbody>
                                    @if($workorder->assetMany == null)
                                    <small class="text-danger">Asset belum ditambahkan</small>
                                    @endif

                                    @foreach($workorder->assetMany as $asset)
                                    @if($asset->asset !== null)
                                    <tr>
                                        <td>{{ $asset->asset->name }}</td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-danger btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Departments</td>
                        <td>
                            <table class="table table-sm">
                                <tbody>
                                    @if($workorder->departmentMany == null)
                                    <small class="text-danger">Department belum ditambahkan</small>
                                    @endif

                                    @foreach($workorder->departmentMany as $department)
                                    @if($department->department !== null)
                                    <tr>
                                        <td>{{ $department->department->name }}</td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-danger btn-sm" data-placement="top" title="Hapus"><i class='fas fa-trash'></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-5">
        <div class="card mt-3 shadow-sm">
            <div class="card-header py-3 text-primary">
                <h6 class="m-0 font-weight-bold text-primary">Comments</h6>
            </div>
            <div class="card-body">
                @if($workorder->commentMany !== null)
                @foreach($workorder->commentMany as $comment)

                <div class="media">
                    <a href="{{ $comment->file }}" target="_blank"><img class="d-flex mr-3" data-src="holder.js/64x64?theme=sky" alt="64x64" src="{{ $comment->file }}" data-holder-rendered="true" style="width: 64px; height: 64px;"></a>
                    <div class="media-body">
                        <small class="text-info">{{ $comment->employee->name }} | {{ $comment->created_at }} </small>
                        <p>{!! nl2br(e($comment->description)) !!}</p>
                    </div>
                </div>

                @endforeach
                @else
                <small class="text-danger">Belum ada komentar</small>
                @endif

                <hr>
                <h5>Add Comments</h5>
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