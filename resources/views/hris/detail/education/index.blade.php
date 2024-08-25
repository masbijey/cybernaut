@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Education Management</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('employee')}}">Employee List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Education Management</li>
    </ol>
</nav>


<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">New Education</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('education.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name"><b>Employee</b></label>
                        <select class="form-control" id="employee" name="employee">
                            <option value="" selected>-- select employee --</option>
                            @foreach ($employee as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="institution"><b>Institution</b></label>
                        <input type="text" name="institution" id="institution" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category"><b>Skill</b></label>
                        <input type="text" name="category" id="category" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="start"><b>Start</b></label>
                        <input type="month" name="start" id="start" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="end"><b>End</b></label>
                        <input type="month" name="end" id="end" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description"><b>Description</b></label>
                        <textarea name="description" id="description" cols="30" rows="3" class="form-control"
                            required></textarea>
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

    <div class="col-lg-8">
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Education</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="employee-table">
                    <thead>
                        <th>#</th>
                        <th>Employee</th>
                        <th>Institution</th>
                        <th>Skill</th>
                        <th>Periode</th>
                        <th>Description</th>
                        <th>File</th>
                    </thead>
                    <tbody>
                        @foreach($education as $education)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ url('employee/detail/'.$education->user_id) }}">{{ $education->user->name }}</a></td>
                            <td>{{ $education->institution }}</td>
                            <td>{{ $education->category }}</td>
                            <td>{{ \Carbon\Carbon::parse($education->start)->format('m/y') }} - {{ \Carbon\Carbon::parse($education->end)->format('m/y') }}</td>
                            <td>{{ $education->remark }}</td>
                            <td><a href="{{ $education->file }}" class="btn btn-outline-secondary btn-sm">File</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@section('css')
{{-- --}}
@endsection

@section('js')
<script>
    $("#employee").select2({
        theme: 'bootstrap'
    });

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