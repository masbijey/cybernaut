@extends('layouts.app')

@section('css')
<!--  -->
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

    $("#department").select2({
        theme: 'bootstrap'
    });

    $(document).ready(function() {
        $('#employee-table').DataTable({
            responsive: true
        });
    });
</script>
@endsection

@section('content')
<h1 class="h3 text-gray-800">Contract Management</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Contract Management</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="card mb-2 shadow">
            <div class="card-header bg-gradient-primary text-light py-3">
                <h6 class="m-0 font-weight-bold">New Contract</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('agreement.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="font-weight-bolder">Employee</label>
                        <select class="custom-select" id="employee" name="employee" required>
                            <option value="" selected>-- select employee --</option>
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
                            <option value="" selected>-- select department --</option>
                            @foreach ($department as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jobtitle" class="font-weight-bolder">Job Title</label>
                        <input type="text" name="jobtitle" id="jobtitle" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="level" class="font-weight-bolder">Level</label>
                        <input type="text" name="level" id="level" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description" class="font-weight-bolder">Remark</label>
                        <input type="text" name="description" id="description" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="customFile" class="font-weight-bolder">Upload File</label>
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="file" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-8">
        <div class="card mb-2 shadow">
            <div class="card-header bg-gradient-primary text-light py-3">
                <h6 class="m-0 font-weight-bold">Contract</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover nowrap" id="employee-table">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Employee</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Department</th>
                            <th>Jobtitle</th>
                            <th>Level</th>
                            <th>Description</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contract as $contract)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $contract->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($contract->start)->format('d/m/y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($contract->end)->format('d/m/y') }}</td>
                            <td>{{ $contract->department->name }}</td>
                            <td>{{ $contract->jobtitle }}</td>
                            <td>{{ $contract->level }}</td>
                            <td>{{ $contract->description }}</td>
                            <td><a href="{{ $data->file }}" class="btn btn-primary btn-sm">File</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection