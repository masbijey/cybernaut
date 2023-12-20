@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Reward & Punishment Record</h1>

<div class="row">
    <div class="col-lg-4">
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">New Reward & Punishment</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('rewpun.store') }}" enctype="multipart/form-data">
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
                            <td><label for="type">Type</label></td>
                            <td>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-secondary active">
                                      <input type="radio" name="type" id="option1" autocomplete="off" checked="" value="reward"> Reward
                                    </label>
                                    <label class="btn btn-secondary">
                                      <input type="radio" name="type" id="option2" autocomplete="off" value="punishment"> Punishment
                                    </label>
                                  </div>                                  
                            </td>
                        </tr>

                        <tr>
                            <td><label for="start">Start</label></td>
                            <td><input type="date" name="start" id="institution" class="form-control"></td>
                        </tr>

                        <tr>
                            <td><label for="end">End</label></td>
                            <td><input type="date" name="end" id="end" class="form-control"></td>
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

    <div class="col-lg-8 d-none d-sm-block">
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">Inventory</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover nowrap" id="employee-table">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Employee</th>
                            <th>Type</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rewpun as $data)
                        @if(!empty($data->employee))
                        <tr class="text-center">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-left">{{ $data->employee->name }}</td>
                            <td>
                                @if ($data->type == 'reward')
                                    <span class="badge badge-success">{{ $data->type}}</span>
                                @else
                                <span class="badge badge-danger">{{ $data->type}}</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($data->start)->format('d/m/y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->end)->format('d/m/y') }}</td>
                            <td>{{ $data->description }}</td>
                            <td><a href="{{ $data->file }}" class="btn btn-primary btn-sm">FILE</a></td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-8 d-block d-sm-none">
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">Inventory</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover nowrap" id="employee-table1">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Employee</th>
                            <th>Type</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Description</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rewpun as $data)
                        @if(!empty($data->employee))
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $data->employee->name }}</td>
                            <td>
                                @if ($data->type == 'reward')
                                <span class="badge badge-success">{{ $data->type}}</span>
                                @else
                                <span class="badge badge-danger">{{ $data->type}}</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($data->start)->format('d/m/y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->end)->format('d/m/y') }}</td>
                            <td>{{ $data->description }}</td>
                            <td><a href="{{ $data->file }}" class="btn btn-primary btn-sm">FILE</a></td>
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

    $("#department").select2({
        theme: 'bootstrap'
    });

    $(document).ready(function () {
        $('#employee-table').DataTable({
            responsive: true
        });
    });

    $(document).ready(function () {
        $('#employee-table1').DataTable({
            responsive: true
        });
    });

</script>
@endsection