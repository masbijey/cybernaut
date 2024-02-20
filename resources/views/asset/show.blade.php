@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between">
    <h1 class="h3 text-gray-800">ASSET INFORMATION</h1>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('asset.index') }}">Assets List</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $data->name }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="card shadow mb-3">
            <div class="card-body">
                <div class="mb-3 text-center">
                    <img src="{{ $data->file }}" class="img-fluid" alt="Responsive image" width="200px">
                </div>

                <table class="table table-sm table-hover">
                    <tr>
                        <td><label for="name" class="font-weight-bold">Created At</label></td>
                        <td>{{ $data->created_at }}</td>
                    </tr>
                    <tr>
                        <td><label for="name" class="font-weight-bold">Name</label></td>
                        <td>{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <td><label for="category" class="font-weight-bold">Category</label></td>
                        <td>{{ $data->category->name }}</td>
                    </tr>
                    <tr>
                        <td><label for="merk" class="font-weight-bold">Merk</label></td>
                        <td>{{ $data->merk }}</td>
                    </tr>
                    <tr>
                        <td><label for="type" class="font-weight-bold">Type</label></td>
                        <td>{{ $data->type }}</td>
                    </tr>
                    <tr>
                        <td><label for="serialNumber" class="font-weight-bold">Serial Number</label></td>
                        <td>{{ $data->serialNumber }}</td>
                    </tr>
                    <tr>
                        <td><label for="vendorName" class="font-weight-bold">Vendor Name</label></td>
                        <td>{{ $data->vendorName }}</td>
                    </tr>
                    <tr>
                        <td><label for="vendorPhone" class="font-weight-bold">Vendor Phone</label></td>
                        <td>{{ $data->vendorPhone }}</td>
                    </tr>
                    <tr>
                        <td><label for="vendorAddress" class="font-weight-bold">Vendor Address</label></td>
                        <td>{{ $data->vendorAddress }}</td>
                    </tr>
                    <tr>
                        <td><label for="buyDate" class="font-weight-bold">Purchase Date</label></td>
                        <td>{{ $data->buyDate }}</td>
                    </tr>
                    <tr>
                        <td><label for="buyPrice" class="font-weight-bold">Purchase Price</label></td>
                        <td>
                            IDR {{ number_format($data->buyPrice, 2, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td><label for="status" class="font-weight-bold">Purchase Condition</label></td>
                        <td>
                            <span class="badge badge-success">{{ $data->buyCond }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="remark" class="font-weight-bold">Remark</label></td>
                        <td>{{ $data->remark }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-8">
        <div class="card shadow mb-3">
            <div class="card-header text-primary py-3">
                <h6 class="m-0 font-weight-bold">Task History</h6>
            </div>
            <div class="card-body">

            </div>
        </div>

        <div class="card shadow mb-3">
            <div class="card-header text-primary py-3">
                <h6 class="m-0 font-weight-bold">Work Order History</h6>
            </div>
            <div class="card-body">

            </div>
        </div>

        <div class="card shadow mb-3">
            <div class="card-header text-primary py-3">
                <h6 class="m-0 font-weight-bold">Allocation History</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover table-sm" id="table-allocation">
                    <thead>
                        <tr>
                            <th>Created</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Location</th>
                            <th>Condition</th>
                            <th>Remark</th>
                            <th>Photo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->allocation as $dalloc)
                        <tr>
                            <td>{{ $dalloc->created_at }}</td>
                            <td><a href="/employee/detail/{{ $dalloc->created_by }}">{{ $dalloc->user->name }}</a>
                            </td>
                            <td><a href="/department/detail/{{ $dalloc->department_id }}">{{ $dalloc->department->name }}</a></td>
                            <td><a href="/location/detail/{{ $dalloc->location_id}}">{{ $dalloc->location->name }}</a></td>
                            <td>
                                @if ($dalloc->condition == 'Good')
                                <span class="badge badge-success">{{ $dalloc->condition }}</span>
                                @endif
                            </td>
                            <td>{{ $dalloc->remark }}</td>
                            <td><a href="{{ $dalloc->file }}" target="_blank"><img class="img-thumbnail" src="{{ $dalloc->file }}" alt="Thumbnail image" width="100"></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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

    $("#category").select2({
        theme: 'bootstrap'
    });

    $("#location").select2({
        theme: 'bootstrap'
    });

    $(document).ready(function() {
        $('#table-allocation').DataTable({
            responsive: true,
        });
    });
</script>
@endsection