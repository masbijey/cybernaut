@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Education</h1>

<div class="row">
    <div class="col-lg-4">
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">New Education</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('education.store') }}" enctype="multipart/form-data">
                    @csrf

                    <table class="table table-borderless">
                        <tr>
                            <td><label for="name">Employee</label></td>
                            <td>
                                <select class="form-control" id="employee" name="employee">
                                    <option value="" selected>-- select employee --</option>
                                    @foreach ($employee as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="institution">Instution</label></td>
                            <td><input type="text" name="institution" id="institution" class="form-control"></td>
                        </tr>

                        <tr>
                            <td><label for="category">Skill</label></td>
                            <td><input type="text" name="category" id="category" class="form-control" required></td>
                        </tr>

                        <tr>
                            <td><label for="start">Start</label></td>
                            <td><input type="month" name="start" id="start" class="form-control" required></td>
                        </tr>

                        <tr>
                            <td><label for="end">End</label></td>
                            <td><input type="month" name="end" id="end" class="form-control" required></td>
                        </tr>

                        <tr>
                            <td><label for="description">Description</label></td>
                            <td>
                                <textarea name="description" id="description" cols="30" rows="3" class="form-control"
                                    required></textarea>
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
                <h6 class="font-weight-bold text-primary">Education</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover nowrap" id="employee-table">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Institution</th>
                            <th>Skill</th>
                            <th>Periode</th>
                            <th>Description</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($education as $data)
                        @if(!empty($data->employee))
                        <tr>
                            <td >
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ $data->employee->name }}</td>
                            <td>{{ $data->institution }}</td>
                            <td>{{ $data->category }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->start)->format('m/y') }} - {{ \Carbon\Carbon::parse($data->end)->format('m/y') }}</td>
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

    $(document).ready(function () {
        $('#employee-table').DataTable({
            responsive: true
        });
    });


</script>
@endsection