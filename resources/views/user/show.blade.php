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

<div class="card shadow mt-4">
    <div class="card-header bg-primary">
        <h6 class="m-0 font-weight-bold text-light">{{ $data->name}}</h6>
    </div>

    <div class="card-body">
        <table class="table table-sm table-hover"">
            <td size=" 30">Last Update</td>
            <td>: {{ $data->updated_at }}</td>
        </table>

        <form method="POST" action="{{ route('user.update', $id) }}">
            @csrf
            @method('PUT')
            <table class="table table-sm table-hover">
                <th>
                    Feature
                </th>
                <th class="text-center">
                    Access Code
                </th>
                <th>
                    Access Information
                </th>
                <tr>
                    <td class="" width="10%"><label for="Admin">User Management</label></td>
                    <td class="text-center">
                        <input type="text"
                            class="form-control-sm bg-warning text-dark font-weight-bold text-center bg-warning text-dark font-weight-bold text-center"
                            value="{{ $data->role->admin }}" size="3" name="admin">
                    </td>
                    <td><i>0 = no access, 1 = full access</i></td>
                </tr>
                <tr>
                    <td><label for="Admin">Signage</label></td>
                    <td class="text-center">
                        <input type="text" class="form-control-sm bg-warning text-dark font-weight-bold text-center"
                            value="{{ $data->role->signage }}" size="3" name="signage">
                    </td>
                    <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = special</i></td>

                </tr>
                <tr>
                    <td><label for="Admin">Workorder</label></td>
                    <td class="text-center">
                        <input type="text" class="form-control-sm bg-warning text-dark font-weight-bold text-center"
                            value="{{ $data->role->workorder }}" size="3" name="workorder">
                    </td>
                    <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = approval, 4 = special </i></td>
                </tr>
                <tr>
                    <td><label for="Admin">Task</label></td>
                    <td class="text-center">
                        <input type="text" class="form-control-sm bg-warning text-dark font-weight-bold text-center"
                            value="{{ $data->role->task }}" size="3" name="task">
                    </td>
                    <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = approval, 4 = special </i></td>
                </tr>
                <tr>
                    <td><label for="Admin">Asset</label></td>
                    <td class="text-center">
                        <input type="text" class="form-control-sm bg-warning text-dark font-weight-bold text-center"
                            value="{{ $data->role->asset }}" size="3" name="asset">
                    </td>
                    <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = approval, 4 = special </i></td>
                </tr>
                <tr>
                    <td><label for="Admin">Voucher</label></td>
                    <td class="text-center">
                        <input type="text" class="form-control-sm bg-warning text-dark font-weight-bold text-center"
                            value="{{ $data->role->voucher }}" size="3" name="voucher">
                    </td>
                    <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = approval, 4 = special </i></td>
                </tr>
                <tr>
                    <td><label for="Admin">BEO</label></td>
                    <td class="text-center">
                        <input type="text" class="form-control-sm bg-warning text-dark font-weight-bold text-center"
                            value="{{ $data->role->beo }}" size="3" name="beo">
                    </td>
                    <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = approval, 4 = special </i></td>
                </tr>
                <tr>
                    <td><label for="Admin">HRIS</label></td>
                    <td class="text-center">
                        <input type="text" class="form-control-sm bg-warning text-dark font-weight-bold text-center"
                            value="{{ $data->role->hris }}" size="3" name="hris">
                    </td>
                    <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = approval, 4 = special </i></td>
                </tr>
                <tr>
                    <td><label for="Admin">Attendance</label></td>
                    <td class="text-center">
                        <input type="text" class="form-control-sm bg-warning text-dark font-weight-bold text-center"
                            value="{{ $data->role->attendance }}" size="3" name="attendance">
                    </td>
                    <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = approval, 4 = special </i></td>
                </tr>
                <tr>
                    <td><label for="Admin">Leave</label></td>
                    <td class="text-center">
                        <input type="text" class="form-control-sm bg-warning text-dark font-weight-bold text-center"
                            value="{{ $data->role->leave }}" size="3" name="leave">
                    </td>
                    <td><i>0 = no access, 1 = read only, 2 = read and create, 3 = approval, 4 = special </i></td>
                </tr>
            </table>
            <button class="btn btn-primary shadow" type="submit">Simpan</button>
        </form>

    </div>
</div>
@endsection