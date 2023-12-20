@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">New Asset</h1>

<form method="POST" action="{{ route('asset.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">

        <div class="col-md-4">
            <div class="card mt-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Asset Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td><label for="name">Name</label></td>
                            <td>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="category">Category</label></td>
                            <td>
                                <select class="custom-select form-control" id="category" name="category" required>
                                    <option value="" selected>-- select category --</option>
                                    @foreach ($assetcat as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="merk">Merk</label></td>
                            <td><input type="text" class="form-control" id="merk" name="merk" required></td>
                        </tr>
                        <tr>
                            <td><label for="type">Type</label></td>
                            <td><input type="text" class="form-control" id="type" name="type" required></td>
                        </tr>
                        <tr>
                            <td><label for="serialNumber">Serial Number</label></td>
                            <td><input type="text" class="form-control" id="serialNumber" name="serialNumber"></td>
                        </tr>
                        <tr>
                            <td><label for="file">Image</label></td>
                            <td>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file" required>
                                    <label class="custom-file-label" for="file">Choose file</label>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mt-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Purchase Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td><label for="vendorName">Vendor Name</label></td>
                            <td><input type="text" class="form-control" id="vendorName" name="vendorName" required></td>
                        </tr>
                        <tr>
                            <td><label for="vendorPhone">Vendor Phone</label></td>
                            <td><input type="number" class="form-control" id="vendorPhone" name="vendorPhone" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="vendorAddress">Vendor Address</label></td>
                            <td>
                                <textarea name="vendorAddress" id="vendorAddress" class="form-control"
                                    required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="buyDate">Buy Date</label></td>
                            <td><input type="date" class="form-control" id="buyDate" name="buyDate" required></td>
                        </tr>
                        <tr>
                            <td><label for="buyPrice">Buy Price</label></td>
                            <td><input type="number" class="form-control" id="buyPrice" name="buyPrice" required></td>
                        </tr>
                        <tr>
                            <td><label for="status">Buy Condition</label></td>
                            <td>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio11" name="buycond" class="custom-control-input"
                                        value="Good">
                                    <label class="custom-control-label" for="customRadio11">New</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio12" name="buycond" class="custom-control-input"
                                        value="Broken">
                                    <label class="custom-control-label" for="customRadio12">Used</label>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mt-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Asset Allocation</h6>
                </div>
                <div class="card-body">

                    <table class="table table-borderless">
                        <tr>
                            <td><label for="location">Location</label></td>
                            <td>
                                <select class="custom-select form-control" id="location" name="location" required>
                                    <option value="" selected>-- select location --</option>
                                    @foreach ($location as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="employee">Employee</label></td>
                            <td>
                                <select class="custom-select form-control" id="employee" name="employee">
                                    <option value="" selected>-- select employee --</option>
                                    @foreach ($employee as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="department">Department</label></td>
                            <td>
                                <select class="custom-select form-control" id="department" name="department" required>
                                    <option value="" selected>-- select department --</option>
                                    @foreach ($department as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="status">Condition</label></td>
                            <td>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="good_condition" name="condition" class="custom-control-input"
                                        value="Good">
                                    <label class="custom-control-label" for="good_condition">Good</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="broken_condition" name="condition" class="custom-control-input"
                                        value="Broken">
                                    <label class="custom-control-label" for="broken_condition">Broken</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="remark">Remark</label></td>
                            <td>
                                <textarea name="remark" id="remark" class="form-control" required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button class="btn btn-primary shadow" type="submit">Save</button>
                                <a href="/asset" class="btn btn-secondary shadow">Cancel</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
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

    $("#department").select2({
        theme: 'bootstrap'
    });
</script>
@endsection