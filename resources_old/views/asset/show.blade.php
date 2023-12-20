@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $data->name }}</h6>
    </div>


    <div class="card-body">
        <div class="form-group">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#detail" data-placement="top"
                        title="Summary profile">
                        Detail
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#maintenance" data-placement="top" title="Journey">
                        Maintenance
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#workorder" data-placement="top" title="Journey">
                        Work Order
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#checklist" data-placement="top" title="Journey">
                        Checklist
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#project" data-placement="top" title="Journey">
                        Project
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#allocation" data-placement="top" title="Journey">
                        Allocation
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <div class="tab-pane active" id="detail">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mt-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Asset Information</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><label for="name">Name</label></td>
                                        <td><input type="text" class="form-control form-control-sm" id="name"
                                                name="name" disabled value="{{ $data->name }}"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="category">Category</label></td>
                                        <td>
                                            <select class="custom-select form-control form-control-sm" id="category"
                                                name="category" disabled>
                                                <option value="" selected>{{ $data->category->name }}</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="merk">Merk</label></td>
                                        <td><input type="text" class="form-control form-control-sm" id="merk"
                                                name="merk" disabled value="{{ $data->merk }}"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="type">Type</label></td>
                                        <td><input type="text" class="form-control form-control-sm" id="type"
                                                name="type" disabled value="{{ $data->type }}"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="serialNumber">Serial Number</label></td>
                                        <td><input type="text" class="form-control form-control-sm" id="serialNumber"
                                                name="serialNumber" disabled value="{{ $data->serialNumber }}"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="file">Image</label></td>
                                        <td>
                                            <img src="{{ $data->file }}" alt="" width="200px">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mt-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Purchase Information</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><label for="vendorName">Vendor Name</label></td>
                                        <td><input type="text" class="form-control form-control-sm" disabled
                                                value="{{ $data->vendorName }}"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="vendorPhone">Vendor Phone</label></td>
                                        <td><input type="number" class="form-control form-control-sm" disabled
                                                value="{{ $data->vendorPhone }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="vendorAddress">Vendor Address</label></td>
                                        <td>
                                            <textarea name="vendorAddress" class="form-control form-control-sm"
                                                disabled>{{ $data->vendorAddress }}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="buyDate">Buy Date</label></td>
                                        <td><input type="date" class="form-control form-control-sm" id="buyDate"
                                                name="buyDate" disabled value="{{ $data->buyDate }}"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="buyPrice">Buy Price</label></td>
                                        <td><input type="number" class="form-control form-control-sm" disabled
                                                value="{{ $data->buyPrice }}"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="status">Buy Condition</label></td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" disabled
                                                value="{{ $data->buyCond }}">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="maintenance">
                <table class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr class="text-center">
                            <th>Created</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Type</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data->maintenance as $mtc)
                        <tr class="text-center">
                            <td>
                                {{ $mtc->created_at }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($mtc->maintenance_date)->format('d/m/y') }}
                            </td>
                            <td>
                                <a href="/maintenance/detail/{{ $mtc->id }}">{{ $mtc->maintenance_desc }}</a>
                            </td>
                            <td>
                                @if ($mtc->maintenance_status == 'Done')
                                <span class="badge badge-success">Done</span>
                                @else
                                <span class="badge badge-danger">On Progress</span>
                                @endif
                            </td>
                            <td>
                                @if ($mtc->maintenance_priority == 'Low')
                                <span class="badge badge-success">Low</span>
                                @elseif ($mtc->maintenance_priority == 'Medium')
                                <span class="badge badge-warning">Medium</span>
                                @else
                                <span class="badge badge-danger">High</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-info">{{ $mtc->maintenance_type }}</span>
                            </td>
                            <td>
                                @if ($mtc->location_id == null)
                                null
                                @else
                                <a href="/location/detail/{{ $mtc->location_id }}">{{ $mtc->location->name }}</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <div class="tab-pane fade" id="checklist">
                {{ $data->checklist }}
            </div>

            <div class="tab-pane fade" id="project">
                {{ $data->project }}
            </div>

            <div class="tab-pane fade" id="workorder">
                {{ $data->workorder }}
            </div>

            <div class="tab-pane fade" id="allocation">
                <table class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr class="text-center">
                            <th>Created</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Location</th>
                            <th>Condition</th>
                            <th>File</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->allocation as $dalloc)
                        <tr class="text-center">
                            <td>{{ $dalloc->created_at }}</td>
                            <td><a href="/employee/detail/{{ $dalloc->employee_id }}">{{ $dalloc->employee->name }}</a>
                            </td>
                            <td><a href="/department/detail/{{ $dalloc->department_id }}">{{ $dalloc->department->name }}</a></td>
                            <td><a href="/location/detail/{{ $dalloc->location_id}}">{{ $dalloc->location->name }}</a></td>
                            <td>{{ $dalloc->condition }}</td>
                            <td><a href="{{ $dalloc->file }}" target="_blank">show file</a></td>
                            <td>{{ $dalloc->remark }}</td>
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
{{-- --}}
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
</script>
@endsection