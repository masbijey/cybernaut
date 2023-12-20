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
                        Maintenace
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
                                        <td><label for="name">Name *</label></td>
                                        <td><input type="text" class="form-control" id="name" name="name" disabled
                                                value="{{ $data->name }}"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="category">Category</label></td>
                                        <td>
                                            <select class="custom-select form-control" id="category" name="category"
                                                disabled>
                                                <option value="" selected>{{ $data->category->name }}</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="merk">Merk</label></td>
                                        <td><input type="text" class="form-control" id="merk" name="merk" disabled
                                                value="{{ $data->merk }}"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="type">Type</label></td>
                                        <td><input type="text" class="form-control" id="type" name="type" disabled
                                                value="{{ $data->type }}"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="serialNumber">Serial Number</label></td>
                                        <td><input type="text" class="form-control" id="serialNumber"
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
                                        <td><input type="text" class="form-control" disabled
                                                value="{{ $data->vendorName }}"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="vendorPhone">Vendor Phone</label></td>
                                        <td><input type="number" class="form-control" disabled
                                                value="{{ $data->vendorPhone }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="vendorAddress">Vendor Address</label></td>
                                        <td>
                                            <textarea name="vendorAddress" class="form-control"
                                                disabled>{{ $data->vendorAddress }}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="buyDate">Buy Date</label></td>
                                        <td><input type="date" class="form-control" id="buyDate" name="buyDate" disabled
                                                value="{{ $data->buyDate }}"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="buyPrice">Buy Price</label></td>
                                        <td><input type="number" class="form-control" disabled
                                                value="{{ $data->buyPrice }}"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="status">Buy Condition</label></td>
                                        <td>
                                            <input type="text" class="form-control" disabled
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
                maintenance
            </div>

            <div class="tab-pane fade" id="checklist">
                checklist
            </div>

            <div class="tab-pane fade" id="project">
                project
            </div>

            <div class="tab-pane fade" id="workorder">
                work order
            </div>

            <div class="tab-pane fade" id="allocation">
                allocation
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