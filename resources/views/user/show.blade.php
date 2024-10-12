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
                                    <td><label for="">System Administration</label></td>
                                    <td class="text-center">
                                        <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->admin }}" name="admin">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="">Maintenance</label></td>
                                    <td class="text-center">
                                        <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->maintenance }}" name="maintenance">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="">Room</label></td>
                                    <td class="text-center">
                                        <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->room }}" name="room">
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
                                    <td><label for="">Business</label></td>
                                    <td class="text-center">
                                        <input type="number" min="0" max="4" maxlength="1" required class="form-control bg-warning text-dark font-weight-bold text-center" value="{{ $data->role->business }}" name="business">
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