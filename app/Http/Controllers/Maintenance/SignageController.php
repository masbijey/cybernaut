<?php

namespace App\Http\Controllers\Maintenance;
use App\Http\Controllers\Controller;

use Auth;
use App\Models\Signage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SignageController extends Controller
{
    public function power()
    {
        $meeting_room = "Power Up";
        $event_name = DB::table('signage')
                        ->where('meeting_room', '=', 'pu')
                        ->latest()
                        ->first();
        return view('signage.signage', compact('meeting_room', 'event_name'));
    }

    public function gear()
    {
        $meeting_room = "Gear Up";
        $event_name = DB::table('signage')
                        ->where('meeting_room', '=', 'gu')
                        ->latest()
                        ->first();
        return view('signage.signage', compact('meeting_room', 'event_name'));
    }

    public function light()
    {
        $meeting_room = "Light Up";
        $event_name = DB::table('signage')
                        ->where('meeting_room', '=', 'lu')
                        ->latest()
                        ->first();
        return view('signage.signage', compact('meeting_room', 'event_name'));
    }

    public function lobby()
    {
        $power_up = DB::table('signage')
                    ->where('meeting_room', '=', 'pu')
                    ->latest()
                    ->first();
        $gear_up = DB::table('signage')
                    ->where('meeting_room', '=', 'gu')
                    ->latest()
                    ->first();
        $light_up = DB::table('signage')
                    ->where('meeting_room', '=', 'lu')
                    ->latest()
                    ->first();

        $wokntok = DB::table('signage')
                    ->where('meeting_room', '=', 'wnt')
                    ->latest()
                    ->first();
                
        return view('signage.lobby', compact('power_up', 'gear_up', 'light_up', 'wokntok'));

    }

    public function index()
    {
        if (Auth::user()->role != null) {
            $signagelevel = Auth::user()->role->maintenance;
            if (!in_array($signagelevel, ['1', '2', '3'])) {
                alert()->error('Gagal.','Hubungi admin untuk akses di menu Signage');
                return redirect('/');
            }
            $data = DB::table('signage')
                ->latest()
                ->get();
            return view('signage.list', compact('data'));  
        } 
        else {
            alert()->error('Gagal.','Hubungi admin untuk akses di menu Signage');
                return redirect('/');
        }
    }

    public function store(Request $request)
    {
        $signagelevel = Auth::user()->role->maintenance;
        
        if (!in_array($signagelevel, ['2', '3'])) {
            alert()->error('Gagal.','Tidak ada akses membuat Signage');
            return redirect('signage');
        }

        $update_by =  Auth::user()->id;

        Signage::create([
            'meeting_room'  => $request->meeting_room,
            'event_name'    => $request->event_name,
            'update_by'     => $update_by
        ]);

        alert()->success('Berhasil.','Signage berhasil di update');
        return redirect('/signage');
    }
}
