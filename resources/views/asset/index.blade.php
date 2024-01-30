@extends('layouts.app')

@section('content')
<h1 class="h3 text-gray-800">Asset Management</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Asset Management</li>
    </ol>
</nav>

<div class="mt-3">
    <button type="button" class="btn mr-0 mb-0 d-inline-block">UPDATE : </button>

    <div class="btn-group shadow">
        <a href="{{ route('asset.create') }}" class="btn btn-primary btn-sm"><i class='fas fa-plus'></i> New Asset</a>
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
    <div class="card-header bg-gradient-primary text-light">
        <h5 class="m-0 font-weight-bold">Asset List</h5>
    </div>
    <div class="card-body">
        <table class="table nowrap" id="employee-table" style="width: 100%;">
            <thead class="thead-light">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Merk</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Location</th>
                    <th>Last Activity</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                @foreach($asset as $data)
                <tr>
                    <td>
                        asset number
                    </td>
                    <td>
                        <a href="/asset/detail/{{ $data->token }}" data-placement="top" title="Tampilkan">
                            {{ $data->name }}</a>
                    </td>
                    <td>
                        {{ $data->category->name }}
                    </td>
                    <td>
                        {{ $data->merk }}
                    </td>
                    <td>
                        {{ $data->type }}
                    </td>
                    <td>
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
                    <td>
                        @if (!empty($data->allocation->last()))
                        <a href="/location/detail/{{ $data->allocation->last()->location->id }}">{{ $data->allocation->last()->location->name }}</a>
                        @else
                        <span class="badge badge-danger">null<span>
                                @endif
                    </td>
                    <td>
                        @if (!empty($data->maintenance->last()))
                        <a href="/task/detail/{{ $data->maintenance->last()->task_id }}">{{ $data->maintenance->last()->created_at }}</a>
                        @else
                        <span class="badge badge-danger">null<span>
                                @endif
                    </td>
                    <td>
                        <a href="{{ $data->file }}"><img class="img-thumbnail" src="{{ $data->file }}" alt="Thumbnail image" width="150"></a>
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
    $(document).ready(function() {
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