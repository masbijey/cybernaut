@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Family</h1>

<div class="row">
    <div class="col-lg-4">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    New Family
                </h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('family.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Employee</label>
                        <select class="form-control" id="employee" name="employee">
                            <option value="" selected>-- select employee --</option>
                            @foreach ($employee as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="custom-select" id="status" name="status">
                            <option value="" selected>Select a Status:</option>
                            <option value="Suami">Suami</option>
                            <option value="Istri">Istri</option>
                            <option value="Orang tua">Orang tua</option>
                            <option value="Anak">Anak</option>
                            <option value="Keluarga lain">Keluarga lain</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" name="phone" id="phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Family
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="employee-table">
                    <thead>
                        <th>#</th>
                        <th>Employee</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Phone</th>
                        <th>Address</th>
                    </thead>
                    <tbody>
                        @foreach($family as $family)
                        @if(!empty($data->employee))
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ url('employee/detail/'. $family->user_id) }}">{{ $family->user->name }}</a></td>
                            <td>{{ $family->name }}</td>
                            <td>{{ $family->relationship }}</td>
                            <td>{{ $family->phone }}</td>
                            <td>{{ $family->address }}</td>
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

    $("#status").select2({
        theme: 'bootstrap'
    });

    $(document).ready(function() {
        $('#employee-table').DataTable({
            responsive: true
        });
    });
</script>
@endsection