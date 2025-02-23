<?php

namespace App\Http\Controllers\Hris\Detail;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\User;
use App\Models\Employeetraining;

class TrainingController extends Controller
{
    public function index()
    {
        $training = Employeetraining::withTrashed()->get();
        $employee = User::withTrashed()->get();

        return view('hris.detail.training.index', compact('training', 'employee'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_ids'  => 'required|array',
            'trainer' => 'required',
            'start' => 'required',
            'end' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:jpeg,jpg,png,pdf',
            'venue' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal.', 'pastikan mengisi data dengan benar');
            return redirect('/training');
        }

        $timestart = Carbon::parse($request->start);
        $timeend = Carbon::parse($request->end);
        $duration = $timestart->diff($timeend);
        $diffFormatted = $duration->format('%H:%I:%S');

        $path = $request->file->store('public/training');
        $url = Storage::url($path);

        $employeeIds = $request->employee_ids;

        foreach ($employeeIds as $employeeId) {
            Employeetraining::create([
                'user_id' => $employeeId,
                'description' => $request->description,
                'start' => $timestart,
                'end' => $timeend,
                'duration' => $diffFormatted,
                'trainer' => $request->trainer,
                'file' => $url,
                'venue' => $request->venue
            ]);
        }

        alert()->success('Berhasil.', 'Data berhasil dibuat');
        return redirect('/training');
    }
}
