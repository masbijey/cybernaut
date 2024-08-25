<?php

namespace App\Http\Controllers\Hris\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use App\Models\Employeeleave;
use App\Models\Employeeleaveapproval;
use Illuminate\Support\Facades\DB;


class LeaveController extends Controller
{
    public function index()
    {
        if (in_array(Auth::user()->role->hris, ['3', '4'])) {
            $now = Carbon::now();
            $cek_leave = Employeeleave::where('valid_until', '<', $now)
                ->update(['pick_date' => 'expired']);

            $leave = Employeeleave::all();
            $employee = User::all();
            $department = Department::all();

            return view('hris.attendance.leave.index', compact('leave', 'employee', 'department'));
        } else {
            $now = Carbon::now();
            $cek_leave = Employeeleave::where('valid_until', '<', $now)
                ->update(['pick_date' => 'expired']);

            $user_login = Auth::user();
            $leave = Employeeleave::where('user_id', $user_login->id)->get();
            $leave_data = Employeeleave::where('user_id', $user_login->id)
                ->whereNull('pick_date')
                ->get();

            $history = Employeeleaveapproval::where('user_id', $user_login->id)
                ->get();

            return view('hris.attendance.leave.employee-panel', compact('leave', 'leave_data', 'history'));
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee'  => 'required|numeric',
            'type' => 'required',
            'valid_until' => 'required',
            'description' => 'required',
            'entitled' => 'required'
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal.', 'pastikan mengisi data dengan benar');
            return redirect('/leave');
        }

        $entitled = $request->entitled;

        for ($i = 0; $i < $entitled; $i++) {
            EmployeeLeave::create([
                'user_id' => $request->employee,
                'type' => $request->type,
                'valid_until' => $request->valid_until,
                'description' => $request->description
            ]);
        }

        alert()->success('Berhasil.', 'Data berhasil dibuat');
        return redirect('/leave');
    }

    public function leaveapprovalstr(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
            'remark' => 'required',
            'leave_ids' => 'required',
            'work_date' => 'required'
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal.', 'pastikan mengisi data dengan benar');
            return redirect('/leave');
        }

        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
        $totalDays = $endDate->diffInDays($startDate) + 1;
        $totalLeaves = count($request->leave_ids);

        $user = Auth::user()->id;
        $now = Carbon::now();

        if ($totalDays === $totalLeaves) {
            Employeeleaveapproval::create([
                'user_id' => $user,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'work_date' => $request->work_date,
                'remark' => $request->remark
            ]);

            $leaves = $request->leave_ids;
            foreach ($leaves as $data) {
                DB::table('employeeleaves')
                    ->where('id', $data)
                    ->update(['pick_date' => $now]);
            }

            alert()->success('Berhasil.', 'Data berhasil dibuat');
            return redirect('/leave');
        }

        alert()->error('Gagal.', 'pastikan mengisi data dengan benar');
        return redirect('/leave');
    }
}
