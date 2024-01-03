@extends('layouts.app')

@section('title')
S C L B L E | Signage Management
@endsection

@section('content')
<h1 class="h3 mb-2 text-gray-800">Signage</h1>
<p>Berikut adalah tools untuk mengganti tulisan di TV signage meeting room.</p>

<div class="col-sm-12 col-md-12 col-lg-6">
    <div class="card shadow">
        <div class="card-header">
            <h6 class="font-weight-bold text-primary">Signage Meeting Room</h6>
        </div>

        <div class="card-body">
            <form class="" action="{{ route('signage-store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label for="event_name">Nama Event :</label>
                    <div class="col-md-6">
                        <input id="event_name" type="text" class="form-control" name="event_name" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="event_name">Meeting Room :</label>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="meeting_room" id="exampleRadios1" value="pu" required>
                            <label class="form-check-label" for="exampleRadios1">
                                Power Up
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="meeting_room" id="exampleRadios2" value="gu" required>
                            <label class="form-check-label" for="exampleRadios2">
                                Gear Up
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="meeting_room" id="exampleRadios3" value="lu" required>
                            <label class="form-check-label" for="exampleRadios3">
                                Light Up
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="meeting_room" id="exampleRadios4" value="wnt" required>
                            <label class="form-check-label" for="exampleRadios4">
                                Wok N Tok
                            </label>
                        </div>
                    </div>
                </div>

                <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                <a href="{{ url('signage') }}" class="btn btn-sm btn-secondary">Batal</a>

            </form>
            <table class="table table-hover mt-3 table-striped table-bordered" id="pegawai-table" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 13%;">Created</th>
                        <th style="width: 10%;">Room</th>
                        <th style="width: 30%;">Event</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $a)
                    <tr>
                        <td>{{ $a->created_at }}</td>
                        <td><a href="/signage/{{ $a->meeting_room }}">{{ $a->meeting_room }}</a></td>
                        <td>{{ $a->event_name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection