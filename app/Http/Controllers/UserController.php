<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Employee;
use App\Models\Userrole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()->get();

        return view('user.index', compact('users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal.','pastikan mengisi data dengan benar');
            return redirect('/user');
        }

        $newuser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Employee::create([
            'user_id' => $newuser->id,
            'name' => $request->name,
            'email' => $request->email,
        ]);

        Userrole::create([
            'user_id' => $newuser->id,
            'admin' => '0',
            'signage' => '0',
            'workorder' => '0',
            'task' => '0',
            'asset' => '0',
            'voucher' => '0',
            'beo' => '0',
            'hris' => '0',
            'attendance' => '0',
            'leave' => '0',
        ]);
        

        alert()->success('Berhasil.','User berhasil dibuat');
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

    public function edit($id)
    {
        //
    }

    public function update(Request $request, User $id)
    {

        $validator = Validator::make($request->all(), [
            'admin' => 'required|number',
            'signage' => 'required|number',
            'workorder' => 'required|number',
            'task' => 'required|number',
            'asset' => 'required|number',
            'voucher' => 'required|number',
            'beo' => 'required|number',
            'hris' => 'required|number',
            'attendance' => 'required|number',
            'leave' => 'required|number',
        ]);

        $data = Userrole::where('user_id', $id->id);

        $data->update([
            'admin' => $request->admin,
            'signage' => $request->signage,
            'workorder' => $request->workorder,
            'task' => $request->task,
            'asset' => $request->asset,
            'voucher' => $request->voucher,
            'beo' => $request->beo,
            'hris' => $request->hris,
            'attendance' => $request->attendance,
            'leave' => $request->leave,
        ]);

        alert()->success('Berhasil.','User berhasil di perbarui');
        return redirect ('/user/show/'.$id->id);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        alert()->success('Berhasil.','User berhasil dihapus');
        return redirect ('/user');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        $user->restore();

        alert()->success('Berhasil.','User berhasil diaktifkan kembali');
        return redirect ('/user');
    }
}
