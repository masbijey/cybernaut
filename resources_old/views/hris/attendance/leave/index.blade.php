@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Leave</h1>

<div class="row">
    <div class="col-lg-4">
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">New Leave</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('leave.store') }}" enctype="multipart/form-data">
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
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="type" class="custom-control-input"
                                        value="annual_leave">
                                    <label class="custom-control-label" for="customRadio1">annual leave</label>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="type" class="custom-control-input"
                                        value="public_holiday">
                                    <label class="custom-control-label" for="customRadio2">Day Payment</label>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio3" name="type" class="custom-control-input"
                                        value="extra_off">
                                    <label class="custom-control-label" for="customRadio3">extra off</label>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio4" name="type" class="custom-control-input"
                                        value="sick_off">
                                    <label class="custom-control-label" for="customRadio4">sick off</label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="valid_until">Valid until</label></td>
                            <td><input type="date" name="valid_until" id="valid_until" class="form-control" required>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="pick_date">Pick Date</label></td>
                            <td><input type="date" name="pick_date" id="pick_date" class="form-control"></td>
                        </tr>

                        <tr>
                            <td><label for="description">Description</label></td>
                            <td><input type="text" name="description" id="description" class="form-control" required>
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
                <h6 class="font-weight-bold text-primary">Leave</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover nowrap table-sm" id="employee-table">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>Created At</th>
                            <th>Employee</th>
                            <th>Type</th>
                            <th>Valid Date</th>
                            <th>Pick Date</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leave as $data)
                        @if(!empty($data->employee))
                        <tr class="text-center">
                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/y H:i:s') }}</td>
                            <td><a href="{{ url('/employee/detail/'.$data->employee_id)}}">{{ $data->employee->name
                                    }}</a>
                            </td>
                            <td>
                                @if ($data->type == 'public_holiday')
                                <span class="badge badge-success">PH</span>
                                @elseif ($data->type == 'extra_off')
                                <span class="badge badge-success">EO</span>
                                @elseif ($data->type == 'annual_leave')
                                <span class="badge badge-success">AL</span>
                                @elseif ($data->type == 'sick_off')
                                <span class="badge badge-danger">SICK</span>
                                @endif
                            </td>
                            <td>
                                @if (\Carbon\Carbon::parse($data->valid_until)->isPast())
                                <span class="badge badge-danger">{{
                                    \Carbon\Carbon::parse($data->valid_until)->format('d/m/y') }}</span>

                                @elseif (\Carbon\Carbon::parse($data->valid_until)->isToday())
                                <span class="badge badge-warning">{{
                                    \Carbon\Carbon::parse($data->valid_until)->format('d/m/y') }}</span>

                                @elseif (\Carbon\Carbon::parse($data->valid_until)->isFuture())
                                <span class="badge badge-success">{{
                                    \Carbon\Carbon::parse($data->valid_until)->format('d/m/y') }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->pick_date == null)
                                <span class="badge badge-success badge-sm">belum diambil</span>
                                @else
                                <span class="badge badge-danger badge-sm">{{
                                    \Carbon\Carbon::parse($data->pick_date)->format('d/m/y') }}</span>
                                @endif
                            </td>
                            <td>{{ $data->description }}</td>
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

    $("#type").select2({
        theme: 'bootstrap'
    });

    $(document).ready(function () {
        $('#employee-table').DataTable({
            responsive: true,
            "order": [[0, 'desc']]
        });
    });

</script>
@endsection