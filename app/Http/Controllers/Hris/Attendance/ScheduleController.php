<?php

namespace App\Http\Controllers\Hris\Attendance;

use App\Models\Schedule;
use App\Models\Shift;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('employee')->get();

        return view('schedule.index', compact('schedules'));
    }

    public function create()
    {
        $shifts = Shift::all();
        return view('schedule.create', compact('shifts'));
    }

    public function store(Request $request)
    {
        $schedule = new Schedule;
        $schedule->employee_id = $request->employee_id;
        $schedule->date = $request->date;
        $schedule->shift_id = $request->shift_id;
        $schedule->save();
        return redirect()->route('schedule.index')->with('success', 'Jadwal berhasil dibuat');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $employees = Employee::all();

        return view('schedule.edit', compact('schedule', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->update([
            'employee_id' => $request->employee_id,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('schedule.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->delete();

        return redirect()->route('schedule.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}
