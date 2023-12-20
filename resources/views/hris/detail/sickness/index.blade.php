@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Congenital disease</h1>

<div class="row">
    <div class="col-lg-4">
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">New Sickness</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('sickness.store') }}" enctype="multipart/form-data">
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
                            <td><label for="description">Description</label></td>
                            <td>
                                <textarea name="description" id="description" rows="5" class="form-control" placeholder="please describe about your sickness and let me know whether it has healed or not. "></textarea>
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
                <h6 class="font-weight-bold text-primary">Congenital disease</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover table-responsive-lg nowrap" id="pegawai-table">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Name</th>
                            <th>Sickness</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($sickness as $data)
                        @if(!empty($data->employee))
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ $data->employee->name }}</td>
                            <td>{{ $data->name }}</td>
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

</script>
@endsection