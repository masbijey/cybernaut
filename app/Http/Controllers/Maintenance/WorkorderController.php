<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;

use App\Models\Workorder;
use App\Models\Task;
use App\Models\Taskmember;
use App\Models\Tasktag;
use App\Models\Department;
use App\Models\Location;
use App\Models\Employee;
use App\Models\Assetallocation;
use App\Models\Asset;
use App\Models\File;

use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class WorkorderController extends Controller
{
    public function index()
    {
        $workorder = Workorder::all();

        return view('maintenance.workorder.index', compact('workorder'));
    }

    public function create()
    {
        $employee = Employee::all();
        $asset = Asset::all();
        $location = Location::all();
        $department = Department::all();
        
        return view('maintenance.workorder.create', compact('employee', 'asset', 'location', 'department'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'department_ids' => 'required',
        'asset_ids' => 'nullable',
        'location_ids' => 'nullable',
        'due_date' => 'nullable',
        'priority' => 'required',
        'title' => 'required',
        'description' => 'required',
        'file' => 'required'
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal.', 'pastikan mengisi data dengan benar');
            return redirect('/workorder/create')
                ->withErrors($validator)
                ->withInput();
        }

        $update_by = Auth::user()->id;
        $workorder = Workorder::create([
            'user_id' => $update_by,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'title' => $request->title,
            'description' => $request->description,
        ]);


    }

    public function show($id)
    {
        $workorder = Workorder::findOrFail($id);
        
        return view('workorder.detail', compact('workorder'));
    }

    public function edit(Workorder $workorder)
    {
        //
    }

    public function update(Request $request, Workorder $workorder)
    {
        //
    }

    public function destroy(Workorder $workorder)
    {
        //
    }
}
