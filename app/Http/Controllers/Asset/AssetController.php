<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;

use App\Models\Asset;
use App\Models\Assetcat;
use App\Models\Employee;
use App\Models\User;
use App\Models\Department;
use App\Models\Location;
use App\Models\Assetallocation;
use App\Models\Tasktag;
use App\Models\Task;
use App\Models\Workordertag;
use App\Models\Workorder;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class AssetController extends Controller
{
    public function index()
    {
        if (in_array(Auth::user()->role->asset, ['1', '2', '3', '4'])) {
            $asset = Asset::all();
            return view('asset.index', compact('asset'));
        } else {
            alert()->error('Stop.', 'Access Forbidden !');
            return redirect()->back();
        }
    }

    public function create()
    {
        if (in_array(Auth::user()->role->asset, ['2', '3', '4'])) {

            $assetcat = Assetcat::all();
            $location = Location::all();
            $employee = User::all();
            $department = Department::all();

            return view('asset.create', compact('assetcat', 'location', 'employee', 'department'));
        } else {
            alert()->error('Stop.', 'Access Forbidden !');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if (in_array(Auth::user()->role->asset, ['2', '3', '4'])) {
            $validator = Validator::make($request->all(), [
                //for asset table
                'name' => 'required',
                'category' => 'required',
                'merk' => 'required',
                'type' => 'required',
                'serialNumber' => 'required',
                'file' => 'required',
                'vendorName' => 'required',
                'vendorPhone' => 'required|numeric',
                'vendorAddress' => 'required',
                'buyDate' => 'required',
                'buyPrice' => 'required',
                'buycond' => 'required',

                //for allocation table
                'remark' => 'nullable',
                'location' => 'required',
                'department' => 'required',
                'employee' => 'required'
            ]);

            if ($validator->fails()) {
                alert()->error('Gagal.', 'pastikan mengisi data dengan benar');
                return redirect('/asset');
            }

            $path = $request->file->store('public/asset');
            $url = Storage::url($path);

            $updateBy = Auth::user()->id;
            $token = Str::random(32);

            while (Asset::where('token', $token)->exists()) {
                $token = Str::random(32);
            }

            while (Asset::where('serialNumber', $request->serialNumber)->exists()) {
                alert()->error('Gagal.', 'Aset dgn SN tersebut sudah ada');
                return redirect('/asset');
            }

            $newasset = Asset::create([
                'category_id' => $request->category,
                'token' => $token,
                'name' => $request->name,
                'vendorName' => $request->vendorName,
                'vendorPhone' => $request->vendorPhone,
                'vendorAddress' => $request->vendorAddress,
                'merk' => $request->merk,
                'type' => $request->type,
                'serialNumber' => $request->serialNumber,
                'buyDate' => $request->buyDate,
                'buyPrice' => $request->buyPrice,
                'file' => $url,
                'created_by' => $updateBy,
                'buyCond' => $request->buycond
            ]);

            Assetallocation::create([
                'asset_id' => $newasset->id,
                'employee_id' => $request->employee,
                'location_id' => $request->location,
                'department_id' => $request->department,
                'file' => $url,
                'condition' => $request->condition,
                'remark' => $request->remark,
                'created_by' => $updateBy
            ]);

            alert()->success('Berhasil.', 'Data berhasil dibuat');
            return redirect('/asset');
        } else {
            alert()->error('Stop.', 'Access Forbidden !');
            return redirect()->back();
        }
    }

    public function show($token)
    {
        if (in_array(Auth::user()->role->asset, ['1', '2', '3', '4'])) {
            $data = Asset::where('token', $token)->firstOrFail();

            $id = $data->id;

            $task = Tasktag::where('asset_id', $id)
                ->with('task')
                ->get();

            $workorder = Workordertag::where('asset_id', $id)
                ->with('workorder')
                ->get();

            $allocation = Assetallocation::where('asset_id', $id)->get();

            return view('asset.show', compact(
                'data',
                'task',
                'allocation',
                'workorder'
            ));
        } else {
            alert()->error('Stop.', 'Access Forbidden !');
            return redirect()->back();
        }
    }

    public function destroy($token)
    {
        // $data = Asset::where('token', $token)->firstOrFail();
        // $data->delete();

        // alert()->success('Berhasil.', 'Data berhasil dihapus');
        // return redirect('/asset');
    }

    public function category()
    {
        $assetcat = Assetcat::withTrashed()->get();

        return view('asset.category.index', compact('assetcat'));
    }

    public function categorystr(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal.', 'pastikan mengisi data dengan benar');
            return redirect()->back();
        }

        Assetcat::create([
            'name' => $request->name
        ]);

        alert()->success('Berhasil.', 'Category baru berhasil di tambahkan.');
        return redirect('/asset/category');
    }

    public function location()
    {
        $location = Location::withTrashed()->get();
        return view('location.index', compact('location'));
    }

    public function locationstr(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal.', 'pastikan mengisi data dengan benar');
            return redirect('/asset/location');
        }

        Location::create([
            'name' => $request->name
        ]);

        alert()->success('Berhasil.', 'Location baru berhasil di tambahkan.');
        return redirect('/asset/location');
    }
}
