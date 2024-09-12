@extends('layouts.app')

@section('title')
Asset Category Management
@endsection

@section('content')
<h1 class="h3 text-gray-800">ASSET CATEGORY MANAGEMENT</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Asset Category Management</li>
    </ol>
</nav>

<div class="row mt-2">
    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="card mb-2 shadow-sm">
            <div class="card-header text-primary py-3">
                <h6 class="m-0 font-weight-bold text-primary">New Asset Category</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('category.store') }}">
                    @csrf

                    <table class="table table-borderless">
                        <td><label for="name">Category Name</label></td>
                        <td><input type="text" name="name" id="name" class="form-control" required></td>
                    </table>

                    <button class="btn btn-primary shadow-sm" type="submit">Save</button>
                    <button class="btn btn-secondary shadow-sm" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 col-lg-5">
        <div class="card mb-2 shadow-sm">
            <div class="card-header text-primary py-3">
                <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="location-table">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Category Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assetcat as $data)
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
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#location-table').DataTable({
            responsive: true
        });
    });
</script>
@endsection