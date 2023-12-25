<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;

use App\Models\Workorder;
use App\Models\Workordermember;
use App\Models\Workordercomment;
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
        $order_no = 'WO-' . date('Ymd') . '-' . sprintf('%04d', (WorkOrder::count() + 1));
        $workorder = Workorder::create([
            'order_no' => $order_no,
            'user_id' => $user_id,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $status
        ]);

        $path = $request->file->store('public/wo_comment');
        $url = Storage::url($path);

        $update_by = Auth::user()->id;
        $description = 'Before';
        Workordercomment::create([
            'employee_id' => $update_by,
            'workorder_id' => $workorder->id,
            'file' => $url,
            'description' => $description,
        ]);

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
        return redirect('/workorder/detail/' . $workorder->order_no);
    }

    public function show($orderNumber)
    {
        $workorder = WorkOrder::where('order_no', $orderNumber)->firstOrFail();
        $locationlist = Location::all();
        $assetlist = Asset::all();
        $departmentlist = Department::all();

        return view('maintenance.workorder.detail', compact('workorder', 'locationlist', 'assetlist', 'departmentlist'));
    }

    public function addcomment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpeg,jpg,png,pdf',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal.', 'pastikan mengisi data dengan benar');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $path = $request->file->store('public/wo_comment');
        $url = Storage::url($path);

        $update_by = Auth::user()->id;

        Workordercomment::create([
            'employee_id' => $update_by,
            'workorder_id' => $request->id,
            'file' => $url,
            'description' => $request->description,
        ]);

        alert()->success('Berhasil.', 'Data berhasil ditambahkan');
        return redirect()->back();
    }

    public function addrelation(Request $request)
    {
        if (isset($request->asset_ids)) {
            $assets = $request->asset_ids;
            foreach ($assets as $asset) {
                Workordertag::create([
                    'workorder_id' => $request->id,
                    'asset_id' => $asset,
                ]);
            }
        }

        if (isset($request->location_ids)) {
            $locations = $request->location_ids;
            foreach ($locations as $location) {
                Workordertag::create([
                    'workorder_id' => $request->id,
                    'location_id' => $location,
                ]);
            }
        }

        if (isset($request->department_ids)) {
            $abc = $request->department_ids;
            foreach ($abc as $department) {
                Workordertag::create([
                    'workorder_id' => $request->id,
                    'department_id' => $department,
                ]);
            }
        }

        return redirect()->back();
    }

    public function wodone(Request $request)
    {
        $update_by = Auth::user()->id;

        $wo = workorder::where('id', $request->id)->firstOrFail();
        $wo->status = 'Done';
        $wo->employee_id = $update_by;
        $wo->updated_at = now();
        $wo->save();

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpeg,jpg,png,pdf',
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal.', 'pastikan mengisi data dengan benar');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $path = $request->file->store('public/wo_comment');
        $url = Storage::url($path);

        $update_by = Auth::user()->id;
        $description = 'Work Order Finished';
        Workordercomment::create([
            'employee_id' => $update_by,
            'workorder_id' => $request->id,
            'file' => $url,
            'description' => $description,
        ]);

        alert()->success('Berhasil.', 'Work Order has been Finished');
        return redirect()->back();
    }

    public function woundone($orderNumber)
    {
        $update_by = Auth::user()->id;

        $wo = WorkOrder::where('order_no', $orderNumber)->firstOrFail();
        $wo->status = 'On Progress';
        $wo->employee_id = $update_by;
        $wo->updated_at = now();
        $wo->save();

        return redirect()->back();
    }
}
