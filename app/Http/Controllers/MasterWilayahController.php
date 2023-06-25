<?php

namespace App\Http\Controllers;

use App\Models\Desas;
use App\Models\Kabs;
use App\Models\Kecs;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterWilayahController extends Controller
{
    public function kecamatan(Request $request)
    {
        $periode = Periode::first();
        $auth = Auth::user();
        if ($auth->kd_wilayah == '00') {
            $kab = "";
            if ($request->kab_filter) {
                $kab = $request->kab_filter;
            }
            $kabs = Kabs::all();
        } else {
            $kab = $auth->kd_wilayah;
            $kabs = Kabs::where('id_kab', $auth->kd_wilayah)->get();
        }

        $data = Kecs::where('id_kab', 'LIKE', '%' . $kab . '%')->paginate(15);
        $data->appends($request->all());
        return view('master_wil.kecamatan', compact('kabs', 'data', 'auth', 'periode'));
    }

    public function desa(Request $request)
    {
        $auth = Auth::user();
        $periode = Periode::first();
        if ($auth->kd_wilayah == '00') {
            $kab = "";
            if ($request->kab_filter) {
                $kab = $request->kab_filter;
            }
            $kabs = Kabs::all();
        } else {
            $kab = $auth->kd_wilayah;
            $kabs = Kabs::where('id_kab', $auth->kd_wilayah)->get();
        }
        $data = Desas::where('id_kab', 'LIKE', '%' . $kab . '%')->paginate(15);
        return view('master_wil.desa', compact('kabs', 'data', 'auth', 'periode'));
    }
    public function list_kec(Request $request)
    {
        $data = Kecs::where('id_kab', $request->kab_filter)->orderBy('id_kec')->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }

    public function list_desa(Request $request)
    {
        $data = Desas::where('id_kab', $request->kab_filter)->where('id_kec', $request->kec_filter)->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
