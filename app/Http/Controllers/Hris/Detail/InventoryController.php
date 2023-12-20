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
use App\Models\Employeeinventory;


class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Employeeinventory::all();
        $employee = Employee::all();
        $department = Department::all();

        return view('hris.detail.inventory.index', compact('inventory', 'employee', 'department'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee'  => 'required|numeric',
            'start' => 'required',
            'description' => 'required',
            'file' => 'required'
        ]);

        if($validator->fails()) {
            alert()->error('Gagal.','pastikan mengisi data dengan benar');
            return redirect('/inventory');
        }

        $path = $request->file->store('public/inventory');
        $url = Storage::url($path);

        Employeeinventory::create([
            'employee_id' => $request->employee,
            'start' => $request->start,
            'description' => $request->description,
            'file' => $url
        ]);

        alert()->success('Berhasil.','Data berhasil dibuat');
        return redirect('/inventory');
    }
}
