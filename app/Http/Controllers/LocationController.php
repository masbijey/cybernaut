<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Department;
use App\Models\Location;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class LocationController extends Controller
{
    public function index()
    {
        $location = Location::withTrashed()->get();

        return view('location.index', compact('location'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal.','pastikan mengisi data dengan benar');
            return redirect('/location');
        }

        Location::create([
            'name' => $request->name
        ]);

        alert()->success('Berhasil.', 'Deparment baru berhasil di tambahkan.');
        return redirect('/location');
    }

}
