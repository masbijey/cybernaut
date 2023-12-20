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
use App\Models\Employeefamily;

class FamilyController extends Controller
{
    public function index()
    {
        $family = Employeefamily::withTrashed()->get();
        $employee = Employee::withTrashed()->get();
        
        return view('hris.detail.family.index', compact('family', 'employee'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee'  => 'required|numeric',
            'name' => 'required',
            'status' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        if($validator->fails()) {
            alert()->error('Gagal.','pastikan mengisi data dengan benar');
            return redirect('/family');
        }

        Employeefamily::create([
            'employee_id' => $request->employee,
            'name' => $request->name,
            'status' => $request->status,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        alert()->success('Berhasil.','Data berhasil dibuat');
        return redirect('/family');
    }


}
