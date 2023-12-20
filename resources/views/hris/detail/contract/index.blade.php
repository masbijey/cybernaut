@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Contract</h1>

<div class="row">
    <div class="col-lg-4">
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">New Education</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('agreement.store') }}" enctype="multipart/form-data">
                    @csrf

                    <table class="table table-borderless">
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
                            <td><label for="description">Description</label></td>
                            <td><input type="text" name="description" id="description" class="form-control" required>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="file">File</label></td>
                            <td>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="file">Choose file</label>
                                </div> '
                            </td>
                        </tr>
                    </table>

                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                    <button class="btn btn-secondary btn-sm" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">Contract</h6>
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
                        @foreach($contract as $data)
                        @if(!empty($data->employee))
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $data->employee->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->start)->format('d/m/y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->end)->format('d/m/y') }}</td>
                            <td>{{ $data->department->name }}</td>
                            <td>{{ $data->jobtitle }}</td>
                            <td>{{ $data->level }}</td>
                            <td>{{ $data->description }}</td>
                            <td><a href="{{ $data->file }}" class="btn btn-primary btn-sm">File</a></td>
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
{{--  --}}
@endsection

@section('js')
<script>
    $("#employee").select2({
        theme: 'bootstrap'
    });

    $("#department").select2({
        theme: 'bootstrap'
    });

    $(document).ready(function () {
        $('#employee-table').DataTable({
            responsive: true
        });
    });

</script>
@endsection