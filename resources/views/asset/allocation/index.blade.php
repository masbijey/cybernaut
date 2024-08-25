@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between">
    <h1 class="h3 text-gray-800">ASSET TRANSFER</h1>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('asset.index') }}">Assets List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Asset transfer</li>
    </ol>
</nav>


<div class="row">
    <div class="col-lg-4">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Asset details</h6>
            </div>
            <div class="card-body">
                @foreach ($detail_assets as $detail_assets)
                <div class="mb-3 text-center">
                    <img src="{{ url('public'.$detail_assets->file) }}" class="img-fluid" alt="Responsive image" width="200px">
                </div>
                <table class="table table-sm table-hover">

                    <tr>
                        <td><label for="name" class="font-weight-bold">Created At</label></td>
                        <td>{{ $detail_assets->created_at }}</td>
                    </tr>
                    <tr>
                        <td><label for="name" class="font-weight-bold">Name</label></td>
                        <td>{{ $detail_assets->name }}</td>
                    </tr>
                    <tr>
                        <td><label for="category" class="font-weight-bold">Category</label></td>
                        <td>{{ $detail_assets->category->name }}</td>
                    </tr>
                    <tr>
                        <td><label for="merk" class="font-weight-bold">Merk</label></td>
                        <td>{{ $detail_assets->merk }}</td>
                    </tr>
                    <tr>
                        <td><label for="type" class="font-weight-bold">Type</label></td>
                        <td>{{ $detail_assets->type }}</td>
                    </tr>
                    <tr>
                        <td><label for="serialNumber" class="font-weight-bold">Serial Number</label></td>
                        <td>{{ $detail_assets->serialNumber }}</td>
                    </tr>
                    <tr>
                        <td><label for="buyDate" class="font-weight-bold">Purchase Date</label></td>
                        <td>{{ $detail_assets->buyDate }}</td>
                    </tr>
                    <tr>
                        <td><label for="buyPrice" class="font-weight-bold">Purchase Price</label></td>
                        <td>
                            IDR {{ number_format($detail_assets->buyPrice, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td><label for="status" class="font-weight-bold">Last Condition</label></td>
                        <td>
                            <span class="badge badge-success">{{ $detail_assets->buyCond }}</span>
                        </td>
                    </tr>
                </table>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Move to Employee</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('allocation.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="token" value="{{ $detail_assets->token }}"  autocomplete="off">
                    <div class="form-group">
                        <label for="employee">Employee</label>
                        <select class="custom-select" id="employee" name="employee" style="width: 100%;" required>
                            <option value="" selected>Select a employee:</option>
                            @foreach ($employee as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="location" class="">Location</label>
                        <select class="custom-select form-control" id="select2-location" name="location" required style="width: 100%;">
                            <option value="" selected>Select a location:</option>
                            @foreach ($location as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="department" class="">Department</label>
                        <select class="custom-select form-control" id="select2-department" name="department" required style="width: 100%;">
                            <option value="" selected>Select a department:</option>
                            @foreach ($department as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status" class="">Condition</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="good_condition" name="condition" class="custom-control-input" value="Good" required>
                            <label class="custom-control-label" for="good_condition">Good</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="broken_condition" name="condition" class="custom-control-input" value="Broken" required>
                            <label class="custom-control-label" for="broken_condition">Broken</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="file">Upload Photo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file" accept="image/*" capture="environment" required>
                            <label class="custom-file-label" for="file">Choose file</label>
                            <small>take picture of employee with inventory items </small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Remark</label>
                        <input type="text" name="description" id="description" class="form-control" required placeholder="reason example : broke, resign, etc">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </div>
                </form>
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
    $(document).ready(function() {
        $('#inventory-table').DataTable({
            responsive: true
        });
    });

    $("#employee").select2({
        theme: 'bootstrap'
    });

    $("#select2-asset").select2({
        theme: 'bootstrap'
    });

    $("#select2-location").select2({
        theme: 'bootstrap'
    });

    $("#select2-department").select2({
        theme: 'bootstrap'
    });

    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endsection