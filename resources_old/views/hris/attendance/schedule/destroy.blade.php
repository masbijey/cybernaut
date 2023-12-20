@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Tambah Jadwal Kerja</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('schedule.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="employee_id">Nama Karyawan</label>
                                <select name="employee_id" id="employee_id" class="form-control">
                                    <option value="">Pilih Nama Karyawan</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="day">Hari</label>
                                <select name="day" id="day" class="form-control">
                                    <option value="">Pilih Hari</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="start_time">Jam Masuk</label>
                                <input type="time" name="start_time" id="start_time" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="end_time">Jam Keluar</label>
                                <input type="time" name="end_time" id="end_time" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
