@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Experience Management</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('employee') }}">Employee List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Experience Management</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">New Experience</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('experience.store') }}" enctype="multipart/form-data">
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
                        <label for="company">Company</label>
                        <input type="text" name="company" id="institution" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="jobtitle">Role</label>
                        <input type="text" name="jobtitle" id="category" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="start">Start</label>
                        <input type="month" name="start" id="start" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="end">End</label>
                        <input type="month" name="end" id="end" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="3" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="file">File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file" accept="application/pdf" required>
                            <label class="custom-file-label" for="file">Choose file</label>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-8 col-lg-8">
        <div class="card mb-2 shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Experience</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="employee-table">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Role</th>
                        <th>Periode</th>
                        <th>Description</th>
                        <th>File</th>
                    </thead>
                    <tbody>
                        @foreach($experience as $experience)
                        @if(!empty($experience->user))
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ url('employee/detail/'. $experience->user_id) }}">{{ $experience->user->name }}</a></td>
                            <td>{{ $experience->company }}</td>
                            <td>{{ $experience->jobtitle }}</td>
                            <td>{{ \Carbon\Carbon::parse($experience->start)->format('m/y') }} - {{ \Carbon\Carbon::parse($experience->end)->format('m/y') }}</td>
                            <td>{{ $experience->description }}</td>
                            <td><a href="{{ url('public/'.$experience->file) }}" class="btn btn-primary btn-sm">File</a></td>
                        </tr>
                        @endif
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