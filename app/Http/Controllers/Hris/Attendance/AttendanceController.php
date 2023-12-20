<?php

namespace App\Http\Controllers\Hris\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function attendance()
    {
        $employees = Employee::all();

        return view('attendance.index', compact('employees'));
    }

    public function attendancestr(Request $request)
    {
        $employee = Employee::find($request->employee_id);
        $schedule = Schedule::where('employee_id', $employee->id)
            ->where('day', Carbon::now()->format('l'))
            ->first();

        $attendance = Attendance::create([
            'employee_id' => $employee->id,
            'attendance_date' => Carbon::now()->format('Y-m-d'),
            'check_in' => Carbon::now()
        ]);

        $late = false;

        if ($schedule) {
            $start_time = Carbon::parse($schedule->start_time);
            $check_in = Carbon::parse($attendance->check_in);

            if ($check_in->gt($start_time)) {
                $late = true;
            }
        }

        return view('attendance.store', compact('employee', 'attendance', 'late'));
    }

}
