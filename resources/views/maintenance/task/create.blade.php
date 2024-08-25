@extends('layouts.app')

@section('content')
<h1 class="h3 text-gray-800">ADD NEW TASK</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('task.index') }}">Task List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add New Task</li>
    </ol>
</nav>

<form method="POST" action="{{ route('task.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card mb-3 shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label for="date">Due Date <small class="text-danger">*</small></label>
                        <input type="date" class="form-control" id="date" name="task_date" required>
                    </div>

                    <div class="form-group">
                        <label for="task_title">Title <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" id="name" name="task_title" required>
                    </div>

                    <div class="form-group">
                        <label for="task_desc">Description <small class="text-danger">*</small></label>
                        <textarea name="task_desc" id="task_desc" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="task_priority">Priority <small class="text-danger">*</small></label>
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
                    </div>

                    <div class="form-group">
                        <label for="type">Type <small class="text-danger">*</small></label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio11" name="task_type" class="custom-control-input" value="Corrective" required>
                            <label class="custom-control-label" for="customRadio11">Corrective</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio12" name="task_type" class="custom-control-input" value="Preventive" required>
                            <label class="custom-control-label" for="customRadio12">Preventive</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="task_price">
                    </div>

                    <div class="form-group">
                        <label for="remark">Remark</label>
                        <textarea name="task_remark" id="remark" class="form-control"></textarea>
                    </div>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card mb-3 shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label for="asset">Assets tag</label>
                        <select class="js-example-basic-multiple custom-select form-control" id="tag-asset" name="asset_ids[]" multiple="multiple" style="width: 100%;">
                            @foreach ($asset as $data)
                            <option value="{{ $data->id }}">{{ $data->name }} {{ $data->serialNumber }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="location">Locations tag<small class="text-danger">*</small></label>
                        <select class="js-example-basic-multiple custom-select form-control" id="tag-location" name="location_ids[]" multiple="multiple" required style="width: 100%;">
                            @foreach ($location as $data)
                            <option value=" {{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="members">Assign to <small class="text-danger">*</small></label>
                        <select class="js-example-basic-multiple custom-select form-control" id="tag-employee" name="member_ids[]" multiple="multiple" required style="width: 100%;">
                            @foreach ($user as $data)
                            <option value=" {{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="card mb-3 shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label for="task_vendor">Vendor name</label>
                        <input type="text" class="form-control" id="task_vendor" name="task_vendor">
                    </div>

                    <div class="form-group">
                        <label for="task_vendor_phone">Vendor phone</label>
                        <input type="number" class="form-control" id="task_vendor_phone" name="task_vendor_phone">
                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card mb-3 shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label for="file_desc">File Name / Description <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" id="file_remark" name="file_remark" required>
                        <small class="text-info">example: after/before, contract, invoice, etc.</small>
                    </div>

                    <div class="form-group">
                        <label for="file" class="">Upload Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file" accept="image/*" capture="environment" required>
                            <label class="custom-file-label" for="file">Choose file</label>
                        </div>
                        <small class="text-info">*add more files after submission</small>
                    </div>

                    <div class="form-group">
                        <button class="btn shadow btn-primary" type="submit">Save</button>
                        <a href="/task" class="btn btn-secondary shadow">Cancel</a>
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

    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endsection