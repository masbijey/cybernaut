@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">New Maintenance</h1>
<p>"Every maintenance is important to be recorded to enable quick and effective repairs." - Unknown.</p>

<form method="POST" action="{{ route('maintenance.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-4">
            <div class="card mt-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Maintenance Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td><label for="date">Date</label></td>
                            <td><input type="date" class="form-control form-control-sm" id="date" name="maintenance_date" required></td>
                        </tr>
                        <tr>
                            <td><label for="maintenance_desc">Description</label></td>
                            <td>
                                <input type="text" class="form-control form-control-sm" id="name" name="maintenance_desc" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="maintenance_priority">Priority</label></td>
                            <td>
                                <div class="custom-control custom-radio text-success font-weight-bold">
                                    <input type="radio" id="Low" name="maintenance_priority"
                                        class="custom-control-input" value="Low" required>
                                    <label class="custom-control-label " for="Low">Low</label>
                                </div>
                                <div class="custom-control custom-radio text-warning font-weight-bold">
                                    <input type="radio" id="Medium" name="maintenance_priority"
                                        class="custom-control-input" value="Medium" required>
                                    <label class="custom-control-label" for="Medium">Medium</label>
                                </div>
                                <div class="custom-control custom-radio text-danger font-weight-bold">
                                    <input type="radio" id="High" name="maintenance_priority"
                                        class="custom-control-input" value="High" required>
                                    <label class="custom-control-label" for="High">High</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="type">Type</label></td>
                            <td>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio11" name="maintenance_type"
                                        class="custom-control-input" value="Corrective" required>
                                    <label class="custom-control-label" for="customRadio11">Corrective</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio12" name="maintenance_type"
                                        class="custom-control-input" value="Preventive" required>
                                    <label class="custom-control-label" for="customRadio12">Preventive</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="price">Price</label></td>
                            <td>
                                <input type="number" class="form-control form-control-sm" id="price" name="maintenance_price">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="remark">Remark</label></td>
                            <td>
                                <textarea name="maintenance_remark" id="remark" class="form-control form-control-sm"></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mt-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Related</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <td><label for="asset">Asset</label></td>
                        <td>
                            <select class="js-example-basic-multiple custom-select form-control form-control-sm" id="tag-asset"
                                name="asset_ids[]" multiple="multiple">
                                @foreach ($asset as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        </tr>
                        <tr>
                            <td><label for="location">Maintenance location</label></td>
                            <td>
                                <select class="js-example-basic-multiple custom-select form-control form-control-sm" id="tag-location"
                                    name="location_ids[]" multiple="multiple"
                                    @foreach ($location as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="members">Maintenance by</label></td>
                            <td>
                                <select class="js-example-basic-multiple custom-select form-control form-control-sm" id="tag-employee"
                                    name="member_ids[]" multiple="multiple" required>
                                    @foreach ($employee as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Vendor</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td>
                                <label for="maintenance_vendor">Vendor Name</label>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" id="maintenance_vendor"
                                    name="maintenance_vendor">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="maintenance_vendor_phone">Vendor Phone</label>
                            </td>
                            <td>
                                <input type="number" class="form-control form-control-sm" id="maintenance_vendor_phone"
                                    name="maintenance_vendor_phone">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mt-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Documents</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td><label for="file">Add File</label></td>
                            <td>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file" required>
                                    <label class="custom-file-label" for="file">Choose file</label>
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
                                    <small class="text-info">ex: after/before, contract, invoice, etc. (image & pdf only)</small>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="maintenance_status" name="maintenance_status" value="Done">
                                    <label class="custom-control-label text-danger font-weight-bold" for="maintenance_status">Check this if maintenace is DONE!</label>
                                  </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button class="btn shadow btn-primary" type="submit">Save</button>
                                <a href="/maintenance" class="btn btn-secondary shadow">Cancel</a>
                            </td>
                        </tr>
                    </table>
                    @if ($errors->has('asset'))
                    <small class="form-text text-danger">{{ $errors->first('asset') }}</small>
                    @endif
                    @if ($errors->has('employee'))
                    <small class="form-text text-danger">{{ $errors->first('employee') }}</small>
                    @endif
                    @if ($errors->has('location'))
                    <small class="form-text text-danger">{{ $errors->first('location') }}</small>
                    @endif
                    @if ($errors->has('maintenance_title'))
                    <small class="form-text text-danger">{{ $errors->first('maintenance_title') }}</small>
                    @endif
                    @if ($errors->has('maintenance_type'))
                    <small class="form-text text-danger">{{ $errors->first('maintenance_type') }}</small>
                    @endif
                    @if ($errors->has('maintenance_price'))
                    <small class="form-text text-danger">{{ $errors->first('maintenance_price') }}</small>
                    @endif
                    @if ($errors->has('maintenance_date'))
                    <small class="form-text text-danger">{{ $errors->first('maintenance_date') }}</small>
                    @endif
                    @if ($errors->has('maintenance_remark'))
                    <small class="form-text text-danger">{{ $errors->first('maintenance_remark') }}</small>
                    @endif
                    @if ($errors->has('maintenance_priority'))
                    <small class="form-text text-danger">{{ $errors->first('maintenance_priority') }}</small>
                    @endif
                    @if ($errors->has('maintenance_vendor'))
                    <small class="form-text text-danger">{{ $errors->first('maintenance_vendor') }}</small>
                    @endif
                    @if ($errors->has('maintenance_vendor_phone'))
                    <small class="form-text text-danger">{{ $errors->first('maintenance_vendor_phone') }}</small>
                    @endif
                    @if ($errors->has('files'))
                    <small class="form-text text-danger">{{ $errors->first('files') }}</small>
                    @endif
                    @if ($errors->has('members'))
                    <small class="form-text text-danger">{{ $errors->first('members') }}</small>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('css')
<!--  -->
@endsection

@section('js')
<script>
    $("#tag-asset").select2({
        theme: 'bootstrap'
    });

    $("#tag-location").select2({
        theme: 'bootstrap'
    });

    $("#tag-employee").select2({
        theme: 'bootstrap'
    });

    $("#assets").select2({
        theme: 'bootstrap'
    });

    $("#location").select2({
        theme: 'bootstrap'
    });
</script>
@endsection