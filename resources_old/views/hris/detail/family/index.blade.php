@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Family</h1>

<div class="row">
    <div class="col-lg-4">
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">New Family</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('family.store') }}" enctype="multipart/form-data">
                    @csrf

                    <table class="table table-borderless">
                        <tr>
                            <td><label for="name">Employee</label></td>
                            <td>
                                <select class="form-control" id="employee" name="employee">
                                    <option value="" selected>-- select employee --</option>
                                    @foreach ($employee as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="name">Name</label></td>
                            <td><input type="text" name="name" id="name" class="form-control"></td>
                        </tr>

                        <tr>
                            <td><label for="status">Status</label></td>
                            <td>
                                <select class="form-control" id="status" name="status">
                                    <option value="" selected>-- select status --</option>
                                    <option value="Suami">Suami</option>
                                    <option value="Istri">Istri</option>
                                    <option value="Orang tua">Istri tua</option>
                                    <option value="Anak">Anak</option>
                                    <option value="Keluarga lain">Keluarga lain</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="phone">Phone</label></td>
                            <td><input type="number" name="phone" id="phone" class="form-control" required></td>
                        </tr>

                        <tr>
                            <td><label for="address">Address</label></td>
                            <td><input type="text" name="address" id="address" class="form-control" required></td>
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
                <h6 class="font-weight-bold text-primary">Family</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover nowrap" id="employee-table">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($family as $data)
                        @if(!empty($data->employee))
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ $data->employee->name }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->status }}</td>
                            <td>{{ $data->phone }}</td>
                            <td>{{ $data->address }}</td>
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
{{--  --}}
@endsection

@section('js')
<script>
    $("#employee").select2({
        theme: 'bootstrap'
    });

    $("#status").select2({
        theme: 'bootstrap'
    });

    $(document).ready(function () {
        $('#employee-table').DataTable({
            responsive: true
        });
    });


</script>
@endsection