@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">LOCATION</h1>

<div class="col-6 mt-3">
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal3">
        <i class='fas fa-plus'></i> New Location
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal3Label">New Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('asset.location.store') }}">
                    @csrf

                    <table class="table">
                        <td><label for="name">Location name</label></td>
                        <td><input type="text" name="name" id="name" class="form-control"></td>
                    </table>

                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                    <button class="btn btn-secondary btn-sm" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-6">
    <div class="card mt-3">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Location List</h6>
        </div>
        <div class="card-body">
            <table class="table table-hover table-responsive-lg nowrap" id="pegawai-table">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($location as $data)
                    <tr>
                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td>{{ $data->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection