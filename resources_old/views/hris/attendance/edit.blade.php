@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Edit Absensi</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="employee_id">Nama Karyawan</label>
                                <select name="employee_id" id="employee_id" class="form-control">
                                    <option value="">Pilih Nama Karyawan</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $attendance->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="date">Tanggal</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ $attendance->date }}">
                            </div>

                            <div class="form-group">
                                <label for="start_time">Jam Masuk</label>
                                <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $attendance->start_time }}">
                            </div>

                            <div class="form-group">
                                <label for="end_time">Jam Keluar</label>
                                <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $attendance->end_time }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
