@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
<p class="mb-4">KAI - ZEN = Menjadi lebih baik setiap hari.</p>

<div class="row">
    <div class="col-lg-3">
        <div class="card shadow m-1">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Birthdays</h6>
            </div>
        
            <div class="card-body">
                @foreach ($birthdays as $birthday)
                    <p class="text-primary">{{ $birthday->name }} <span class="badge badge-info">{{ $birthday->borndate }}</span> </p>
                @endforeach
            </div>
        </div>
    </div>
    
    <div class="col-lg-3">
        <div class="card shadow m-1">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Late attendance</h6>
            </div>
        
            <div class="card-body">
                @foreach ($birthdays as $birthday)
                    <p class="text-primary">{{ $birthday->name }} <span class="badge badge-info">{{ $birthday->borndate }}</span> </p>
                @endforeach
            </div>
        </div> 
    </div>   

    <div class="col-lg-3">
        <div class="card shadow m-1">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Canteen</h6>
            </div>
        
            <div class="card-body">
                @foreach ($birthdays as $birthday)
                    <p class="text-primary">{{ $birthday->name }} <span class="badge badge-info">{{ $birthday->borndate }}</span> </p>
                @endforeach
            </div>
        </div>    
    </div>

    <div class="col-lg-3">
        <div class="card shadow m-1">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">On leave</h6>
            </div>
        
            <div class="card-body">
                @foreach ($birthdays as $birthday)
                    <p class="text-primary">{{ $birthday->name }} <span class="badge badge-info">{{ $birthday->borndate }}</span> </p>
                @endforeach
            </div>
        </div> 
    </div>   

    <div class="col-lg-3">
        <div class="card shadow m-1">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Renewal Contracts</h6>
            </div>
        
            <div class="card-body">
                @foreach ($birthdays as $birthday)
                    <p class="text-primary">{{ $birthday->name }} <span class="badge badge-info">{{ $birthday->borndate }}</span> </p>
                @endforeach
            </div>
        </div>    
    
    </div>
</div>
@endsection