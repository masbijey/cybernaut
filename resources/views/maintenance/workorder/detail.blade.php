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
    <div class="col-sm-12 col-md-12 col-lg-5">
        <div class="card mt-3 shadow-sm">
            <div class="card-header py-3 text-primary">
                <h6 class="m-0 font-weight-bold text-primary">Work Order Information</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
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
                        <td>{{ $workorder->description }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Status</td>
                        <td>
                            @if($workorder->status == 'Done')
                            <a href="#" class="btn btn-success">Done</a><br>
                            <small>{{ $workorder->end_date }}</small> <br>
                            <small>by {{ $workorder->user->name }}</small>
                            @else
                            <a href="#" class="btn btn-warning">On Progress</a>
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
                <h6 class="m-0 font-weight-bold text-primary">Timeline</h6>
            </div>
            <div class="card-body">
                <div class="media">
                    <img class="d-flex mr-3" data-src="holder.js/64x64?theme=sky" alt="64x64" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_18c87c0112a%20text%20%7B%20fill%3A%23FFFFFF%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_18c87c0112a%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%230D8FDB%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.17521858215332%22%20y%3D%2236.55999994277954%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="width: 64px; height: 64px;">
                    <div class="media-body">
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <br>

                <form method="POST" action="{{ route('workorder.addfile') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $workorder->id }}">

                    <div class="form-group">
                        <label for="" class="font-weight-bold">Insert Image</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                        <small class="text-info">image only</small>
                    </div>

                    <div class="form-group">
                        <label for="file_remark" class="font-weight-bold">Description</label>
                        <textarea name="file_remark" id="file_remark" class="form-control" required placeholder="enter comment or description here.."></textarea>
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