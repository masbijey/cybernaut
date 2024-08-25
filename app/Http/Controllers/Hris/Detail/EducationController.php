<?php

namespace App\Http\Controllers\Hris\Detail;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Employee;
use App\Models\User;
use App\Models\Employeeeducation;

class EducationController extends Controller
{
    public function index()
    {
        $education = Employeeeducation::withTrashed()->get();
        $employee = User::withTrashed()->get();
        
        return view('hris.detail.education.index', compact('education', 'employee'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee'  => 'required|numeric',
            'institution' => 'required',
            'category' => 'required',
            'start' => 'required',
            'end' => 'required',
            'description' => 'required',
            'file' => 'required'
        ]);

        if($validator->fails()) {
            alert()->error('Gagal.','pastikan mengisi data dengan benar');
            return redirect('/education');
        }

        $path = $request->file->store('public/education');
        $url = Storage::url($path);

        Employeeeducation::create([
            'user_id' => $request->employee,
            'institution' => $request->institution,
            'category' => $request->category,
            'start' => $request->start,
            'end' => $request->end,
            'remark' => $request->description,
            'file' => $url
        ]);

        alert()->success('Berhasil.','Data berhasil dibuat');
        return redirect('/education');
    }

}
