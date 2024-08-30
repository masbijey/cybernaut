@extends('layouts.app')

@section('title')
Employee Leave Form
@endsection

@section('content')
<h1 class="h3 text-gray-800">Employee Leave Form</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('leave') }}">Leave Management</a></li>
        <li class="breadcrumb-item">Employee Leave Form</li>
    </ol>
</nav>

<div class="row">
    <div class="d-block d-sm-none d-md-none container">
        @foreach ($data as $history)
        <div class="card mb-3 shadow">
            <div class="card-body">
                <h5 class="card-title">{{ $history->employee->name }}</h5>
                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <td>Start date</td>
                            <td>{{ \Carbon\Carbon::parse($history->start_date)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td>End date</td>
                            <td>{{ \Carbon\Carbon::parse($history->end_date)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td>Work date</td>
                            <td>{{ \Carbon\Carbon::parse($history->work_date)->format('d-m-Y') }}</td>
                        </tr>
                    </tbody>
                </table>

                @if ($history->approved_3_by == null)
                <button type="button" class="btn btn-primary shadow" data-toggle="modal" data-target="#sm_approved_modal_{{ $history->id }}">
                    approve here
                </button>
                @else
                <button type="button" class="btn btn-primary shadow" data-toggle="modal" data-target="#sm_approved_modal_{{ $history->id }}">
                    approve here
                </button>

                <button type="button" class="btn btn-success shadow" disabled>
                    Approved!
                </button>
                @endif

                <div class="modal" id="sm_approved_modal_{{ $history->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="card-title">{{ $history->employee->name }}</h5>
                                <table class="table table-sm table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Created at</td>
                                            <td>: <small>{{ $history->created_at }}</small></td>
                                        </tr>
                                        <tr>
                                            <td>Start date</td>
                                            <td>: {{ \Carbon\Carbon::parse($history->start_date)->format('d-m-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>End date</td>
                                            <td>: {{ \Carbon\Carbon::parse($history->end_date)->format('d-m-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Work date</td>
                                            <td>: {{ \Carbon\Carbon::parse($history->work_date)->format('d-m-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Leaves</td>
                                            <td>: </td>
                                        </tr>
                                        <tr>
                                            <td>Reason</td>
                                            <td>: <small>{{ $history->remark }}</small> </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <form action="">
                                    <div class="form-group">
                                        <label for="test" class="font-weight-bold">HR Approval</label>
                                        <select class="custom-select" name="hr_status">
                                            <option selected="" disabled>select type:</option>
                                            <option value="1">Approved</option>
                                            <option value="2">Rejected</option>
                                        </select>
                                        <small>hr manager / hr admin (for)</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="test" class="font-weight-bold">Leader 1</label>
                                        <select class="custom-select" name="leader1_status">
                                            <option selected="" disabled>select type:</option>
                                            <option value="1">Approved</option>
                                            <option value="2">Rejected</option>
                                        </select>
                                        <small>supervisor / hod</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="test" class="font-weight-bold">Leader 2</label>
                                        @if ($history->approved_3_by == null)
                                        <select class="custom-select" name="leader2_status">
                                            <option selected="" disabled>select type:</option>
                                            <option value="1">Approved</option>
                                            <option value="2">Rejected</option>
                                        </select>
                                        <small>hod / general manager</small>
                                        @else
                                        <input type="text" class="form-control" disabled value="Approved by {{ $history->approval->name }} {{ $history->approved_3_at }}">
                                        @endif
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-none d-sm-block">
        <div class="col-lg-12">
            <div class="card mb-3 shadow">
                <div class="card-body">
                    <table class="table table-hover" id="employee-table" style="width: 100%;">
                        <thead>
                            <th>Employee Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Work Date</th>
                            <th>HR Approval</th>
                            <th>Leader Approval (1)</th>
                            <th>Leader Approval (2)</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $history)
                            <tr>
                                <td>{{ $history->employee->name }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($history->start_date)->format('d-m-Y') }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($history->end_date)->format('d-m-Y') }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($history->work_date)->format('d-m-Y') }}
                                </td>
                                <td><span class="badge badge-warning">Waiting</span></td>
                                <td><span class="badge badge-warning">Waiting</span></td>
                                <td><span class="badge badge-warning">Waiting</span></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm shadow" data-toggle="modal" data-target="#exampleModal">
                                        approve here
                                    </button>

                                    <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <form action="">
                                                        <div class="form-group">
                                                            <label for="test" class="font-weight-bold">HR Approval</label>
                                                            <select class="custom-select">
                                                                <option selected="">select type:</option>
                                                                <option value="1">Approved</option>
                                                                <option value="2">Rejected</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="test" class="font-weight-bold">Leader 1</label>
                                                            <select class="custom-select">
                                                                <option selected="">select type:</option>
                                                                <option value="1">Approved</option>
                                                                <option value="2">Rejected</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="test" class="font-weight-bold">Leader 2</label>
                                                            <select class="custom-select">
                                                                <option selected="">select type:</option>
                                                                <option value="1">Approved</option>
                                                                <option value="2">Rejected</option>
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary btn-sm">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
            responsive: false,
            "order": [
                [0, 'desc']
            ]
        });
    });
</script>
@endsection