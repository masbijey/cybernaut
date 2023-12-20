<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class DepartmentController extends Controller
{
    public function index()
    {
        $department = Department::withTrashed()->get();

        return view('department.index', compact('department'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal.','pastikan mengisi data dengan benar');
            return redirect('/department');
        }

        Department::create([
            'name' => $request->name
        ]);

        alert()->success('Berhasil.', 'Department baru berhasil di tambahkan.');
        return redirect('/department');
    }
}
