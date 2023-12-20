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
use App\Models\Employeerewpun;


class RewpunController extends Controller
{
    public function index()
    {
        $rewpun = Employeerewpun::all();
        $employee = Employee::all();
        $department = Department::all();

        return view('hris.detail.rewpun.index', compact('rewpun', 'employee', 'department'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee'  => 'required|numeric',
            'start' => 'required',
            'end' => 'required',
            'description' => 'required',
            'type' => 'required',
            'file' => 'required'
        ]);

        if($validator->fails()) {
            alert()->error('Gagal.','pastikan mengisi data dengan benar');
            return redirect('/rewpun');
        }

        $path = $request->file->store('public/rewpun');
        $url = Storage::url($path);

        Employeerewpun::create([
            'employee_id' => $request->employee,
            'start' => $request->start,
            'type' => $request->type,
            'description' => $request->description,
            'end' => $request->end,
            'file' => $url
        ]);

        alert()->success('Berhasil.','Data berhasil dibuat');
        return redirect('/rewpun');
    }
}
