<?php

namespace App\Http\Controllers;

use App\Imports\DsbsImport;
use App\Models\Dsbs;
use App\Models\Dsrt;
use App\Models\Kabs;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class DsbsController extends Controller
{
    public function index(Request $request)
    {
        $periode = Periode::first();
        $auth = Auth::user();
        $data_pengawas = [];

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
            $kabs = Kabs::where('id_kab', $auth->kd_kab)->get();
        }

        $data = Dsbs::where('tahun', "LIKE", "%" . $tahun . "%")
            ->where('semester', "LIKE", "%" . $semester . "%")
            ->where('kd_kab', "LIKE", "%" . $kab . "%")
            ->where('kd_kec', "LIKE", "%" . $request->kec_filter . "%")
            ->where('kd_desa', "LIKE", "%" . $request->desa_filter . "%")
            ->where('nks', 'LIKE', '%' . $request->nks_filter  . '%')
            ->where('flag_active', "LIKE", "%" . $flag_active . "%")
            ->paginate(15);
        // dd($flag_active);
        $data->appends($request->all());

        return view('dsbs.index', compact('auth', 'data', 'kabs', 'request', 'periode', 'semester', 'tahun', 'flag_active'));
    }

    public function create(Request $request)
    {
        $periode = Periode::first();
        $auth = Auth::user();
        $data = new DSBS();
        if ($auth->hasRole(['SUPER ADMIN', 'ADMIN PROVINSI'])) {
            $kabs = Kabs::all();
        } else {
            $kabs = Kabs::where('id_kab', $auth->kd_kab)->get();
        }

        $list_pencacah = User::role('PENCACAH')->get();
        $list_pengawas = User::role('PENGAWAS')->get();
        // dd($auth->roles);
        return view('dsbs.create', compact('data', 'auth', 'kabs', 'periode', 'list_pencacah', 'list_pengawas'));
    }

    public function store(Request $request)
    {
        $auth = Auth::user();
        $periode = Periode::first();
        $pcl = null;
        $pml = null;

        $pencacah = User::where('email', $request->pencacah)->first();
        if ($pencacah) {
            $pcl = $pencacah->email;
        }
        $pengawas = User::where('email', $request->pengawas)->first();
        if ($pengawas) {
            $pml = $pengawas->email;
        }
        try {
            $data = Dsbs::create([
                'tahun' => $periode->tahun,
                'semester' => $periode->semester,
                'kd_kab' => $request->kd_kab,
                'kd_kec' => $request->kd_kec,
                'kd_desa' => $request->kd_desa,
                'kd_bs' => $request->kd_bs,
                'id_bs' => '16' . $request->kd_kab . $request->kd_kec . $request->kd_desa . $request->kd_bs,
                'nks' => $request->nks,
                'sls' => $request->sls,
                'jml_rt' => 1,
                'pencacah' => $pcl,
                'pengawas' => $pml,
                'created_by' => $auth->id,
            ]);
            $dsrt = Dsrt::where('id_bs', '16' . $request->kd_kab . $request->kd_kec . $request->kd_desa . $request->kd_bs);
            if ($dsrt) {
                $dsrt->update([
                    'pencacah' => $pcl,
                    'pengawas' => $pml,
                ]);
            }
            return redirect('dsbs')->with('success', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect()->back()->withInput()->with('error', $ex->getMessage());
        }
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
        return view('dsbs.update', compact('data', 'auth', 'kabs', 'periode', 'list_pencacah', 'list_pengawas', 'id'));
    }

    public function update($id, Request $request)
    {
        $auth = Auth::user();
        try {
            $real_id = Crypt::decryptString($id);
            $pcl = null;
            $pml = null;
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
                    'kd_kab' => $request->kd_kab,
                    'kd_kec' => $request->kd_kec,
                    'kd_desa' => $request->kd_desa,
                    'kd_bs' => $request->kd_bs,
                    'id_bs' => '16' . $request->kd_kab . $request->kd_kec . $request->kd_desa . $request->kd_bs,
                    'nks' => $request->nks,
                    'sls' => $request->sls,
                    'jml_rt' => 1,
                    'pencacah' => $pcl,
                    'pengawas' => $pml,
                    'updated_by' => $auth->id,
                ]);

            Dsrt::where('id_bs', '16' . $request->kd_kab . $request->kd_kec . $request->kd_desa . $request->kd_bs)
                ->update([
                    'pencacah' => $pcl,
                    'pengawas' => $pml,
                ]);


            return redirect('dsbs')->with('success', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect()->back()->withInput()->with('error', $ex->getMessage());
        }
    }

    public function destroy($id)
    {
        $data = Dsbs::where('id', $id)->delete();
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
        if ($request->file('import_file')) {
            Excel::import(new DsbsImport($request), request()->file('import_file'));
            return redirect()->back()->with('success', 'Berhasil Memasukkan data');
        } else {
            return redirect()->back()->with('error', 'Kesalahan File');
        }
    }
}
