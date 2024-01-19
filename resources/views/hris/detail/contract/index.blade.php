@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Contract</h1>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="card mt-3 shadow">
            <div class="card-header bg-primary text-light">
                <h6 class="font-weight-bold">New Contract</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('agreement.store') }}" enctype="multipart/form-data">
                    @csrf

                    <table class="table table-borderless table-sm">
                        <tr>
                            <td><label for="name">Employee</label></td>
                            <td>
                                <select class="custom-select" id="employee" name="employee">
                                    <option value="" selected>-- select employee --</option>
                                    @foreach ($employee as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="start">Start</label></td>
                            <td><input type="date" name="start" id="institution" class="form-control"></td>
                        </tr>

                        <tr>
                            <td><label for="end">End</label></td>
                            <td><input type="date" name="end" id="category" class="form-control" required></td>
                        </tr>

                        <tr>
                            <td><label for="department">Department</label></td>
                            <td>
                                <select class="custom-select" id="department" name="department">
                                    <option value="" selected>-- select department --</option>
                                    @foreach ($department as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="jobtitle">Job Title</label></td>
                            <td><input type="text" name="jobtitle" id="jobtitle" class="form-control" required></td>
                        </tr>

                        <tr>
                            <td><label for="level">Level</label></td>
                            <td><input type="text" name="level" id="level" class="form-control" required></td>
                        </tr>

                        <tr>
                            <td><label for="description">Remark</label></td>
                            <td><input type="text" name="description" id="description" class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <td><label for="file">File</label></td>
                            <td>
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" id="customFile" name="file">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                    <button class="btn btn-secondary btn-sm" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-8">
        <div class="card mt-3 shadow">
            <div class="card-header bg-primary text-light">
                <h6 class="font-weight-bold">Contract</h6>
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

@section('css')
{{-- --}}
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