@extends('layouts.app')

@section('css')

@endsection

@section('js')
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $("#employee").select2({
        theme: 'bootstrap'
    });

    // $("#department").select2({
    //     theme: 'bootstrap'
    // });

    $(document).ready(function() {
        $('#employee-table').DataTable({
            responsive: true
        });
    });

    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endsection

@section('content')
<h1 class="h3 text-gray-800">CONTRACT MANAGEMENT</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('employee') }}">Employee List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Contract Management</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="card mb-2 shadow-sm">
            <div class="card-header text-primary">
                <h6 class="m-0 font-weight-bold">New Contract</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('agreement.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="font-weight-bolder">Employee</label>
                        <select class="custom-select" id="employee" name="employee" required>
                            <option value="" selected>Select a employee:</option>
                            @foreach ($employee as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="start" class="font-weight-bolder">Period (Start)</label>
                        <input type="date" name="start" id="start" class="form-control" placeholder="select date" required>
                    </div>

                    <div class="form-group">
                        <label for="end" class="font-weight-bolder">Period (End)</label>
                        <input type="date" name="end" id="end" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="department" class="font-weight-bolder">Department</label>
                        <select class="custom-select" id="department" name="department" required>
                            <option value="" selected> Select a department:</option>
                            @foreach ($department as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jobtitle" class="font-weight-bolder">Role</label>
                        <input type="text" name="jobtitle" id="jobtitle" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="level" class="font-weight-bolder">Level</label>
                        <select class="custom-select" name="level" id="level">
                            <option value="" selected>Select a level:</option>
                            <option value="Senior Manager">Senior Manager</option>
                            <option value="Manager">Manager</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Staff">Staff</option>
                            <option value="Daily Worker">Daily Worker</option>
                            <option value="Outsourcing">Outsourcing</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description" class="font-weight-bolder">Remark</label>
                        <input type="text" name="description" id="description" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="file" class="font-weight-bolder">Upload File</label>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file" accept="application/pdf" required>
                            <label class="custom-file-label" for="file">Choose file</label>
                        </div>
                        <small>*pdf only</small>
                    </div>


                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-8">
        <div class="card mb-2 shadow-sm">
            <div class="card-header text-primary">
                <h6 class="m-0 font-weight-bold">Contract</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="employee-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Department</th>
                            <th>Role</th>
                            <th>Level</th>
                            <th>Remark</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contract as $contract)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ url('employee/detail/'.$contract->user_id) }}">{{ $contract->user->name }}</a></td>
                            <td>{{ \Carbon\Carbon::parse($contract->start)->format('d/m/y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($contract->end)->format('d/m/y') }}</td>
                            <td>{{ $contract->department->name }}</td>
                            <td>{{ $contract->jobtitle }}</td>
                            <td>{{ $contract->level }}</td>
                            <td>{{ $contract->description }}</td>
                            <td><a href="{{ $data->file }}" class="btn btn-outline-secondary btn-sm">File</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection