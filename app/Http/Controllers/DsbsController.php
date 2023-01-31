<?php

namespace App\Http\Controllers;

use App\Imports\DsbsImport;
use App\Models\Dsbs;
use App\Models\Kabs;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class DsbsController extends Controller
{
    public function index(Request $request)
    {
        $periode = Periode::first();
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
        // dd($kabs);
        $data = Dsbs::where('kd_kab', "LIKE", "%" . $kab . "%")
            ->where('id_bs', "LIKE", "%" . $request->bs_filter . "%")
            ->where('tahun', "LIKE", "%" . $request->tahun_filter . "%")
            ->where('semester', "LIKE", "%" . $request->semester_filter . "%")
            ->where('dummy', "LIKE", "%" . $request->dummy_filter . "%")
            ->paginate(15);
        $data->appends($request->all());
        $data_pencacah = User::where('kd_wilayah', "LIKE", "%" . $kab . "%")->role('pencacah')->get();

        return view('dsbs.index', compact('auth', 'data', 'kabs', 'data_pencacah', 'request', 'periode'));
    }

    public function store(Request $request)
    {
        $auth = Auth::user();
        try {
            $data = Dsbs::create([
                'kd_kab' => $request->kd_kab,
                'kd_kec' => $request->kd_kec,
                'kd_desa' => $request->kd_desa,
                'nbs' => $request->nbs,
                'id_bs' => '16' . $request->kd_kab . $request->kd_kec . $request->kd_desa . $request->nbs,
                'nks' => $request->nks,
                'tahun' => $request->tahun,
                'semester' => $request->semester,
                'status' => 0,
                'jml_rt' => 1,
                'sumber' => $request->sumber,
                'pencacah' => $request->pencacah,
                'pengawas' => User::where('email', $request->pencacah)->get()->first()->pengawas,
                'created_by' => $auth->id,
            ]);
            return redirect()->back()->with('success', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }


    public function destroy(Request $request)
    {
        $data = Dsbs::where('id', $request->id)->delete();
        if ($data > 0) {
            return redirect()->back()->with('success', 'Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal Dihapus');
        }
    }

    public function dsbs_pencacah(Request $request)
    {
        $data = Dsbs::find($request->id);
        $data->pencacah = $request->pencacah;
        $user = User::where('email', $request->pencacah)->get()->first();
        $pengawas = "";
        if ($user) {
            $pengawas = $user->pengawas;
        }
        $data->pengawas = $pengawas;
        $data->save();
        return redirect()->back()->with('success', 'berhasil disimpan');
    }

    public function dsbs_import(Request $request)
    {
        // dd($request->all());
        if ($request->file('import_file')) {
            Excel::import(new DsbsImport($request), request()->file('import_file'));
            return redirect()->back()->with('success', 'Berhasil Memasukkan data');
        } else {
            return redirect()->back()->with('error', 'Kesalahan File');
        }
    }
}
