@extends('layouts.app')

@section('title')
Add new asset
@endsection

@section('content')
<h1 class="h3 text-gray-800">NEW ASSET</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('asset') }}">Assets List</a></li>
        <li class="breadcrumb-item">Add new asset</li>
    </ol>
</nav>

<form method="POST" action="{{ route('asset.store') }}" enctype="multipart/form-data" id="priceForm">
    @csrf
    <div class="row mt-4">
        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card mb-3 shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Asset Information</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Asset Name :</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="category">Category :</label>
                        <select class="custom-select form-control" id="category" name="category" required style="width: 100%;">
                            <option value="" selected>select a category</option>
                            @foreach ($assetcat as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="merk">Merk :</label>
                        <input type="text" class="form-control" id="merk" name="merk" required>
                    </div>

                    <div class="form-group">
                        <label for="type">Type / Model :</label>
                        <input type="text" class="form-control" id="type" name="type" required>
                    </div>

                    <div class="form-group">
                        <label for="serialNumber">Serial Number :</label>
                        <input type="text" class="form-control" id="serialNumber" name="serialNumber" required>
                    </div>

                    <div class="form-group">
                        <label for="file">Asset Photo :</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file" accept="image/*" capture="environment" required>
                            <label class="custom-file-label" for="file">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card mb-3 shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Purchase Information</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="vendorName">Vendor Name :</label>
                        <input type="text" class="form-control" id="vendorName" name="vendorName" required>
                    </div>
                    <div class="form-group">
                        <label for="vendorPhone">Vendor Phone :</label>
                        <input type="number" class="form-control" id="vendorPhone" name="vendorPhone" required>
                    </div>
                    <div class="form-group">
                        <label for="vendorAddress">Vendor Address :</label>
                        <textarea name="vendorAddress" id="vendorAddress" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="buyDate">Buy Date :</label>
                        <input type="date" class="form-control" id="buyDate" name="buyDate" required>
                    </div>
                    <div class="form-group">
                        <label for="buyPrice">Buy Price :</label>
                        <input type="text" class="form-control" id="buyPrice" name="buyPrice" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Buy Condition :</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadio11" name="buycond" class="custom-control-input" value="Good" required>
                            <label class="custom-control-label" for="customRadio11">New</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadio12" name="buycond" class="custom-control-input" value="Broken" required>
                            <label class="custom-control-label" for="customRadio12">Used</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remark">Asset Remark :</label>
                        <textarea name="asset_remark" id="remark" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card mb-3 shadow">
                <div class="card-header text-primary py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Asset Allocation</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="location">Location :</label>
                        <select class="custom-select form-control" id="location" name="location" required style="width: 100%;">
                            <option value="" selected>select a location</option>
                            @foreach ($location as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="employee">Employee :</label>
                        <select class="custom-select form-control" id="employee" name="employee" required style="width: 100%;">
                            <option value="" selected>select a employee</option>
                            @foreach ($employee as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="department">Department :</label>
                        <select class="custom-select form-control" id="department" name="department" required style="width: 100%;">
                            <option value="" selected>select a department</option>
                            @foreach ($department as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Condition :</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="good_condition" name="condition" class="custom-control-input" value="Good" required>
                            <label class="custom-control-label" for="good_condition">Good</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="broken_condition" name="condition" class="custom-control-input" value="Broken" required>
                            <label class="custom-control-label" for="broken_condition">Broken</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remark">Allocation Remark :</label>
                        <textarea name="remark" id="remark" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary shadow" type="submit">Save</button>
                <a href="{{ route('asset.index') }}" class="btn btn-secondary shadow">Cancel</a>
            </div>
        </div>
    </div>
</form>
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

    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });

    const priceForm = document.getElementById('priceForm');
    const buyPriceInput = document.getElementById('buyPrice');

    priceForm.addEventListener('submit', function(e) {
        // Remove commas before form submission
        buyPriceInput.value = buyPriceInput.value.replace(/,/g, '');
    });

    buyPriceInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/,/g, '');

        if (!isNaN(value) && value.length > 0) {
            setTimeout(() => {
                const cursorPosition = buyPriceInput.selectionStart;
                const formattedValue = Number(value).toLocaleString('en');
                e.target.value = formattedValue;

                const newCursorPosition = cursorPosition + (formattedValue.length - value.length);
                buyPriceInput.setSelectionRange(newCursorPosition, newCursorPosition);
            }, 0);
        }
    });
</script>
@endsection