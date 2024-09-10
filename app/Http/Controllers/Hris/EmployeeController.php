<?php

namespace App\Http\Controllers\Hris;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Employee;
use App\Models\User;
use App\Models\Token;
use App\Models\Employeecontract;
use App\Models\Department;
use App\Models\Attendance;
use App\Models\Employeeeducation;
use App\Models\Schedule;
use App\Models\Assetallocation;
use App\Models\Employeeleaveapproval;


class EmployeeController extends Controller
{
    public function index()
    {
        $user = User::withTrashed()->get();

        return view('hris.employee.index', compact('user'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|max:255',
            'gender' => 'required',
            'npwp'  => 'required|numeric',
            'nik'  => 'required|numeric',
            'religion'  => 'required',
            'bornplace'  => 'required',
            'borndate'  => 'required',
            'address'  => 'required',
            'phone'  => 'required|numeric',
            'status_perkawinan'  => 'required',
            'joindate'  => 'required',
            'email'  => 'required|email',
            'file' => 'required'
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal.', 'pastikan mengisi data dengan benar');
            return redirect('/employee');
        }

        Employee::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'npwp' => $request->npwp,
            'nik' => $request->nik,
            'religion' => $request->religion,
            'bornplace' => $request->bornplace,
            'borndate' => $request->borndate,
            'address' => $request->address,
            'phone' => $request->phone,
            'status_perkawinan' => $request->status_perkawinan,
            'joindate' => $request->joindate,
            'email' => $request->email,
            'photo' => $request->file
        ]);

        alert()->success('Berhasil.', 'Data berhasil dibuat');
        return redirect('/employee');
    }

    public function show($id)
    {
        if (in_array(Auth::user()->role->hris, ['3', '4'])) {

            $employee = User::findOrFail($id);

            $role = DB::table('employeecontracts')
                ->where('user_id', '=', $id)
                ->latest()
                ->first();

            $entitleEo = DB::table('employeeleaves')
                ->where('user_id', '=', $id)
                ->where('type', '=', 'extra_off')
                ->count();

            $takenEo = DB::table('employeeleaves')
                ->where('user_id', '=', $id)
                ->where('type', '=', 'extra_off')
                ->whereNotNull('pick_date')
                ->count();

            $balanceEo = $entitleEo - $takenEo;

            $entitlePh = DB::table('employeeleaves')
                ->where('user_id', '=', $id)
                ->where('type', '=', 'public_holiday')
                ->count();

            $takenPh = DB::table('employeeleaves')
                ->where('user_id', '=', $id)
                ->where('type', '=', 'public_holiday')
                ->whereNotNull('pick_date')
                ->count();

            $balancePh = $entitlePh - $takenPh;

            $entitleAl = DB::table('employeeleaves')
                ->where('user_id', '=', $id)
                ->where('type', '=', 'annual_leave')
                ->count();

            $takenAl = DB::table('employeeleaves')
                ->where('user_id', '=', $id)
                ->where('type', '=', 'annual_leave')
                ->whereNotNull('pick_date')
                ->count();

            $balanceAl = $entitleAl - $takenAl;

            $totalSick = DB::table('employeeleaves')
                ->where('user_id', '=', $id)
                ->where('type', '=', 'sick_off')
                ->count();

            $contract = Employeecontract::with('department')
                ->where('user_id', '=', $id)
                ->get();

            $education = DB::table('employeeeducations')
                ->where('user_id', '=', $id)
                ->get();

            $experience = DB::table('employeeexperiences')
                ->where('user_id', '=', $id)
                ->get();

            $family = DB::table('employeefamilies')
                ->where('user_id', '=', $id)
                ->get();

            $sickness = DB::table('employeesicknesses')
                ->where('user_id', '=', $id)
                ->get();

            $inventory =  Assetallocation::with('asset')
                ->where('employee_id', $id)
                ->get();

            return view('hris.employee.show', compact(
                'education',
                'experience',
                'family',
                'contract',
                'sickness',
                'inventory',

                'employee',
                'role',

                'entitleEo',
                'takenEo',
                'balanceEo',
                'entitlePh',
                'takenPh',
                'balancePh',
                'entitleAl',
                'takenAl',
                'balanceAl',
                'totalSick'
            ));
        } else {
            alert()->error('Stop.', 'Access Forbidden !');
            return redirect()->back();
        }
    }
    // {
    //     $loggedInUserId = Auth::id();
    //     $userRole = Auth::user()->role->hris;

    //     $user = User::find($id);

    //     if ($userRole == '1') {
    //         if ($loggedInUserId == $id) {
    //             if ($user) {
    //                 $employee = User::findOrFail($id);

    //                 $role = DB::table('employeecontracts')
    //                     ->where('user_id', '=', $id)
    //                     ->latest()
    //                     ->first();

    //                 $entitleEo = DB::table('employeeleaves')
    //                     ->where('user_id', '=', $id)
    //                     ->where('type', '=', 'extra_off')
    //                     ->count();

    //                 $takenEo = DB::table('employeeleaves')
    //                     ->where('user_id', '=', $id)
    //                     ->where('type', '=', 'extra_off')
    //                     ->whereNotNull('pick_date')
    //                     ->count();

    //                 $balanceEo = $entitleEo - $takenEo;

    //                 $entitlePh = DB::table('employeeleaves')
    //                     ->where('user_id', '=', $id)
    //                     ->where('type', '=', 'public_holiday')
    //                     ->count();

    //                 $takenPh = DB::table('employeeleaves')
    //                     ->where('user_id', '=', $id)
    //                     ->where('type', '=', 'public_holiday')
    //                     ->whereNotNull('pick_date')
    //                     ->count();

    //                 $balancePh = $entitlePh - $takenPh;

    //                 $entitleAl = DB::table('employeeleaves')
    //                     ->where('user_id', '=', $id)
    //                     ->where('type', '=', 'annual_leave')
    //                     ->count();

    //                 $takenAl = DB::table('employeeleaves')
    //                     ->where('user_id', '=', $id)
    //                     ->where('type', '=', 'annual_leave')
    //                     ->whereNotNull('pick_date')
    //                     ->count();

    //                 $balanceAl = $entitleAl - $takenAl;

    //                 $totalSick = DB::table('employeeleaves')
    //                     ->where('user_id', '=', $id)
    //                     ->where('type', '=', 'sick_off')
    //                     ->count();

    //                 $contract = Employeecontract::with('department')
    //                     ->where('user_id', '=', $id)
    //                     ->get();

    //                 $education = DB::table('employeeeducations')
    //                     ->where('user_id', '=', $id)
    //                     ->get();

    //                 $experience = DB::table('employeeexperiences')
    //                     ->where('user_id', '=', $id)
    //                     ->get();

    //                 $family = DB::table('employeefamilies')
    //                     ->where('user_id', '=', $id)
    //                     ->get();

    //                 $sickness = DB::table('employeesicknesses')
    //                     ->where('user_id', '=', $id)
    //                     ->get();

    //                 $inventory =  Assetallocation::with('asset')
    //                     ->where('employee_id', $id)
    //                     ->get();

    //                 return view('hris.employee.show', compact(
    //                     'education',
    //                     'experience',
    //                     'family',
    //                     'contract',
    //                     'sickness',
    //                     'inventory',

    //                     'employee',
    //                     'role',

    //                     'entitleEo',
    //                     'takenEo',
    //                     'balanceEo',
    //                     'entitlePh',
    //                     'takenPh',
    //                     'balancePh',
    //                     'entitleAl',
    //                     'takenAl',
    //                     'balanceAl',
    //                     'totalSick'
    //                 ));
    //             } else {
    //                 alert()->error('Stop.', 'Access Forbidden !');
    //                 return redirect()->back();
    //             }
    //         } else {
    //             alert()->error('Stop.', 'Access Forbidden !');
    //             return redirect()->back();
    //         }
    //     } elseif (in_array($userRole, ['2', '3'])) {
    //         if ($user) {
    //             $employee = User::findOrFail($id);

    //             $role = DB::table('employeecontracts')
    //                 ->where('user_id', '=', $id)
    //                 ->latest()
    //                 ->first();

    //             $entitleEo = DB::table('employeeleaves')
    //                 ->where('user_id', '=', $id)
    //                 ->where('type', '=', 'extra_off')
    //                 ->count();

    //             $takenEo = DB::table('employeeleaves')
    //                 ->where('user_id', '=', $id)
    //                 ->where('type', '=', 'extra_off')
    //                 ->whereNotNull('pick_date')
    //                 ->count();

    //             $balanceEo = $entitleEo - $takenEo;

    //             $entitlePh = DB::table('employeeleaves')
    //                 ->where('user_id', '=', $id)
    //                 ->where('type', '=', 'public_holiday')
    //                 ->count();

    //             $takenPh = DB::table('employeeleaves')
    //                 ->where('user_id', '=', $id)
    //                 ->where('type', '=', 'public_holiday')
    //                 ->whereNotNull('pick_date')
    //                 ->count();

    //             $balancePh = $entitlePh - $takenPh;

    //             $entitleAl = DB::table('employeeleaves')
    //                 ->where('user_id', '=', $id)
    //                 ->where('type', '=', 'annual_leave')
    //                 ->count();

    //             $takenAl = DB::table('employeeleaves')
    //                 ->where('user_id', '=', $id)
    //                 ->where('type', '=', 'annual_leave')
    //                 ->whereNotNull('pick_date')
    //                 ->count();

    //             $balanceAl = $entitleAl - $takenAl;

    //             $totalSick = DB::table('employeeleaves')
    //                 ->where('user_id', '=', $id)
    //                 ->where('type', '=', 'sick_off')
    //                 ->count();

    //             $contract = Employeecontract::with('department')
    //                 ->where('user_id', '=', $id)
    //                 ->get();

    //             $education = DB::table('employeeeducations')
    //                 ->where('user_id', '=', $id)
    //                 ->get();

    //             $experience = DB::table('employeeexperiences')
    //                 ->where('user_id', '=', $id)
    //                 ->get();

    //             $family = DB::table('employeefamilies')
    //                 ->where('user_id', '=', $id)
    //                 ->get();

    //             $sickness = DB::table('employeesicknesses')
    //                 ->where('user_id', '=', $id)
    //                 ->get();

    //             $inventory =  Assetallocation::with('asset')
    //                 ->where('employee_id', $id)
    //                 ->get();

    //             return view('hris.employee.show', compact(
    //                 'education',
    //                 'experience',
    //                 'family',
    //                 'contract',
    //                 'sickness',
    //                 'inventory',

    //                 'employee',
    //                 'role',

    //                 'entitleEo',
    //                 'takenEo',
    //                 'balanceEo',
    //                 'entitlePh',
    //                 'takenPh',
    //                 'balancePh',
    //                 'entitleAl',
    //                 'takenAl',
    //                 'balanceAl',
    //                 'totalSick'
    //             ));
    //         } else {
    //             alert()->error('Stop.', 'Access Forbidden !');
    //             return redirect()->back();
    //         }
    //     } else {
    //         alert()->error('Stop.', 'Access Forbidden !');
    //         return redirect()->back();
    //     }
    // }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Employee $employee)
    {
        //
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->status = 'non-active';
        $employee->save();

        alert()->success('Berhasil.', 'User berhasil dihapus');
        return redirect('/employee');
    }

    public function restore($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->status = 'active';
        $employee->save();

        alert()->success('Berhasil.', 'User berhasil dikembalikan');
        return redirect('/employee');
    }

    public function birthdays()
    {
        $birthdays = DB::table('employees')
            ->whereRaw('MONTH(birthdate) = MONTH(NOW())')
            ->get();

        return view('home', compact('birthdays'));
    }
}
