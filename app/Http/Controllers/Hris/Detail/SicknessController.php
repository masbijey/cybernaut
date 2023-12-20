<?php

namespace App\Http\Controllers\Hris\Detail;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use App\Models\Employee;
use App\Models\Employeesickness;

class SicknessController extends Controller
{
    public function index()
    {
        $sickness = Employeesickness::withTrashed()->get();
        $employee = Employee::withTrashed()->get();
        
        return view('hris.detail.sickness.index', compact('sickness', 'employee'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee'  => 'required|numeric',
            'name' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()) {
            alert()->error('Gagal.','pastikan mengisi data dengan benar');
            return redirect('/sickness');
        }

        Employeesickness::create([
            'employee_id' => $request->employee,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        alert()->success('Berhasil.','Data berhasil dibuat');
        return redirect('/sickness');
    }


}
