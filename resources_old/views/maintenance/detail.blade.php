@extends('layouts.app')

@section('content')
<div class="mb-2">
    <h4 class="d-inline bg-white text-dark">Detail Maintenance :</h4> <br>
    <h3 class="text-primary d-inline">{{ $maintenance->maintenance_desc }}</h3>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card mt-3 shadow">
            <div class="card-header py-3 text-primary">
                <h6 class="m-0 font-weight-bold">Maintenance Information</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><label for="status">Status</label></td>
                        <td>
                            @if ($maintenance->maintenance_status == 'Done')
                            <span class="badge badge-success">Done</span>
                            @else
                            <span class="badge badge-danger">On Progress</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><label for="date">Date</label></td>
                        <td><input type="date" class="form-control form-control-sm" id="date" name=""
                                value="{{ $maintenance->maintenance_date }}" disabled></td>
                    </tr>
                    <tr>
                        <td><label for="maintenance_desc">Description</label></td>
                        <td><input type="text" class="form-control form-control-sm" id="name" name=""
                                value="{{ $maintenance->maintenance_desc}}" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="maintenance_priority">Priority</label></td>
                        <td>
                            @if ($maintenance->maintenance_priority == 'Low')
                            <span class="badge badge-success">Low</span>
                            @elseif ($maintenance->maintenance_priority == 'Medium')
                            <span class="badge badge-warning">Medium</span>
                            @else
                            <span class="badge badge-danger">High</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><label for="type">Type</label></td>
                        <td>
                            <span class="badge badge-info">{{ $maintenance->maintenance_type }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="price">Price</label></td>
                        <td>
                            <input type="number" class="form-control form-control-sm" id="price" name=""
                                value="{{ $maintenance->maintenance_price }}" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="remark">Remark</label></td>
                        <td>
                            <textarea name="" id="remark" class="form-control form-control-sm"
                                disabled>{{ $maintenance->maintenance_remark }}</textarea>
                                @if ($maintenance->maintenance_status != 'On Progress')
                                <small class="text-info">if any changes after done, please contact <a href="https://wa.me/62802307761670">Administrator</a></small>
                                @endif
                        </td>
                    </tr>
                </table>

                @if ($maintenance->maintenance_status != 'Done')                
                <div id="accordion">
                    <button class="btn btn-primary btn-sm collapsed mb-2 shadow-none text-decoration-none"
                        data-toggle="collapse" data-target="#info" aria-expanded="false" aria-controls="collapseTwo">
                        <b>+</b> edit information
                    </button>

                    <div class="card">
                        <div id="info" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <form method="POST" action="{{ route('maintenance.update', $maintenance->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><label for="price">Price</label></td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm" id="price"
                                                    name="maintenance_price"
                                                    value="{{ $maintenance->maintenance_price }}">
                                                <small class="text-info">*If there are any costs</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="remark">Remark</label></td>
                                            <td>
                                                <textarea name="maintenance_remark" id="remark"
                                                    class="form-control form-control-sm">{{ $maintenance->maintenance_remark }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="maintenance_status" name="maintenance_status" value="Done">
                                                    <label class="custom-control-label text-danger font-weight-bold"
                                                        for="maintenance_status">Check this
                                                        if maintenace is DONE!</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button class="btn btn-primary shadow btn-sm" type="submit">Save</button>
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

    <div class="col-md-4">
        <div class="card mt-3">
            <div class="card-header py-3 text-primary">
                <h6 class="m-0 font-weight-bold">Related</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <table class="table table-sm">
                            <thead class="text-center thead-light">
                                <th>Asset</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($maintenance->assetMany as $asset)
                                @if ($asset->asset !== null)
                                <tr>
                                    <td>{{ $asset->asset->name }}</td>
                                    <td class="text-center"><button
                                            class="btn btn-sm btn-light text-dark font-weight-bolder">X</button></td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col">
                        <table class="table table-sm">
                            <thead class="text-center thead-light">
                                <th>Location</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($maintenance->locationMany as $location)
                                @if ($location->location !== null)
                                <tr>
                                    <td>{{ $location->location->name }}</td>
                                    <td class="text-center"><button
                                            class="btn btn-sm btn-light text-dark font-weight-bolder">X</button></td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm">
                            <thead class="text-center thead-light">
                                <th>Maintenance by</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($maintenance->member as $member)
                                <tr>
                                    <td>
                                        {{ $member->employee->name }}
                                    </td>
                                    <td class="text-center"><button
                                            class="btn btn-sm btn-light text-dark font-weight-bolder">X</button></td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                @if ($maintenance->maintenance_status != 'Done')                
                <div id="accordion">
                    <button class="btn btn-primary btn-sm collapsed mb-2 shadow-none text-decoration-none"
                        data-toggle="collapse" data-target="#tag" aria-expanded="false" aria-controls="collapseTwo">
                        <b>+</b> add tags
                    </button>

                    <div class="card">
                        <div id="tag" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <form method="POST" action="{{ route('maintenance.update', $maintenance->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><label for="asset">Asset</label></td>
                                            <td>
                                                <select
                                                    class="js-example-basic-multiple custom-select form-control form-control-sm"
                                                    id="tag-asset-edit" name="asset_ids[]" multiple="multiple"
                                                    style="width:100%">
                                                    @if (!isset($maintenance->assetMany))
                                                    @foreach ($maintenance->assetMany as $data)
                                                    <option value="{{ $data->asset->id }}" selected>{{
                                                        $data->asset->name }}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                    @foreach ($assetlist as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="location">Location</label></td>
                                            <td>
                                                <select
                                                    class="js-example-basic-multiple custom-select form-control form-control-sm"
                                                    id="tag-location-edit" name="location_ids[]" multiple="multiple"
                                                    style="width:100%">
                                                    @if (!isset($maintenance->locationMany))
                                                    @foreach ($maintenance->locationMany as $data)
                                                    <option value="{{ $data->location->id }}" selected>{{
                                                        $data->location->name }}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                    @foreach ($locationlist as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="employee">Employee</label></td>
                                            <td>
                                                <select
                                                    class="js-example-basic-multiple custom-select form-control form-control-sm"
                                                    id="tag-employee-edit" name="member_ids[]" multiple="multiple"
                                                    style="width:100%">
                                                    @foreach ($employeelist as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button class="btn btn-sm btn-primary shadow" type="submit">Save</button>
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

        <div class="card mt-3">
            <div class="card-header py-3 text-primary">
                <h6 class="m-0 font-weight-bold">Vendor</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td>
                            <label for="maintenance_vendor">Vendor Name</label>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" id="maintenance_vendor" name=""
                                disabled value="{{ $maintenance->maintenance_vendor }}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="maintenance_vendor_phone">Vendor Phone</label>
                        </td>
                        <td>
                            <input type="number" class="form-control form-control-sm" id="maintenance_vendor_phone"
                                name="" disabled value="{{ $maintenance->maintenance_vendor_phone}}">
                        </td>
                    </tr>
                </table>
                @if ($maintenance->maintenance_status != 'Done')
                <div id="accordion">
                    <button class="btn btn-primary btn-sm collapsed mb-2 shadow-none text-decoration-none"
                        data-toggle="collapse" data-target="#vendor" aria-expanded="false" aria-controls="collapseTwo">
                        <b>+</b> edit vendor
                    </button>

                    <div class="card">
                        <div id="vendor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <form method="POST" action="{{ route('maintenance.update', $maintenance->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>
                                                <label for="maintenance_vendor">Vendor Name</label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="maintenance_vendor" name="maintenance_vendor"
                                                    value="{{ $maintenance->maintenance_vendor }}">
                                                <small class="text-info">*If using a vendor</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="maintenance_vendor_phone">Vendor Phone</label>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm"
                                                    id="maintenance_vendor_phone" name="maintenance_vendor_phone"
                                                    value="{{ $maintenance->maintenance_vendor_phone}}">
                                                <small class="text-info">*If using a vendor</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button class="btn btn-sm btn-primary shadow" type="submit">Save</button>
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

    <div class="col-md-4">
        <div class="card mt-3">
            <div class="card-header py-3 text-primary">
                <h6 class="m-0 font-weight-bold">Documents</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead class="text-center thead-light">
                        <th>Link</th>
                        <th>Description</th>
                    </thead>
                    <tbody>
                        @foreach ($maintenance->file as $file)
                        <tr class="text-center">
                            <td>
                                <a href="{{ $file->file }}" target="_blank">show file</a><br>
                            </td>
                            <td>
                                {{ $file->remark }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($maintenance->maintenance_status != 'Done')
                <div id="accordion">
                    <button class="btn btn-primary btn-sm collapsed mb-2 shadow-none text-decoration-none"
                        data-toggle="collapse" data-target="#file" aria-expanded="false" aria-controls="collapseTwo">
                        <b>+</b> add file
                    </button>

                    <div class="card">
                        <div id="file" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <form method="POST" action="{{ route('maintenance.addfile') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $maintenance->id}}">

                                    <table class="table table-borderless">
                                        <tr>
                                            <td><label for="file">Add File</label></td>
                                            <td>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="file" name="file"
                                                        required>
                                                    <label class="custom-file-label" for="file">Choose file</label>
                                                    <small class="text-info">(image & pdf
                                                        only)</small>
                                                    @if ($errors->has('file'))
                                                    <small class="form-text text-danger">{{ $errors->first('file')
                                                        }}</small>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="file_remark">File Description</label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" id="file_remark"
                                                    name="file_remark" required>
                                                <small class="text-info">ex: after/before, contract, invoice,
                                                    etc</small>
                                                @if ($errors->has('file_remark'))
                                                <small class="form-text text-danger">{{ $errors->first('file_remark')
                                                    }}</small>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button class="btn shadow btn-primary btn-sm"
                                                    type="submit">Save</button>
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