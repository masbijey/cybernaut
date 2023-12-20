@extends('layouts.app')

@section('content')
<h1 class="h3 mb-1 text-gray-800">Add New Task</h1>
<a href="{{ url('task') }}">« back to Task List</a>

<form method="POST" action="{{ route('task.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-8">
            <div class="card mt-3 shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Task Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td><label for="date">Due Date</label></td>
                            <td><input type="date" class="form-control form-control-sm" id="date" name="task_date" required></td>
                        </tr>
                        <tr>
                            <td><label for="task_title">Title</label></td>
                            <td>
                                <input type="text" class="form-control form-control-sm" id="name" name="task_title" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="task_desc">Description</label></td>
                            <td>
                                <textarea name="task_desc" id="task_desc" class="form-control form-control-sm" rows="5"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="task_priority">Priority</label></td>
                            <td>
                                <div class="custom-control custom-radio text-success font-weight-bold">
                                    <input type="radio" id="Low" name="task_priority"
                                        class="custom-control-input" value="Low" required>
                                    <label class="custom-control-label " for="Low">Low</label>
                                </div>
                                <div class="custom-control custom-radio text-warning font-weight-bold">
                                    <input type="radio" id="Medium" name="task_priority"
                                        class="custom-control-input" value="Medium" required>
                                    <label class="custom-control-label" for="Medium">Medium</label>
                                </div>
                                <div class="custom-control custom-radio text-danger font-weight-bold">
                                    <input type="radio" id="High" name="task_priority"
                                        class="custom-control-input" value="High" required>
                                    <label class="custom-control-label" for="High">High</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="type">Type</label></td>
                            <td>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio11" name="task_type"
                                        class="custom-control-input" value="Corrective" required>
                                    <label class="custom-control-label" for="customRadio11">Corrective</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio12" name="task_type"
                                        class="custom-control-input" value="Preventive" required>
                                    <label class="custom-control-label" for="customRadio12">Preventive</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio13" name="task_type"
                                        class="custom-control-input" value="Project" required>
                                    <label class="custom-control-label" for="customRadio13">Project</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="price">Price</label></td>
                            <td>
                                <input type="number" class="form-control form-control-sm" id="price" name="task_price">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="remark">Remark</label></td>
                            <td>
                                <textarea name="task_remark" id="remark" class="form-control form-control-sm" rows="5"></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mt-3 shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Related</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
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
                            <td><label for="location">Location</label></td>
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
                            <td><label for="members">Assign to</label></td>
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

            <div class="card mt-3 shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Vendor</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td>
                                <label for="task_vendor">Vendor Name</label>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" id="task_vendor"
                                    name="task_vendor">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="task_vendor_phone">Vendor Phone</label>
                            </td>
                            <td>
                                <input type="number" class="form-control form-control-sm" id="task_vendor_phone"
                                    name="task_vendor_phone">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card mt-3 shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Documents</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td><label for="file">Add file</label></td>
                            <td>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file" required>
                                    <label class="custom-file-label" for="file">Choose file</label>
                                </div>
                                <small class="text-info">*image & pdf only <br>*add more files after submission</small>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="file_remark">File remark</label>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" id="file_remark"
                                    name="file_remark" required>
                                    <small class="text-info">ex: after/before, contract, invoice, etc.</small>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td colspan="2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="task_status" name="task_status" value="Done">
                                    <label class="custom-control-label text-danger font-weight-bold" for="Task_status">Check this if task is DONE!</label>
                                  </div>
                            </td>
                        </tr> -->
                        <tr>
                            <td colspan="2">
                                <button class="btn shadow btn-primary" type="submit">Save</button>
                                <a href="/task" class="btn btn-secondary shadow">Cancel</a>
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
                    @if ($errors->has('Task_title'))
                    <small class="form-text text-danger">{{ $errors->first('Task_title') }}</small>
                    @endif
                    @if ($errors->has('Task_type'))
                    <small class="form-text text-danger">{{ $errors->first('Task_type') }}</small>
                    @endif
                    @if ($errors->has('Task_price'))
                    <small class="form-text text-danger">{{ $errors->first('Task_price') }}</small>
                    @endif
                    @if ($errors->has('Task_date'))
                    <small class="form-text text-danger">{{ $errors->first('Task_date') }}</small>
                    @endif
                    @if ($errors->has('Task_remark'))
                    <small class="form-text text-danger">{{ $errors->first('Task_remark') }}</small>
                    @endif
                    @if ($errors->has('Task_priority'))
                    <small class="form-text text-danger">{{ $errors->first('Task_priority') }}</small>
                    @endif
                    @if ($errors->has('Task_vendor'))
                    <small class="form-text text-danger">{{ $errors->first('Task_vendor') }}</small>
                    @endif
                    @if ($errors->has('Task_vendor_phone'))
                    <small class="form-text text-danger">{{ $errors->first('Task_vendor_phone') }}</small>
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