<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;

use App\Models\Task;
use App\Models\Project;
use App\Models\Taskmember;
use App\Models\Tasktag;
use App\Models\Department;
use App\Models\Location;
use App\Models\Employee;
use App\Models\User;
use App\Models\Assetallocation;
use App\Models\Asset;
use App\Models\File;
use App\Models\Taskcomment;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index() {
        $data_project = Project::all();

        return view('maintenance.project.index', compact('data_project'));
    }

    public function create()
    {
        return view('maintenance.project.create');
    }

    public function store(Request $request)
    {
        if (in_array(Auth::user()->role->task, ['1', '2', '3', '4'])) {

            $validator = Validator::make($request->all(), [
                'project_name' => 'required',
                'project_desc' => 'required',
                'project_due_date' => 'required|date',
                'project_start_date' => 'required|date',
            ]);

            if ($validator->fails()) {
                alert()->error('Gagal.', 'pastikan mengisi data dengan benar');
                return redirect('/project/create')
                    ->withErrors($validator)
                    ->withInput();
            }

            $created_by = Auth::user()->id;
            $project = Project::create([
                'created_by' => $created_by,
                'name' => $request->project_name,
                'description' => $request->project_desc,
                'start_date' => $request->project_start_date,
                'due_date' => $request->project_due_date,
            ]);

            alert()->success('Berhasil.', 'Data berhasil ditambahkan');
            return redirect('/project/detail/' . $project->id);
        } else {
            alert()->error('Stop.', 'Access Forbidden !');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $detail_project = Project::findOrFail($id);

        return view('maintenance.project.detail', compact('detail_project'));
    }

    public function update(Request $request, $id)
    {
        if (!isset($request->task_vendor)) {
            $data = Task::find($id);
            $data->task_price = $request->input('task_price');
            $data->task_remark = $request->input('task_remark');
            $data->task_status = $request->input('task_status');
            $data->save();
        } else {
            $data = Task::find($id);
            $data->task_vendor = $request->input('task_vendor');
            $data->task_vendor_phone = $request->input('task_vendor_phone');
            $data->save();
        }

        if (isset($request->asset_ids)) {
            $assets = $request->asset_ids;
            foreach ($assets as $asset) {
                Tasktag::create([
                    'task_id' => $id,
                    'asset_id' => $asset,
                ]);
            }
        }

        if (isset($request->location_ids)) {
            $locations = $request->location_ids;
            foreach ($locations as $location) {
                Tasktag::create([
                    'task_id' => $id,
                    'location_id' => $location,
                ]);
            }
        }

        if (isset($request->member_ids)) {
            $members = $request->member_ids;
            foreach ($members as $member) {
                Taskmember::create([
                    'task_id' => $id,
                    'user_id' => $member,
                ]);
            }
        }

        alert()->success('Berhasil.', 'Data berhasil diperbarui');
        return redirect()->back();
    }

    public function addfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpeg,jpg,png,pdf',
            'file_remark' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal.', 'pastikan mengisi data dengan benar');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $path = $request->file->store('public/task');
        $url = Storage::url($path);

        File::create([
            'task_id' => $request->id,
            'file' => $url,
            'remark' => $request->file_remark,
        ]);

        alert()->success('Berhasil.', 'Data berhasil ditambahkan');
        return redirect()->back();
    }

    public function taskdone($id)
    {
        if (in_array(Auth::user()->role->task, ['2', '3', '4'])) {
            $update_by = Auth::user()->id;

            $task = Task::findOrFail($id);
            $task->task_status = 'Done';
            $task->employee_id = $update_by;
            $task->updated_at = now();
            $task->save();

            return redirect()->back();
        } else {
            alert()->error('Stop.', 'Access Forbidden !');
            return redirect()->back();
        }
    }

    public function taskundone($id)
    {
        if (in_array(Auth::user()->role->task, ['2', '3', '4'])) {
            $update_by = Auth::user()->id;

            $task = Task::findOrFail($id);
            $task->task_status = 'On Progress';
            $task->employee_id = $update_by;
            $task->updated_at = now();
            $task->save();

            return redirect()->back();
        } else {
            alert()->error('Stop.', 'Access Forbidden !');
            return redirect()->back();
        }
    }

    public function addcomment(Request $request)
    {
        if (in_array(Auth::user()->role->task, ['1', '2', '3', '4'])) {
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

            $path = $request->file->store('public/task_comment');
            $url = Storage::url($path);

            $update_by = Auth::user()->id;

            Taskcomment::create([
                'created_by' => $update_by,
                'task_id' => $request->id,
                'file' => $url,
                'comment' => $request->description,
            ]);

            alert()->success('Berhasil.', 'Data berhasil ditambahkan');
            return redirect()->back();
        } else {
            alert()->error('Stop.', 'Access Forbidden !');
            return redirect()->back();
        }
    }
}
