<?php

namespace App\Http\Controllers;

use App\Exports\AlokasiDsbsExport;
use App\Imports\AlokasiDsbsImport;
use App\Models\Dsbs;
use App\Models\Kabs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AlokasiController extends Controller
{
    //

    public function index(Request $request)
    {
        $auth = Auth::user();
        $data_pengawas = [];

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
        $data = Dsbs::where('kd_kab', "LIKE", "%" . $kab . "%")
            ->where('id_bs', "LIKE", "%" . $request->bs_filter . "%")
            ->paginate(15);
        $data->appends($request->all());
        $data_pencacah = User::where('kd_wilayah', "LIKE", "%" . $kab . "%")->role('pencacah')->get();
        return view('alokasi.index', compact('auth', 'data', 'kabs', 'data_pencacah', 'request'));
    }

    public function export(Request $request)
    {
        $auth = Auth::user();
        if ($auth->kd_wilayah == '00') {
            $kab = "";
            if ($request->kab_filter) {
                $kab = $request->kab_filter;
            }
        } else {
            $kab = $auth->kd_wilayah;
        }
        $data = new AlokasiDsbsExport($request, $kab);
        return Excel::download($data, 'alokasi_dsbs.xlsx');
    }

    public function import(Request $request)
    {
        if ($request->file('import_file')) {
            Excel::import(new AlokasiDsbsImport(), request()->file('import_file'));
            return redirect()->back()->with('success', 'Berhasil Memasukkan data');
        } else {

            return redirect()->back()->with('error', 'Kesalahan File');
        }
    }
}
