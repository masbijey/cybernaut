@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Training Record</h1>

<div class="row">
    <div class="col-lg-4">
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">New Training</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('training.store') }}" enctype="multipart/form-data">
                    @csrf

                    <table class="table table-borderless">
                        <tr>
                            <td><label for="name">Employee</label></td>
                            <td>
                                <select class="js-example-basic-multiple custom-select" id="employee"
                                    name="employee_ids[]" multiple="multiple">
                                    @foreach ($employee as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="start">Start</label></td>
                            <td>
                                <input type='datetime-local' class="form-control" name="start" id="start" required>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="end">End</label></td>
                            <td><input type="datetime-local" name="end" id="end" class="form-control" required>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="venue">Venue</label></td>
                            <td><input type="string" name="venue" id="venue" class="form-control" required>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="description">Title</label></td>
                            <td><input type="text" name="description" id="description" class="form-control"></td>
                        </tr>

                        <tr>
                            <td><label for="trainer">Trainer</label></td>
                            <td><input type="text" name="trainer" id="trainer" class="form-control"></td>
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
                <h6 class="font-weight-bold text-primary">Training</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover nowrap" id="employee-table">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Employee</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Duration</th>
                            <th>Title</th>
                            <th>Trainer</th>
                            <th>Venue</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($training as $data)
                        @if(!empty($data->employee))
                        <tr class="text-center">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-left">{{ $data->employee->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->start)->format('Y-m-d H:i:s') }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->end)->format('Y-m-d H:i:s') }}</td>
                            <td class="sum">{{ \Carbon\Carbon::parse($data->duration)->format('H:i:s') }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->trainer }}</td>
                            <td>{{ $data->venue }}</td>
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
                <h6 class="font-weight-bold text-primary">Training</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover nowrap" id="employee-table1">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Employee</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Duration</th>
                            <th>Description</th>
                            <th>Trainer</th>
                            <th>Venue</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($training as $data)
                        @if(!empty($data->employee))
                        <tr class="text-center">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-left">{{ $data->employee->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->start)->format('Y-m-d H:i:s') }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->end)->format('Y-m-d H:i:s') }}</td>
                            <td class="sum">{{ \Carbon\Carbon::parse($data->duration)->format('H:i:s') }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->trainer }}</td>
                            <td>{{ $data->venue }}</td>
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
{{--
<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
    rel="stylesheet"> --}}
@endsection

@section('js')
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
</script> --}}

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
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

    // <script type="text/javascript">
    // $(function () {
    //     $('#datetimepicker').datetimepicker({
    //         format: 'YYYY-MM-DD HH:mm:ss',
    //         useCurrent: true
    //     });
    // });
</script>

</script>
@endsection