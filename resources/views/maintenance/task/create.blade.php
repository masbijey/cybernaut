@extends('layouts.app')

@section('content')
<h1 class="h3 text-gray-800">New Task</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('task.index') }}">Task List</a></li>
        <li class="breadcrumb-item active" aria-current="page">New Task</li>
    </ol>
</nav>

<form method="POST" action="{{ route('task.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card mt-3 shadow-sm">
                <div class="card-header py-3 bg-gradient-primary text-light">
                    <h6 class="m-0 font-weight-bold">Task Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td><label for="date">Due Date <small class="text-danger">*</small></label></td>
                            <td><input type="date" class="form-control form-control-sm" id="date" name="task_date" required></td>
                        </tr>
                        <tr>
                            <td><label for="task_title">Title <small class="text-danger">*</small></label></td>
                            <td>
                                <input type="text" class="form-control form-control-sm" id="name" name="task_title" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="task_desc">Description <small class="text-danger">*</small></label></td>
                            <td>
                                <textarea name="task_desc" id="task_desc" class="form-control form-control-sm" required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="task_priority">Priority <small class="text-danger">*</small></label></td>
                            <td>
                                <div class="custom-control custom-radio text-success font-weight-bold">
                                    <input type="radio" id="Low" name="task_priority" class="custom-control-input" value="Low" required>
                                    <label class="custom-control-label " for="Low">Low</label>
                                </div>
                                <div class="custom-control custom-radio text-warning font-weight-bold">
                                    <input type="radio" id="Medium" name="task_priority" class="custom-control-input" value="Medium" required>
                                    <label class="custom-control-label" for="Medium">Medium</label>
                                </div>
                                <div class="custom-control custom-radio text-danger font-weight-bold">
                                    <input type="radio" id="High" name="task_priority" class="custom-control-input" value="High" required>
                                    <label class="custom-control-label" for="High">High</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="type">Type <small class="text-danger">*</small></label></td>
                            <td>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio11" name="task_type" class="custom-control-input" value="Corrective" required>
                                    <label class="custom-control-label" for="customRadio11">Corrective</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio12" name="task_type" class="custom-control-input" value="Preventive" required>
                                    <label class="custom-control-label" for="customRadio12">Preventive</label>
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
                                <textarea name="task_remark" id="remark" class="form-control form-control-sm"></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card mt-3 shadow-sm">
                <div class="card-header py-3 bg-gradient-primary text-light">
                    <h6 class="m-0 font-weight-bold">Related</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <td><label for="asset">Asset</label></td>
                        <td>
                            <select class="js-example-basic-multiple custom-select form-control form-control-sm" id="tag-asset" name="asset_ids[]" multiple="multiple">
                                @foreach ($asset as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        </tr>
                        <tr>
                            <td><label for="location">Location <small class="text-danger">*</small></label></td>
                            <td>
                                <select class="js-example-basic-multiple custom-select form-control form-control-sm" id="tag-location" name="location_ids[]" multiple="multiple" required>
                                    @foreach ($location as $data) <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="members">Assign to <small class="text-danger">*</small></label></td>
                            <td>
                                <select class="js-example-basic-multiple custom-select form-control form-control-sm" id="tag-employee" name="member_ids[]" multiple="multiple" required>
                                    @foreach ($user as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card mt-3 shadow-sm">
                <div class="card-header py-3  bg-gradient-primary text-light">
                    <h6 class="m-0 font-weight-bold">Vendor Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td>
                                <label for="task_vendor">Name</label>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" id="task_vendor" name="task_vendor">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="task_vendor_phone">Phone</label>
                            </td>
                            <td>
                                <input type="number" class="form-control form-control-sm" id="task_vendor_phone" name="task_vendor_phone">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card mt-3 shadow-sm">
                <div class="card-header py-3 bg-gradient-primary text-light">
                    <h6 class="m-0 font-weight-bold">Documents</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="file_desc">File Name / Description <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-sm" id="file_remark" name="file_remark" required>
                        <small class="text-info">ex: after/before, contract, invoice, etc.</small>
                    </div>

                    <div class="form-group">
                        <label for="">Insert file <small class="text-danger">*</small></label>
                        <input type="file" class="form-control-file" name="file" required>
                        <small class="text-info">*image & pdf only <br>*add more files after submission</small>
                    </div>


                    <div class="form-group">
                        <button class="btn shadow-sm btn-primary" type="submit">Save</button>
                        <a href="/task" class="btn btn-secondary shadow-sm">Cancel</a>
                    </div>
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