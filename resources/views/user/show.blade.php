@extends('layouts.app')

@section('title')
User Details | {{ $data->name }}
@endsection

@section('content')
<h3 class="h3 text-gray-800">User Access</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User List</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $data->name }}</li>
    </ol>
</nav>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
        <div class="card shadow">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-danger"> User= {{ $data->name}}</h5>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('user.update', $id) }}">
                    @csrf
                    @method('PUT')
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered w-100">
                            <thead>
                                <th style="width: 10%;">
                                    Feature
                                </th>
                                <th class="text-center" style="width: 10%;">
                                    Access Code
                                </th>
                                <th>Remark</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><label for="">User Management</label></td>
                                    <td class="text-center">
                                        <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->admin }}" name="admin">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="">Signage</label></td>
                                    <td class="text-center">
                                        <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->signage }}" name="signage">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="">Workorder</label></td>
                                    <td class="text-center">
                                        <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->workorder }}" name="workorder">
                                    </td>
                                    <td>1 = view, create, & add comment | Staff<br>
                                        2 = change status | SPV<br>
                                        3 = reject | HOD
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="">Task</label></td>
                                    <td class="text-center">
                                        <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->task }}" name="task">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="">Asset</label></td>
                                    <td class="text-center">
                                        <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->asset }}" name="asset">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="">Voucher</label></td>
                                    <td class="text-center">
                                        <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->voucher }}" name="voucher">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="">BEO</label></td>
                                    <td class="text-center">
                                        <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->beo }}" name="beo">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="">HRIS</label></td>
                                    <td class="text-center">
                                        <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->hris }}" name="hris">
                                    </td>
                                    <td>
                                        1 staff view only <br>
                                        2 staff, <br>
                                        3 leader, <br>
                                        4 hr dept, <br>
                                        5 super admin
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td><label for="">Attendance</label></td>
                                    <td class="text-center">
                                        <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->attendance }}" name="attendance">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="">Leave</label></td>
                                    <td class="text-center">
                                        <input type="number" min="0" max="5" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->leave }}" name="leave">
                                    </td>
                                    <td></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-primary shadow" type="submit">Save</button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary shadow">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection