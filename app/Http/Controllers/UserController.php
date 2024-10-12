<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Userrole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Employee;
use App\Models\Employeecontract;
use App\Models\Employeeeducation;
use App\Models\Employeeleaveapproval;
use App\Models\Assetallocation;


class UserController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()->get();

        return view('user.index', compact('users'));
    }

    public function profile()
    {
        $user = Auth::user()->id;

        $employee = User::findOrFail($user);

        $role = DB::table('employeecontracts')
            ->where('user_id', '=', $user)
            ->latest()
            ->first();

        $entitleEo = DB::table('employeeleaves')
            ->where('user_id', '=', $user)
            ->where('type', '=', 'extra_off')
            ->count();

        $takenEo = DB::table('employeeleaves')
            ->where('user_id', '=', $user)
            ->where('type', '=', 'extra_off')
            ->whereNotNull('pick_date')
            ->count();

        $balanceEo = $entitleEo - $takenEo;

        $entitlePh = DB::table('employeeleaves')
            ->where('user_id', '=', $user)
            ->where('type', '=', 'public_holiday')
            ->count();

        $takenPh = DB::table('employeeleaves')
            ->where('user_id', '=', $user)
            ->where('type', '=', 'public_holiday')
            ->whereNotNull('pick_date')
            ->count();

        $balancePh = $entitlePh - $takenPh;

        $entitleAl = DB::table('employeeleaves')
            ->where('user_id', '=', $user)
            ->where('type', '=', 'annual_leave')
            ->count();

        $takenAl = DB::table('employeeleaves')
            ->where('user_id', '=', $user)
            ->where('type', '=', 'annual_leave')
            ->whereNotNull('pick_date')
            ->count();

        $balanceAl = $entitleAl - $takenAl;

        $totalSick = DB::table('employeeleaves')
            ->where('user_id', '=', $user)
            ->where('type', '=', 'sick_off')
            ->count();

        $contract = Employeecontract::with('department')
            ->where('user_id', '=', $user)
            ->get();

        $education = DB::table('employeeeducations')
            ->where('user_id', '=', $user)
            ->get();

        $experience = DB::table('employeeexperiences')
            ->where('user_id', '=', $user)
            ->get();

        $family = DB::table('employeefamilies')
            ->where('user_id', '=', $user)
            ->get();

        $sickness = DB::table('employeesicknesses')
            ->where('user_id', '=', $user)
            ->get();

        $inventory =  Assetallocation::with('asset')
            ->where('employee_id', $user)
            ->get();

        return view('user.profile', compact(
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
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6',
            'joindate' => 'required'
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal.', 'pastikan mengisi data dengan benar');
            return redirect('/user');
        }

        $newuser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'joinDate' => $request->joindate
        ]);

        Employee::create([
            'user_id' => $newuser->id,
        ]);

        Userrole::create([
            'user_id' => $newuser->id,
            'admin' => '0',
            'asset' => '0',
            'hris' => '0',
            'maintenance' => '0',
            'business' => '0',
            'room' => '0'
        ]);

        alert()->success('Berhasil.', 'User berhasil dibuat');
        return redirect('/user');
    }

    public function show($id)
    {
        if (in_array(Auth::user()->role->admin, ['3', '4'])) {
            $data = User::findOrFail($id);
            return view('user.show', compact('data', 'id'));
        } else {
            alert()->error('Stop.', 'Access Forbidden !');
            return redirect('user');
        }
    }

    public function update(Request $request, User $id)
    {

        $validator = Validator::make($request->all(), [
            'admin' => 'required|number',
            'asset' => 'required|number',
            'hris' => 'required|number',
            'room' => 'required|number',
            'business' => 'required|number',
            'maintenance' => 'required|number'
        ]);

        $data = Userrole::where('user_id', $id->id);

        $data->update([
            'admin' => $request->admin,
            'asset' => $request->asset,
            'hris' => $request->hris,
            'maintenance' => $request->maintenance,
            'room' => $request->room,
            'business' => $request->business,
        ]);

        alert()->success('Berhasil.', 'User berhasil di perbarui');
        return redirect('/user/show/' . $id->id);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        alert()->success('Berhasil.', 'User berhasil dihapus');
        return redirect('/user');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        $user->restore();

        alert()->success('Berhasil.', 'User berhasil diaktifkan kembali');
        return redirect('/user');
    }
}
