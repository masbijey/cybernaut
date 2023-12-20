@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">New Project</h1>

<form method="POST" action="{{ route('project.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-4">
            <div class="card mt-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Project Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td><label for="date">Date</label></td>
                            <td><input type="date" class="form-control form-control-sm" id="date" name="planStartDate" required></td>
                        </tr>
                        <tr>
                            <td><label for="description">Description</label></td>
                            <td>
                                <textarea name="description" id="description" class="form-control form-control-sm" required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="due_date">Due date</label></td>
                            <td><input type="date" class="form-control form-control-sm" id="due_date" name="due_date" required></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-primary shadow">Save</button>
                                <a href="/project" class="btn btn-secondary">Cancel</a>
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

    $("#assets").select2({
        theme: 'bootstrap'
    });

    $("#location").select2({
        theme: 'bootstrap'
    });
</script>
@endsection