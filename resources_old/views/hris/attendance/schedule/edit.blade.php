@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Edit Jadwal Kerja</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('schedule.update', $schedule->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="employee_id">Karyawan</label>
                                <select name="employee_id" id="employee_id" class="form-control" required>
                                    <option value="">Pilih Karyawan</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" @if($schedule->employee_id == $employee->id) selected @endif>{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="day">Hari</label>
                                <select name="day" id="day" class="form-control" required>
                                    <option value="">Pilih Hari</option>
                                    <option value="Senin" @if($schedule->day == 'Senin') selected @endif>Senin</option>
                                    <option value="Selasa" @if($schedule->day == 'Selasa') selected @endif>Selasa</option>
                                    <option value="Rabu" @if($schedule->day == 'Rabu') selected @endif>Rabu</option>
                                    <option value="Kamis" @if($schedule->day == 'Kamis') selected @endif>Kamis</option>
                                    <option value="Jumat" @if($schedule->day == 'Jumat') selected @endif>Jumat</option>
                                    <option value="Sabtu" @if($schedule->day == 'Sabtu') selected @endif>Sabtu</option>
                                    <option value="Minggu" @if($schedule->day == 'Minggu') selected @endif>Minggu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start_time">Jam Masuk</label>
                                <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $schedule->start_time }}" required>
                            </div>
                            <div class="form-group">
                                <label for="end_time">Jam Keluar</label>
                                <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $schedule->end_time }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('schedule.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
