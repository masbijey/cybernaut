<?php

namespace App\Http\Controllers\Hris\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Employeeleave;


class LeaveController extends Controller
{
    public function index()
    {
        $leave = Employeeleave::all();
        $employee = Employee::all();
        $department = Department::all();
        return view('hris.attendance.leave.index', compact('leave', 'employee', 'department'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee'  => 'required|numeric',
            'type' => 'required',
            'valid_until' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()) {
            alert()->error('Gagal.','pastikan mengisi data dengan benar');
            return redirect('/leave');
        }

        Employeeleave::create([
            'employee_id' => $request->employee,
            'type' => $request->type,
            'valid_until' => $request->valid_until,
            'pick_date' => $request->pick_date,
            'description' => $request->description
        ]);

        alert()->success('Berhasil.','Data berhasil dibuat');
        return redirect('/leave');
    }
}
