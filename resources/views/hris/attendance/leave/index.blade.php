@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Leave Management</h1>

<div class="row">
    <div class="col-lg-4">
        <div class="card mb-2 shadow">
            <div class="card-header py-3 ">
                <h6 class="m-0 font-weight-bold text-primary">Add New Leave</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('leave.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Employee</label>
                        <select class="custom-select" id="employee" name="employee">
                            <option value="" selected>Select a employee:</option>
                            @foreach ($employee as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="type" class="custom-control-input"
                                value="annual_leave">
                            <label class="custom-control-label" for="customRadio1">annual leave</label>
                        </div>

                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="type" class="custom-control-input"
                                value="public_holiday">
                            <label class="custom-control-label" for="customRadio2">day payment</label>
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
                    </div>

                    <div class="form-group">
                        <label for="entitled">Entitled</label>
                        <input type="number" name="entitled" id="entitled" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="valid_until">Valid until</label>
                        <input type="date" name="valid_until" id="valid_until" class="form-control" required>
                    </div>

                    <!-- 
                        
                            <label for="pick_date">Pick Date</label>
                            <input type="date" name="pick_date" id="pick_date" class="form-control">
                         -->

                    <div class="form-group">
                        <label for="description">Remark</label>
                        <input type="text" name="description" id="description" class="form-control" required>
                    </div>

                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card mb-3 shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Leave Data</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover " id="employee-table">
                    <thead>
                        <th>Created At</th>
                        <th>Employee</th>
                        <th>Type</th>
                        <th>Valid Date</th>
                        <th>Pick Date</th>
                        <th>Remark</th>
                    </thead>
                    <tbody>
                        @foreach($leave as $data)
                        @if(!empty($data->employee))
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/y H:i:s') }}</td>
                            <td> <a href="{{ url('/employee/detail/'.$data->user_id) }}">{{ $data->employee->name}}</a></td>
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
                                <span class="badge badge-danger badge-sm">{{ $data->pick_date }}</span>
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

    $(document).ready(function() {
        $('#employee-table').DataTable({
            responsive: true,
            "order": [
                [0, 'desc']
            ]
        });
    });
</script>
@endsection