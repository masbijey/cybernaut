@extends('layouts.app')

@section('title')
Add new asset
@endsection

@section('content')
<h1 class="h3 text-gray-800">Add new asset</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('asset') }}">Assets List</a></li>
        <li class="breadcrumb-item">Add new asset</li>
    </ol>
</nav>

<form method="POST" action="{{ route('asset.store') }}" enctype="multipart/form-data" id="priceForm">
    @csrf
    <div class="row mt-4 mb-4">
        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card mb-3 shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Asset information</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="font-weight-bold">Asset name : <small class="text-danger">*</small></label>
                        <input type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            id="name"
                            name="name">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category" class="font-weight-bold">Category : <small class="text-danger">*</small></label>
                        <select class="custom-select form-control @error('name') is-invalid @enderror"
                            id="category"
                            name="category"
                            style="width: 100%;">
                            <option value="" selected disabled>select a category</option>
                            @foreach ($assetcat as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="merk" class="font-weight-bold">Merk : <small class="text-danger">*</small></label>
                        <input type="text"
                            class="form-control @error('merk') is-invalid @enderror"
                            value="{{ old('merk') }}"
                            id="merk"
                            name="merk">
                        @error('merk')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="type" class="font-weight-bold">Type / Model : <small class="text-danger">*</small></label>
                        <input type="text"
                            class="form-control @error('merk') is-invalid @enderror"
                            id="type"
                            name="type">
                        @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="serialNumber" class="font-weight-bold">Serial number : <small class="text-danger">*</small></label>
                        <input type="text"
                            class="form-control @error('merk') is-invalid @enderror"
                            id="serialNumber"
                            name="serialNumber">
                        @error('serialNumber')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="file" class="font-weight-bold">Asset photo : <small class="text-danger">*</small></label>
                        <div class="custom-file">
                            <input type="file"
                                class="custom-file @error('merk') is-invalid @enderror"
                                id="file"
                                name="file"
                                accept="image/*"
                                capture="environment">
                            @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <label class="custom-file-label" for="file">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card mb-3 shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Purchase information</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="vendorName" class="font-weight-bold">Vendor name : <small class="text-danger">*</small></label>
                        <input type="text"
                            class="form-control @error('vendorName') is-invalid @enderror"
                            id="vendorName"
                            name="vendorName">
                        @error('vendorName')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="vendorPhone" class="font-weight-bold">Vendor phone : <small class="text-danger">*</small></label>
                        <input type="number"
                            class="form-control @error('vendorPhone') is-invalid @enderror"
                            id="vendorPhone"
                            name="vendorPhone">
                        @error('vendorPhone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="vendorAddress" class="font-weight-bold">Vendor address : <small class="text-danger">*</small></label>
                        <textarea name="vendorAddress"
                            id="vendorAddress"
                            class="form-control @error('vendorAddress') is-invalid @enderror"></textarea>
                        @error('vendorAddress')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="buyDate" class="font-weight-bold">Buy date : <small class="text-danger">*</small></label>
                        <input type="date"
                            class="form-control @error('buyDate') is-invalid @enderror"
                            id="buyDate"
                            name="buyDate">
                        @error('buyDate')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="buyPrice" class="font-weight-bold">Buy price : <small class="text-danger">*</small></label>
                        <input type="text"
                            class="form-control @error('buyPrice') is-invalid @enderror"
                            id="buyPrice"
                            name="buyPrice">
                        @error('buyPrice')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status" class="font-weight-bold">Buy condition : <small class="text-danger">*</small></label><br>
                        <div class="custom-control custom-radio custom-control-inline @error('buycond') is-invalid @enderror">
                            <input type="radio" id="customRadio11" name="buycond" class="custom-control-input" value="Good">
                            <label class="custom-control-label font-weight-bolder text-success" for="customRadio11">New</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadio12" name="buycond" class="custom-control-input" value="Broken">
                            <label class="custom-control-label font-weight-bolder text-warning" for="customRadio12">Used</label>
                        </div>
                        @error('buycond')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="remark" class="font-weight-bold">Asset remark : <small class="text-danger">*</small></label>
                        <textarea name="asset_remark"
                            id="remark"
                            class="form-control @error('asset_remark') is-invalid @enderror"></textarea>
                        @error('asset_remark')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="card mb-3 shadow">
                <div class="card-header text-primary py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Asset allocation</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="location" class="font-weight-bold">Location : <small class="text-danger">*</small></label>
                        <select class="custom-select form-control @error('buyPrice') is-invalid @enderror" id="location" name="location" style="width: 100%;">
                            <option value="" selected disabled>select a location</option>
                            @foreach ($location as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="employee" class="font-weight-bold">Employee : <small class="text-danger">*</small></label>
                        <select class="custom-select form-control @error('buyPrice') is-invalid @enderror" id="employee" name="employee" style="width: 100%;">
                            <option value="" selected disabled>select a employee</option>
                            @foreach ($employee as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        @error('employee')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="department" class="font-weight-bold">Department : <small class="text-danger">*</small></label>
                        <select class="custom-select form-control @error('buyPrice') is-invalid @enderror" id="department" name="department" style="width: 100%;">
                            <option value="" selected disabled>select a department</option>
                            @foreach ($department as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        @error('department')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status" class="font-weight-bold">Condition : <small class="text-danger">*</small></label><br>
                        <div class="custom-control custom-radio custom-control-inline @error('condition') is-invalid @enderror">
                            <input type="radio" id="good_condition" name="condition" class="custom-control-input" value="Good">
                            <label class="custom-control-label text-success font-weight-bolder" for="good_condition">Good</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="broken_condition" name="condition" class="custom-control-input" value="Broken">
                            <label class="custom-control-label text-danger font-weight-bolder" for="broken_condition">Broken</label>
                        </div>
                        @error('condition')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="remark" class="font-weight-bold">Allocation Remark : <small class="text-danger">*</small></label>
                        <textarea name="remark" id="remark" class="form-control @error('remark') is-invalid @enderror"></textarea>
                        @error('remark')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary shadow-sm" type="submit">Save</button>
                <a href="{{ route('asset.index') }}" class="btn btn-secondary shadow-sm">Cancel</a>
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