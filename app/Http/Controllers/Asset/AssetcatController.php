<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;

use App\Models\Assetcat;
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

class AssetcatController extends Controller
{
    public function index()
    {
        $assetcat = Assetcat::withTrashed()->get();

        return view('asset.category.index', compact('assetcat'));

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal.','pastikan mengisi data dengan benar');
            return redirect('/assetcat');
        }

        Location::create([
            'name' => $request->name
        ]);

        alert()->success('Berhasil.', 'Deparment baru berhasil di tambahkan.');
        return redirect('/assetcat');
    }
}

