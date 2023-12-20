@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Asset Management</h1>

<div class="mt-3">
    <button type="button" class="btn mr-0 mb-0 d-inline-block">UPDATE : </button>

    <div class="btn-group shadow">
        <a href="{{ route('asset.create') }}" class="btn btn-primary btn-sm"><i class='fas fa-plus'></i> New Asset</a>
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('task.index') }}">» Task</a>
            <a class="dropdown-item" href="{{ route('checklist.index') }}">» Checklist</a>
            <a class="dropdown-item" href="{{ route('allocation.index') }}">» Allocation</a>
        </div>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Asset List</h6>
    </div>
    <div class="card-body">
        <table class="table table-hover table-sm table-striped table-bordered" id="employee-table">
            <thead class="thead-light text-center">
                <tr class="text-center">
                    <th>#</th>
                    <th>Name</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Merk</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Location</th>
                    <th class="text-center">Last Check</th>
                    <th class="text-center">Last Maintenance</th>
                    <th class="text-center">File</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($asset as $data)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        <a href="/asset/detail/{{ $data->token }}" class="" data-placement="top" title="Tampilkan">
                            {{ $data->name }}</a>
                    </td>
                    <td class="text-center">
                        {{ $data->category->name }}
                    </td>
                    <td class="text-center">
                        {{ $data->merk }}
                    </td>
                    <td class="text-center">
                        {{ $data->type }}
                    </td>
                    <td class="text-center">
                        @if (!empty($data->allocation->last()))
                            @if ($data->allocation->last()->condition == 'Good')
                            <span class="badge badge-success">{{ $data->allocation->last()->condition }}</span>
                            @else
                            <span class="badge badge-danger">Broken</span>
                            @endif
                        @else
                            <span class="badge badge-danger">null<span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if (!empty($data->allocation->last()))
                            <a href="/location/detail/{{ $data->allocation->last()->location->id }}">{{ $data->allocation->last()->location->name }}</a>
                        @else
                            <span class="badge badge-danger">null<span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if (!empty($data->maintenance->last()))
                        <a href="/maintenance/detail/{{ $data->maintenance->last()->id }}">{{ $data->maintenance->last()->maintenance_date }}</a>
                        @else
                            <span class="badge badge-danger">null<span>
                        @endif                    
                    </td>
                    <td class="text-center">
                        @if (!empty($data->maintenance->last()))
                        <a href="/maintenance/detail/{{ $data->maintenance->last()->id }}">{{ $data->maintenance->last()->maintenance_date }}</a>
                        @else
                            <span class="badge badge-danger">null<span>
                        @endif                    
                    </td>
                    <td class="text-center">
                        <a href="{{ $data->file }}" class="btn btn-sm btn-primary">file</a>
                    </td>
                    <td class="text-center">
                        <a href="/asset/detail/{{ $data->token }}" class="btn btn-sm btn-primary text-center"
                            data-placement="top" title="Show"><i class='fas fa-eye'></i></a>
                        <a href="#" class="btn btn-sm btn-danger text-center" data-placement="top" title="Edit"><i
                                class='fas fa-edit'></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection

@section('css')
{{-- --}}
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#employee-table').DataTable({
            responsive: true
        }); 
    });

    $("#employee").select2({
        theme: 'bootstrap'
    });

    $("#category").select2({
        theme: 'bootstrap'
    });

    $("#location").select2({
        theme: 'bootstrap'
    });




</script>
@endsection