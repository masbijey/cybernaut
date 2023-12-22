<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;

use App\Models\Workorder;
use App\Models\Workordermember;
use App\Models\Workordertag;
use App\Models\Department;
use App\Models\Location;
use App\Models\Employee;
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

        $user_id = Auth::user()->id;
        $status = "Open";
        $workorder = Workorder::create([
            'user_id' => $user_id,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $status
        ]);

        $path = $request->file->store('public/workorder');
        $url = Storage::url($path);

        File::create([
            'workorder_id' => $workorder->id,
            'file' => $url,
            'remark' => $request->file_remark,
        ]);

        // $members = $request->member_ids;
        // foreach ($members as $member) {
        //     Workordermember::create([
        //         'workorder_id' => $workorder->id,
        //         'employee_id' => $member
        //     ]);
        // }

        if (isset($request->asset_ids)) {
            $assets = $request->asset_ids;
            foreach ($assets as $asset) {
                Workordertag::create([
                    'workorder_id' => $workorder->id,
                    'asset_id' => $asset,
                ]);
            }
        }

        if (isset($request->location_ids)) {
            $locations = $request->location_ids;
            foreach ($locations as $location) {
                Workordertag::create([
                    'workorder_id' => $workorder->id,
                    'location_id' => $location,
                ]);
            }
        }

        if (isset($request->department_ids)) {
            $departments = $request->department_ids;
            foreach ($departments as $department) {
                Workordertag::create([
                    'workorder_id' => $workorder->id,
                    'department_id' => $department,
                ]);
            }
        }

        alert()->success('Berhasil.', 'Data berhasil ditambahkan');
        return redirect('/workorder/detail/' . $workorder->id);
    }

    public function show($id)
    {
        $workorder = Workorder::findOrFail($id);
        
        return view('maintenance.workorder.detail', compact('workorder'));
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
