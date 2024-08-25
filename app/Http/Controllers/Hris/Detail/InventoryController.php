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
use App\Models\Location;
use App\Models\Employee;
use App\Models\User;
use App\Models\Asset;
use App\Models\Employeeinventory;
use App\Models\Assetallocation;


class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Employeeinventory::all();
        $employee = User::all();
        $department = Department::all();
        $asset = Asset::all();
        $location = Location::all();

        return view('hris.detail.inventory.index', compact('inventory', 'employee', 'department', 'asset', 'location'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee'  => 'required|numeric',
            'start' => 'required',
            'description' => 'required',
            'file' => 'required',
            'asset' => 'required',

            'location' => 'required',
            'department' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal.', 'pastikan mengisi data dengan benar');
            return redirect('/inventory');
        }

        $path = $request->file->store('public/inventory');
        $url = Storage::url($path);

        $updateBy = Auth::user()->id;
        Assetallocation::create([
            'asset_id' => $request->asset,
            'employee_id' => $request->employee,
            'location_id' => $request->location,
            'department_id' => $request->department,
            'file' => $url,
            'condition' => 'Good',
            'remark' => $request->remark,
            'created_by' => $updateBy
        ]);

        Employeeinventory::create([
            'user_id' => $request->employee,
            'start' => $request->start,
            'description' => $request->description,
            'file' => $url,
            'asset_id' => $request->asset
        ]);

        alert()->success('Berhasil.', 'Data berhasil dibuat');
        return redirect('/inventory');
    }
}
