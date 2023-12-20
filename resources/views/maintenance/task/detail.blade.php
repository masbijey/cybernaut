@extends('layouts.app')

@section('content')
<h1 class="h3 mb-1 text-gray-800">{{ $task->task_desc }}</h1>
<a href="{{ url('task') }}">« back to Task List</a>

<div class="row">
    <div class="col-md-8">
        <div class="card mt-3 shadow">
            <div class="card-header py-3 text-primary">
                <h6 class="m-0 font-weight-bold">Task Information</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td><label for="status">Status</label></td>
                        <td>
                            @if($task->task_status == 'Done')
                                <span class="badge badge-success">Done</span>
                            @else
                                <span class="badge badge-danger">On Progress</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><label for="date">Date</label></td>
                        <td>{{ $task->task_date }}</td>
                    </tr>
                    <tr>
                        <td><label for="task_desc">Description</label></td>
                        <td>{{ $task->task_desc }}</td>
                    </tr>
                    <tr>
                        <td><label for="task_priority">Priority</label></td>
                        <td>
                            @if($task->task_priority == 'Low')
                                <span class="badge badge-success">Low</span>
                            @elseif($task->task_priority == 'Medium')
                                <span class="badge badge-warning">Medium</span>
                            @else
                                <span class="badge badge-danger">High</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><label for="type">Type</label></td>
                        <td>
                            <span class="badge badge-info">{{ $task->task_type }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="price">Price</label></td>
                        <td>{{ $task->task_price }}</td>
                    </tr>
                    <tr>
                        <td><label for="remark">Remark</label></td>
                        <td>
                            {{ $task->task_remark }}

                            <br>

                            @if($task->task_status != 'On Progress')
                                <small class="text-info">if any changes after done, please contact <a
                                        href="https://wa.me/62802307761670">Administrator</a></small>
                            @endif
                        </td>
                    </tr>
                </table>

                @if ($task->task_status != 'Done')                    <div id="accordion">
                        <button class="btn btn-primary btn-sm collapsed mb-2 shadow-none text-decoration-none"
                            data-toggle="collapse" data-target="#info" aria-expanded="false"
                            aria-controls="collapseTwo">
                            <b>+</b> edit information
                        </button>

                        <div class="card">
                            <div id="info" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <form method="POST"
                                        action="{{ route('task.update', $task->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><label for="price">Price</label></td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm" id="price"
                                                        name="task_price" value="{{ $task->task_price }}">
                                                    <small class="text-info">*If there are any costs</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="remark">Remark</label></td>
                                                <td>
                                                    <textarea name="task_remark" id="remark"
                                                        class="form-control form-control-sm">{{ $task->task_remark }}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="task_status" name="task_status" value="Done">
                                                        <label class="custom-control-label text-danger font-weight-bold"
                                                            for="task_status">Check this
                                                            if maintenace is DONE!</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <button class="btn btn-primary shadow btn-sm"
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

    <div class="col-md-4">
        <div class="card mt-3 shadow">
            <div class="card-header py-3 text-primary">
                <h6 class="m-0 font-weight-bold">Documents</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead class="text-center thead-light">
                        <th colspan="2">Description</th>
                    </thead>
                    <tbody>
                        @foreach($task->file as $file)
                            <tr class="">
                                <td>
                                    <a href="{{ $file->file }}" target="_blank">{{ $file->remark }}</a><br>
                                </td>
                                <td class="text-right">
                                    <a href="" class="btn btn-danger btn-sm" data-placement="top" title="Hapus"><i
                                            class='fas fa-trash'></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($task->task_status != 'Done')
                    <div id="accordion">
                        <button class="btn btn-primary btn-sm collapsed mb-2 shadow-none text-decoration-none"
                            data-toggle="collapse" data-target="#file" aria-expanded="false"
                            aria-controls="collapseTwo">
                            <b>+</b> add file
                        </button>

                        <div class="card">
                            <div id="file" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('task.addfile') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $task->id }}">

                                        <table class="table table-borderless">
                                            <tr>
                                                <td><label for="file">Add File</label></td>
                                                <td>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="file"
                                                            name="file" required>
                                                        <label class="custom-file-label" for="file">Choose file</label>
                                                        <small class="text-info">(image & pdf
                                                            only)</small>
                                                        @if($errors->has('file'))
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
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="file_remark" name="file_remark" required>
                                                    <small class="text-info">ex: after/before, contract, invoice,
                                                        etc</small>
                                                    @if($errors->has('file_remark'))
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

        <div class="card mt-3 shadow">
            <div class="card-header py-3 text-primary">
                <h6 class="m-0 font-weight-bold">Related</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <table class="table table-sm table-bordered">
                            <thead class="text-center thead-light">
                                <th colspan="2">Asset</th>
                            </thead>
                            <tbody>
                                @foreach($task->assetMany as $asset)
                                    @if($asset->asset !== null)
                                        <tr>
                                            <td>{{ $asset->asset->name }}</td>
                                            <td class="text-right">
                                                <a href="" class="btn btn-danger btn-sm" data-placement="top"
                                                    title="Hapus"><i class='fas fa-trash'></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col">
                        <table class="table table-sm">
                            <thead class="text-center thead-light">
                                <th colspan="2">Location</th>
                            </thead>
                            <tbody>
                                @foreach($task->locationMany as $location)
                                    @if($location->location !== null)
                                        <tr>
                                            <td>{{ $location->location->name }}</td>
                                            <td class="text-right">
                                                <a href="" class="btn btn-danger btn-sm" data-placement="top"
                                                    title="Hapus"><i class='fas fa-trash'></i></a>
                                            </td>
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
                                <th colspan="2">Finished by</th>
                            </thead>
                            <tbody>
                                @foreach($task->member as $member)
                                    <tr>
                                        <td>
                                            {{ $member->employee->name }}
                                        </td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-danger btn-sm" data-placement="top"
                                                title="Hapus"><i class='fas fa-trash'></i></a> </td>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($task->task_status != 'Done')
                    <div id="accordion">
                        <button class="btn btn-primary btn-sm collapsed mb-2 shadow-none text-decoration-none"
                            data-toggle="collapse" data-target="#tag" aria-expanded="false" aria-controls="collapseTwo">
                            <b>+</b> add tags
                        </button>

                        <div class="card">
                            <div id="tag" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <form method="POST"
                                        action="{{ route('task.update', $task->id) }}"
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
                                                        @if(!isset($task->assetMany))
                                                            @foreach($task->assetMany as $data)
                                                                <option value="{{ $data->asset->id }}" selected>{{
                                                        $data->asset->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                        @foreach($assetlist as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
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
                                                        @if(!isset($task->locationMany))
                                                            @foreach($task->locationMany as $data)
                                                                <option value="{{ $data->location->id }}" selected>{{
                                                        $data->location->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                        @foreach($locationlist as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
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
                                                        @foreach($employeelist as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <button class="btn btn-sm btn-primary shadow"
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

        <div class="card mt-3 shadow">
            <div class="card-header py-3 text-primary">
                <h6 class="m-0 font-weight-bold">Vendor</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td>
                            <label for="task_vendor">Vendor Name</label>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" id="task_vendor" name="" disabled
                                value="{{ $task->task_vendor }}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="task_vendor_phone">Vendor Phone</label>
                        </td>
                        <td>
                            <input type="number" class="form-control form-control-sm" id="task_vendor_phone" name=""
                                disabled value="{{ $task->task_vendor_phone }}">
                        </td>
                    </tr>
                </table>
                @if($task->task_status != 'Done')
                    <div id="accordion">
                        <button class="btn btn-primary btn-sm collapsed mb-2 shadow-none text-decoration-none"
                            data-toggle="collapse" data-target="#vendor" aria-expanded="false"
                            aria-controls="collapseTwo">
                            <b>+</b> edit vendor
                        </button>

                        <div class="card">
                            <div id="vendor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <form method="POST"
                                        action="{{ route('task.update', $task->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>
                                                    <label for="task_vendor">Vendor Name</label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="task_vendor" name="task_vendor"
                                                        value="{{ $task->task_vendor }}">
                                                    <small class="text-info">*If using a vendor</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="task_vendor_phone">Vendor Phone</label>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm"
                                                        id="task_vendor_phone" name="task_vendor_phone"
                                                        value="{{ $task->task_vendor_phone }}">
                                                    <small class="text-info">*If using a vendor</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <button class="btn btn-sm btn-primary shadow"
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
<!--  -->
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
