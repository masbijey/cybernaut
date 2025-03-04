@extends('layouts.app')

@section('title')
Create Ticket
@endsection

@section('content')
<h1 class="h3 text-gray-800">Create Ticket</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('workorder.index') }}">Ticket List</a></li>
        <li class="breadcrumb-item active" aria-current="page">New Ticket</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-6 mb-4">
        <form method="POST" action="{{ route('workorder.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card shadow mt-2 mb-3">
                <div class="card-body">
                    <div class="form-group">
                        <label for="department" class="font-weight-bolder">To Department :</label>
                        <select class="js-example-basic-multiple custom-select form-control-sm" id="tag-department" name="department_ids[]" multiple="multiple" style="width: 100%;" required>
                            @foreach($department as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select> <br>
                        <small class="text-info">*tandai department tujuan | dapat memilih lebih dari satu</small>
                    </div>

                    <div class="form-group">
                        <label for="file" class="font-weight-bolder">Insert image :</label> <br>
                        <input type="file" name="file" id="file"> <br>
                        <small class="text-info">*dapat menambahkan lebih banyak file setelah wo dibuat.</small>
                    </div>

                    <div class="form-group">
                        <label for="title" class="font-weight-bolder">Subject :</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="description" class="font-weight-bolder">Message :</label>
                        <textarea name="description" id="description" name="description" class="form-control form-control-sm" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="due_date" class="font-weight-bolder">Due date :</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="priority" class="font-weight-bolder">Priority :</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="Low" name="priority" class="custom-control-input" value="Low" required>
                            <label class="custom-control-label text-success font-weight-bolder" for="Low">Low</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="Medium" name="priority" class="custom-control-input" value="Medium" required>
                            <label class="custom-control-label text-warning font-weight-bolder" for="Medium">Medium</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="High" name="priority" class="custom-control-input" value="High" required>
                            <label class="custom-control-label text-danger font-weight-bolder" for="High">High</label>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label for="tag" class="font-weight-bolder">Tag Asset :</label>
                        <select class="js-example-basic-multiple custom-select form-control form-control-sm" id="tag-asset" name="asset_ids[]" multiple="multiple">
                            @foreach($asset as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-info">*tandai asset jika ada | dapat memilih lebih dari satu</small>
                    </div>

                    <div class="form-group">
                        <label for="tag" class="font-weight-bolder">Tag Location :</label>
                        <select class="js-example-basic-multiple custom-select form-control form-control-sm" id="tag-location" name="location_ids[]" multiple="multiple">
                            @foreach($location as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-info">*tandai location jika ada | dapat memilih lebih dari satu</small>
                    </div>
 -->
                </div>
            </div>
            <button class="btn btn-primary shadow" type="submit">Save</button>
            <a href="{{ route('workorder.index') }}" class="btn btn-secondary shadow">Cancel</a>
        </form>
    </div>
</div>
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

    $("#tag-department").select2({
        theme: 'bootstrap'
    });
</script>
@endsection