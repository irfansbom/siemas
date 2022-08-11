<?php

namespace App\Http\Controllers;

use App\Models\Dsbs;
use App\Models\kabs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class DsbsController extends Controller
{
    //

    public function index()
    {
        $auth = Auth::user();
        $data_pengawas = [];

        if ($auth->kd_wilayah == '00') {
            $kab = "";
            $kabs = kabs::all();
        } else {
            $kab = $auth->kd_wilayah;
            $kabs = Kabs::where('id_kab', $auth->kd_wilayah)->get();
        }

        $data = Dsbs::where('kd_kab', "LIKE", "%" . $kab . "%")->paginate(15);
        // dd($data[0]->pcl->);
        $data_pencacah = User::where('kd_wilayah', "LIKE", "%" . $kab . "%")->role('pencacah')->get();
        return view('dsbs.index', compact('auth', 'data', 'kabs', 'data_pencacah'));
    }


    public function dsbs_pencacah(Request $request)
    {
        $data = Dsbs::find($request->id);
        $data->pencacah = $request->pencacah;
        $data->save();
        return redirect()->back()->with('success', 'berhasil disimpan');
    }
}
