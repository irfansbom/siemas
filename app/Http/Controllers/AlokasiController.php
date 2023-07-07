<?php

namespace App\Http\Controllers;

use App\Exports\AlokasiDsbsExport;
use App\Imports\AlokasiDsbsImport;
use App\Models\Dsbs;
use App\Models\Kabs;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;

class AlokasiController extends Controller
{
    public function index(Request $request)
    {
        $periode = Periode::first();
        $auth = Auth::user();

        $tahun = ($request->tahun_filter) ? $request->tahun_filter : $periode->tahun;
        $semester = ($request->semester_filter) ? $request->semester_filter : $periode->semester;
        $flag_active = '1';
        if ($request->flag_active == '0') {
            $flag_active = '0';
        }

        if ($auth->hasAnyRole(['SUPER ADMIN', 'ADMIN PROVINSI'])) {
            $kab = $request->kab_filter;
            $kabs = Kabs::all();
        } else {
            $kab = $auth->kd_kab;
            $kabs = Kabs::where('id_kab', $kab)->get();
        }

        $data = Dsbs::where('tahun', "LIKE", "%" . $tahun . "%")
            ->where('semester', "LIKE", "%" . $semester . "%")
            ->where('kd_kab', "LIKE", "%" . $kab . "%")
            ->where('kd_kec', "LIKE", "%" . $request->kec_filter . "%")
            ->where('kd_desa', "LIKE", "%" . $request->desa_dilter . "%")
            ->where('nks', 'LIKE', '%' . $request->nks_filter  . '%')
            ->where('flag_active', "LIKE", "%" . $flag_active . "%")
            ->paginate(15);
        $data->appends($request->all());
        return view('alokasi.index', compact('auth', 'data', 'kabs', 'request', 'periode', 'semester', 'tahun', 'flag_active'));
    }

    public function show($id)
    {
        $real_id = Crypt::decryptString($id);
        $periode = Periode::first();
        $auth = Auth::user();
        $data = Dsbs::find($real_id);
        if ($auth->hasRole(['SUPER ADMIN', 'ADMIN PROVINSI'])) {
            $kabs = Kabs::all();
        } else {
            $kabs = Kabs::where('id_kab', $auth->kd_kab)->get();
        }
        $list_pencacah = User::role('PENCACAH')->get();
        $list_pengawas = User::role('PENGAWAS')->get();
        // dd($id);
        return view('alokasi.update', compact('data', 'auth', 'kabs', 'periode', 'list_pencacah', 'list_pengawas', 'id'));
    }

    public function update($id, Request $request)
    {
        $auth = Auth::user();
        try {
            $real_id = Crypt::decryptString($id);
            $pcl = '';
            $pml = '';
            $pencacah = User::where('email', $request->pencacah)->first();
            if ($pencacah) {
                $pcl = $pencacah->email;
            }
            $pengawas = User::where('email', $request->pengawas)->first();
            if ($pengawas) {
                $pml = $pengawas->email;
            }
            Dsbs::where('id', $real_id)
                ->update([
                    'pencacah' => $pcl,
                    'pengawas' => $pml,
                    'updated_by' => $auth->id,
                ]);
            return redirect('alokasi')->with('success', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect()->back()->withInput()->with('error', $ex->getMessage());
        }
    }

    public function export(Request $request)
    {
        $periode = Periode::first();
        $auth = Auth::user();
        if ($auth->kd_kab == '00') {
            $kab = "";
            if ($request->kab_filter) {
                $kab = $request->kab_filter;
            }
        } else {
            $kab = $auth->kd_kab;
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
