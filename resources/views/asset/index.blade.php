@extends('layouts.app')

@section('title')
Asset List
@endsection

@section('content')
<h1 class="h3 text-gray-800">ASSET MANAGEMENT</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Asset Management</li>
    </ol>
</nav>

<div class="mb-2">
    <button type="button" class="btn mr-0 mb-0 d-inline-block">UPDATE : </button>

    <div class="btn-group shadow">
        <a href="{{ route('asset.create') }}" class="btn btn-outline-primary btn-sm"><i class='fas fa-plus'></i> New Asset</a>
        <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('task.index') }}">» Task</a>
            <a class="dropdown-item" href="{{ route('category.index') }}">» Category</a>
            <a class="dropdown-item" href="{{ route('location.index') }}">» Location</a>
        </div>
    </div>
</div>

<div class="card mb-2 shadow-sm">
    <div class="card-body">
        <table class="table nowrap table-sm" id="employee-table" style="width: 100%;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Merk</th>
                    <th>Type</th>
                    <th>Serial Number</th>
                    <th>Status</th>
                    <th>Location</th>
                    <th>Last Activity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($asset as $data)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        <a href="{{ url('/asset/detail/'.$data->token) }}" data-placement="top" title="Tampilkan">
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
                    <td>{{ $data->serialNumber }}</td>
                    <td>
                        @if (!empty($data->allocation->last()))
                        @if ($data->allocation->last()->condition == 'Good')
                        <button class="btn btn-sm btn-outline-success">{{ $data->allocation->last()->condition }}</button>
                        @else
                        <button class="btn btn-sm btn-outline-success">Broken</button>
                        @endif
                        @else
                        <button class="btn btn-sm btn-outline-success">Null</button>
                        @endif
                    </td>
                    <td>
                        @if (!empty($data->allocation->last()))
                        <a class="btn btn-sm btn-outline-secondary" href="{{ url('/location/detail/'.$data->allocation->last()->location->id) }}">{{ $data->allocation->last()->location->name }}</a>
                        @else
                        <span class="badge badge-danger">Null<span>
                                @endif
                    </td>
                    <td>
                        @if (!empty($data->maintenance->last()))
                        <a href="/task/detail/{{ $data->maintenance->last()->task_id }}">{{ $data->maintenance->last()->created_at }}</a>
                        @else
                        <button class="btn btn-sm btn-outline-danger">null</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection

@section('css')

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