@extends('layouts.app')

@section('title')
S C L B L E | Asset Information
@endsection

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
        <div class="card shadow-sm mb-3">
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
                            IDR {{ number_format($data->buyPrice, 0, ',', '.') }}
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
        <div class="card shadow-sm mb-3">
            <div class="card-header text-primary">
                <h6 class="m-0 font-weight-bold">Task <small class="text-secondary">History</small></h6>
            </div>
            <div class="card-body">
                <a href="/task/create" class="btn btn-sm btn-outline-secondary shadow-sm mb-3">+ New Task</a>

                <table class="table table-hover table-sm" id="table-task-history">
                    <thead>
                        <tr>
                            <th>Created at</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Budget</th>
                            <th>Vendor</th>
                            <th>Finished By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($task as $data)
                        <tr>
                            <td>{{ $data->created_at }}</td>
                            <td><a href="/task/detail/{{ $data->task->id }}">{{ $data->task->task_title }}</a></td>
                            <td>{{ $data->task->task_desc }}</td>
                            <td>
                                @if ($data->task->task_status == 'Done')
                                <a href="#" class="btn btn-sm btn-outline-success">{{ $data->task->task_status }}</a>
                                @else
                                <a href="#" class="btn btn-sm btn-outline-secondary">On Progress</a>
                                @endif
                            </td>
                            <td>
                                IDR {{ number_format($data->task->task_price, 0, ',', '.') }}
                            </td>
                            <td>{{ $data->task->task_vendor }}</td>
                            <td>
                                @foreach ($data->task->member as $member)
                                <a href="/employee/detail/{{ $member->user->id }}">{{ Str::words($member->user->name, 1, '') }}</a>,
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <div class="card-header text-primary">
                <h6 class="m-0 font-weight-bold">Workorder <small class="text-secondary">History</small></h6>
            </div>
            <div class="card-body">
                <a href="/workorder/create" class="btn btn-sm btn-outline-secondary shadow-sm mb-3">+ New Workorder</a>

                <table class="table table-hover table-sm" id="table-workorder">
                    <thead>
                        <tr>
                            <th>Created at</th>
                            <th>No. Workorder</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Finished by</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($workorder as $data)
                        <tr>
                            <td>{{ $data->created_at }}</td>
                            <td><a href="/workorder/detail/{{ $data->workorder->order_no }}">#{{ $data->workorder->order_no }}</a></td>
                            <td>{{ $data->workorder->title }}</td>
                            <td>{{ $data->workorder->description }}</td>
                            <td>
                                @if ($data->workorder->priority == 'High')
                                <button class="btn btn-sm btn-outline-danger">{{ $data->workorder->priority }}</button>
                                @else
                                <button class="btn btn-sm btn-outline-secondary">{{ $data->workorder->priority }}</button>
                                @endif
                            </td>
                            <td>
                                @if ($data->workorder->status == 'Done')
                                <button class="btn btn-sm btn-outline-success">{{ $data->workorder->status }}</button>
                                @else
                                <button class="btn btn-sm btn-outline-secondary">{{ $data->workorder->status }}</button>
                                @endif
                            </td>
                            <td>
                                @foreach ($data->workorder->memberMany as $member)
                                <a href="/employee/detail/{{ $member->user->id }}">{{ Str::words($member->user->name, 1, '') }}</a>,
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <div class="card-header text-primary">
                <h6 class="m-0 font-weight-bold">Allocation <small class="text-secondary">History</small></h6>
            </div>
            <div class="card-body">
                <a class="btn btn-sm btn-outline-secondary shadow-sm mb-3">+ New Allocation</a>

                <table class="table table-hover table-sm" id="table-allocation">
                    <thead>
                        <tr>
                            <th>Created</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Location</th>
                            <th>Condition</th>
                            <th>Remark</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allocation as $data)
                        <tr>
                            <td>{{ $data->created_at }}</td>
                            <td><a href="/employee/detail/{{ $data->employee->id }}">{{ Str::words($data->employee->name, 1, '') }}</a></td>
                            <td>{{ $data->department->name }}</td>
                            <td>{{ $data->location->name }}</td>
                            <td>
                                @if ($data->condition == 'Good')
                                <button class="btn btn-sm btn-outline-success">{{ $data->condition }}</button>
                                @else
                                <button class="btn btn-sm btn-outline-secondary">{{ $data->condition }}</button>
                                @endif
                            </td>
                            <td>{{ $data->remark }}</td>
                            <td><a href="{{ $data->file }}" class="btn btn-sm btn-outline-secondary">File</a></td>
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

    $(document).ready(function() {
        $('#table-workorder').DataTable({
            responsive: true,
        });
    });

    $(document).ready(function() {
        $('#table-task-history').DataTable({
            responsive: true,
        });
    });
</script>
@endsection