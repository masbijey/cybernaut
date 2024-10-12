@extends('layouts.app')

@section('title')
Create new project
@endsection

@section('content')
<h1 class="h3 mb-2 text-gray-800">New Project</h1>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Project List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add New Project</li>
    </ol>
</nav>

<form method="POST" action="{{ route('project.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-12 col-xl-4 col-sm-12">
            <div class="card mb-3 shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label for="project_name" class="font-weight-bold">Project name : <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="project_name" required>
                    </div>
                    <div class="form-group">
                        <label for="project_desc" class="font-weight-bold">Project description : <small class="text-danger">*</small></label>
                        <textarea name="project_desc" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="project_start_date" class="font-weight-bold">Start date : <small class="text-danger">*</small></label>
                        <input type="date" class="form-control" name="project_start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="project_due_date" class="font-weight-bold">Due date : <small class="text-danger">*</small></label>
                        <input type="date" class="form-control" name="project_due_date" required>
                    </div>
                    <button type="submit" class="btn btn-primary shadow-sm">Save</button>
                    <a href="{{ route('project.index') }}" class="btn btn-secondary shadow-sm">Cancel</a>
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

    $("#assets").select2({
        theme: 'bootstrap'
    });

    $("#location").select2({
        theme: 'bootstrap'
    });
</script>
@endsection