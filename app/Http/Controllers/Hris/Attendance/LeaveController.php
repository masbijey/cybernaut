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

        $employee = User::all();

        $al = Employeeleave::where('user_id', $user_login->id)
            ->where('type', 'annual_leave')
            ->where('pick_date', null)
            ->count();

        $eo = Employeeleave::where('user_id', $user_login->id)
            ->where('type', 'extra_off')
            ->where('pick_date', null)
            ->count();

        $dp = Employeeleave::where('user_id', $user_login->id)
            ->where('type', 'public_holiday')
            ->where('pick_date', null)
            ->count();

        // dd($al);

        return view('hris.attendance.leave.employee-panel', compact(
            'employee',
            'leave',
            'leave_data',
            'history',
            'al',
            'eo',
            'dp'
        ));
    }

    public function leavedata()
    {
        if (in_array(Auth::user()->role->hris, ['3', '4', '5'])) {
            $now = Carbon::now();
            $cek_leave = Employeeleave::where('valid_until', '<', $now)
                ->update(['pick_date' => 'expired']);

            $leave = Employeeleave::all();
            $employee = User::all();
            $department = Department::all();

            return view('hris.attendance.leave.index', compact('leave', 'employee', 'department'));
        } else {
            alert()->error('Stop!', 'Access Denied');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if (in_array(Auth::user()->role->hris, ['4', '5'])) {

            $validator = Validator::make($request->all(), [
                'employee'  => 'required|numeric',
                'type' => 'required',
                'valid_until' => 'required',
                'description' => 'required',
                'entitled' => 'required'
            ]);

            if ($validator->fails()) {
                alert()->error('Gagal.', 'pastikan mengisi data dengan benar');
                return redirect('/hris/leave');
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
            return redirect('/hris/leave/');
        } else {
            alert()->error('Stop!', 'Access Denied');
            return redirect()->back();
        }
    }

    public function leaveapproval()
    {
        $data = Employeeleaveapproval::orderBy('created_at', 'desc')->get();

        return view('hris.attendance.leave.approval', compact('data'));
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
            return redirect('/hris/leave');
        }

        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
        $totalDays = $endDate->diffInDays($startDate) + 1;
        $totalLeaves = count($request->leave_ids);

        $user = Auth::user()->id;
        $now = Carbon::now();

        if ($totalDays === $totalLeaves) {
            $approval = Employeeleaveapproval::create([
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
                    ->update([
                        'pick_date' => $now,
                        'leaveapproval_id' => $approval->id
                    ]);
            }
            alert()->success('Berhasil.', 'Data berhasil dibuat');
            return redirect('/hris/leave/');
        }
        alert()->error('Try Again.', 'Pastikan mengisi data dengan benar');
        return redirect('/hris/leave/');
    }

    public function leaveapprovaldetail($id)
    {
        $data = Employeeleaveapproval::findOrFail($id);
        $leaves = Employeeleave::where('leaveapproval_id', $id)
            ->get();

        return view('hris.attendance.leave.approval_detail', compact('data', 'leaves'));
    }

    public function signaleaveapprovalstr(Request $request, $id)
    {
        if (in_array(Auth::user()->role->hris, ['3', '4', '5'])) {
            $form = Employeeleaveapproval::findOrFail($id);
            $now = now();
            $user = Auth::user()->id;

            if (isset($request->leader1_status)) {
                if ($request->leader1_status === '1') {
                    $form->approved_1_by = $user;
                    $form->approved_1_at = $now;
                    $form->approved_1_status = 'approved';
                    $form->save();
                } else {
                    $form->approved_1_by = $user;
                    $form->approved_1_at = $now;
                    $form->approved_1_status = 'rejected';
                    $form->save();
                }
            }

            if (isset($request->leader2_status)) {
                if ($request->leader2_status === '1') {
                    $form->approved_2_by = $user;
                    $form->approved_2_at = $now;
                    $form->approved_2_status = 'approved';
                    $form->save();
                } else {
                    $form->approved_2_by = $user;
                    $form->approved_2_at = $now;
                    $form->approved_2_status = 'rejected';
                    $form->save();
                }
            }

            if (isset($request->leader3_status)) {
                if ($request->leader3_status === '1') {
                    $form->approved_3_by = $user;
                    $form->approved_3_at = $now;
                    $form->approved_3_status = 'approved';
                    $form->save();
                } else {
                    $form->approved_3_by = $user;
                    $form->approved_3_at = $now;
                    $form->approved_3_status = 'rejected';
                    $form->save();

                    $leaves = Employeeleave::where('leaveapproval_id', $id)->get();
                    foreach ($leaves as $leave) {
                        $leave->leaveapproval_id = null;
                        $leave->pick_date = null;
                        $leave->save();
                    }
                }
            }

            alert()->success('Success.');
            return redirect()->back();
        } else {
            alert()->error('Access Denied.');
            return redirect()->back();
        }
    }

    public function leaveform()
    {

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

        $employee = User::all();

        $al = Employeeleave::where('user_id', $user_login->id)
            ->where('type', 'annual_leave')
            ->where('pick_date', null)
            ->count();

        $eo = Employeeleave::where('user_id', $user_login->id)
            ->where('type', 'extra_off')
            ->where('pick_date', null)
            ->count();

        $dp = Employeeleave::where('user_id', $user_login->id)
            ->where('type', 'day_payment')
            ->where('pick_date', null)
            ->count();

        // dd($al);

        return view('hris.attendance.leave.form_leave', compact(
            'employee',
            'leave',
            'leave_data',
            'history',
            'al',
            'eo',
            'dp'
        ));
    }

}
