@extends('layouts.app')

@section('content')
<h1 class="h3 text-gray-800">DETAIL WORK ORDER</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('workorder.index') }}">Work Order List</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $workorder->title }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-4">
        <div class="card mt-2 shadow">
            <div class="card-header py-3 text-primary">
                <h6 class="m-0 font-weight-bold text-primary">Work Order Information</h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td class="font-weight-bold">Title</td>
                        <td>{{ $workorder->title }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Created by</td>
                        <td>{{ $workorder->employee->name }} <br>
                            <small>{{ $workorder->created_at }}</small>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Description</td>
                        <td>{{ $workorder->description }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Location</td>
                        <td>
                            @if(isset($workorder->location_id))
                                {{ $workorder->location->name }}
                            @else
                                <i>null</i>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Asset</td>
                        <td>
                            @if(isset($workorder->asset_id))
                                {{ $workorder->asset->name }}
                            @else
                                <i>null</i>
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
                        <td class="font-weight-bold">Status</td>
                        <td>
                            @if($workorder->status == 'Done')
                                <a href="#" class="btn btn-success btn-sm">Done</a><br>
                                <small>{{ $workorder->end_date }}</small> <br>
                                <small>by {{ $workorder->user->name }}</small>
                            @else
                                <a href="#" class="btn btn-warning btn-sm">On Progress</a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Department</td>
                        <td>{{ $workorder->department->name }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card mt-2 shadow">
            <div class="card-header py-3 text-primary">
                <h6 class="m-0 font-weight-bold text-primary">Timeline</h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="font-weight-bold">
                        <tr>
                            <td width="10%">No.</td>
                            <td width="20%">File</td>
                            <td>Description</td>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td>1</td>
                            <td><a href="#">show</a></td>
                            <td>Tutorial to learn the steps for installing PHP Laravel framework on Ubuntu 22.04 LTS
                                Jammy JellyFish using the command terminal for developing web apps.</td>
                        </tr>
                    </tbody>
                </table>

                <div id="accordion">
                    <button class="btn btn-primary btn-icon-split collapsed mb-2 shadow-none text-decoration-none"
                        data-toggle="collapse" data-target="#file" aria-expanded="false" aria-controls="collapseTwo">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">New Comment</span>                    
                    </button>

                    <div class="card">
                        <div id="file" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <form method="POST" action="{{ route('workorder.addfile') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $workorder->id }}">

                                    <div class="form-group">
                                        <label for="" class="font-weight-bold">Add File</label>
                                        <input type="file" class="form-control-file" id="file" name="file">
                                    </div>

                                    <div class="form-group">
                                        <label for="file_remark" class="font-weight-bold">Description</label>
                                        <textarea name="file_remark" id="file_remark" class="form-control" required
                                            placeholder="enter comment or description here.."></textarea>
                                        <small class="text-info">ex: after/before, contract, invoice, etc</small>
                                        @if($errors->has('file_remark'))
                                            <small
                                                class="form-text text-danger">{{ $errors->first('file_remark') }}</small>
                                        @endif
                                    </div>

                                    <button class="btn shadow btn-primary btn-sm" type="submit">Save</button>
                                </form>
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
