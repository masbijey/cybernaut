@extends('layouts.app')

@section('title')
User Details | {{ $data->name }}
@endsection

@section('content')
<h3 class="h3 text-gray-800">User Details</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User List</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $data->name }}</li>
    </ol>
</nav>
<div class="col-sm-12 col-md-12 col-lg-4">
    <div class="card shadow mt-4 mb-4">
        <div class="card-header py-3 bg-gradient-primary">
            <h6 class="m-0 font-weight-bold text-light">{{ $data->name}}</h6>
        </div>

        <div class="card-body">
            <p>Rules : </p>
            <p>0 = no access, <br> 1 = read only, <br> 2 = read, write, <br> 3 = read, write, approved, <br> 4 = full access</p>
            <small> Last Update : {{ $data->updated_at }}</small>

            <form method="POST" action="{{ route('user.update', $id) }}">
                @csrf
                @method('PUT')

                <table class="table table-hover table-sm">
                    <thead>
                        <th>
                            Feature
                        </th>
                        <th class="text-center">
                            Access Code
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label for="">User Management</label></td>
                            <td class="text-center">
                                <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->admin }}" name="admin">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">Signage</label></td>
                            <td class="text-center">
                                <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->signage }}" name="signage">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">Workorder</label></td>
                            <td class="text-center">
                                <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->workorder }}" name="workorder">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">Task</label></td>
                            <td class="text-center">
                                <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->task }}" name="task">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">Asset</label></td>
                            <td class="text-center">
                                <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->asset }}" name="asset">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">Voucher</label></td>
                            <td class="text-center">
                                <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->voucher }}" name="voucher">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">BEO</label></td>
                            <td class="text-center">
                                <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->beo }}" name="beo">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">HRIS</label></td>
                            <td class="text-center">
                                <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->hris }}" name="hris">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">Attendance</label></td>
                            <td class="text-center">
                                <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->attendance }}" name="attendance">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">Leave</label></td>
                            <td class="text-center">
                                <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->leave }}" name="leave">
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <button class="btn btn-primary shadow" type="submit">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection