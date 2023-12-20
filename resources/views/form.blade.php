@extends('layouts.app')

@section('content')
<form method="POST" action="/form/{{ $formData['token']}}">
    @csrf
    <label for="name">Nama</label>
    <input type="text" id="name" name="nama">
    <br>
    <label for="email">Email</label>
    <input type="email" id="email" name="email">
    <br>
    <label for="message">Pesan</label>
    <textarea id="message" name="pesan"></textarea>
    <br>
    <button type="submit">Kirim</button>
</form>

@endsection