<?php

namespace App\Http\Controllers\Hris\Detail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Employeecontract;


class ContractController extends Controller
{
    public function index()
    {
        $contract = Employeecontract::all();
        $employee = Employee::all();
        $department = Department::all();
        return view('hris.detail.contract.index', compact('contract', 'employee', 'department'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee'  => 'required|numeric',
            'start' => 'required',
            'end' => 'required',
            'department' => 'required',
            'jobtitle' => 'required',
            'level' => 'required',
            'description' => 'required',
            'file' => 'required'
        ]);

        if($validator->fails()) {
            alert()->error('Gagal.','pastikan mengisi data dengan benar');
            return redirect('/agreement');
        }

        $path = $request->file->store('public/contract');
        $url = Storage::url($path);

        Employeecontract::create([
            'employee_id' => $request->employee,
            'start' => $request->start,
            'end' => $request->end,
            'department_id' => $request->department,
            'jobtitle' => $request->jobtitle,
            'level' => $request->level,
            'description' => $request->description,
            'file' => $url
        ]);

        alert()->success('Berhasil.','Data berhasil dibuat');
        return redirect('/agreement');
    }
}
