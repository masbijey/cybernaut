<?php

namespace App\Http\Controllers\Hris\Attendance;

use Illuminate\Http\Request;
use App\Models\Shift;


class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::all();
        return view('shift.index', ['shifts' => $shifts]);
    }

    public function create()
    {
        return view('shift.create');
    }

    public function store(Request $request)
    {
        $shift = new Shift;
        $shift->name = $request->name;
        $shift->start_time = $request->start_time;
        $shift->end_time = $request->end_time;
        $shift->save();

        return redirect('/shift');
    }

    public function edit($id)
    {
        $shift = Shift::where('id', $id)->first();
        return view('shift.edit', ['shift' => $shift]);
    }

    public function update(Request $request, $id)
    {
        $shift = Shift::where('id', $id)->first();
        $shift->nama = $request->name;
        $shift->start_time = $request->start_time;
        $shift->end_time = $request->end_time;
        $shift->save();

        return redirect('/shift');
    }

    public function destroy($id)
    {
        $shift = Shift::where('id', $id)->first();
        $shift->delete();

        return redirect('/shift');
    }
}
