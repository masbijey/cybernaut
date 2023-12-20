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
use App\Models\Employeeexperience;

class ExperienceController extends Controller
{
    public function index()
    {
        $experience = Employeeexperience::withTrashed()->get();
        $employee = Employee::withTrashed()->get();
        
        return view('hris.detail.experience.index', compact('experience', 'employee'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee'  => 'required|numeric',
            'start' => 'required',
            'end' => 'required',
            'company' => 'required',
            'jobtitle' => 'required',
            'description' => 'required',
            'file' => 'required'
        ]);

        if($validator->fails()) {
            alert()->error('Gagal.','pastikan mengisi data dengan benar');
            return redirect('/agreement');
        }

        $path = $request->file->store('public/experience');
        $url = Storage::url($path);

        Employeeexperience::create([
            'employee_id' => $request->employee,
            'start' => $request->start,
            'end' => $request->end,
            'company' => $request->company,
            'jobtitle' => $request->jobtitle,
            'description' => $request->description,
            'file' => $url
        ]);

        alert()->success('Berhasil.','Data berhasil dibuat');
        return redirect('/experience');
    }


}
