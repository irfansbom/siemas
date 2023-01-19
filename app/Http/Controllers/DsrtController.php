<?php

namespace App\Http\Controllers;

use App\Imports\DsrtImport;
use App\Models\Dsbs;
use App\Models\Dsrt;
use App\Models\Kabs;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;

class DsrtController extends Controller
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
        // dd($kabs);
        $data = Dsrt::where('dsrt.kd_kab', "LIKE", "%" . $kab . "%")
            ->where('tahun', "LIKE", "%" . $request->tahun_filter . "%")
            ->where('semester', "LIKE", "%" . $request->semester_filter . "%")
            ->where('dummy_dsrt', "LIKE", "%" . $request->dummy_filter . "%")
            ->where('dsrt.id_bs', "LIKE", "%" . $request->bs_filter . "%")
            ->select(['dsrt.*'])
            ->paginate(10);
        $dsbs = Dsbs::where('kd_kab', "LIKE", "%" . $kab . "%")->get();
        $data->appends($request->all());
        // console.log();
        // dd($data);
        return view('dsrt.index', compact('auth', 'data', 'kabs', 'dsbs', 'request'));
    }

    public function show($id)
    {
        $auth = Auth::user();
        $real_id = Crypt::decryptString($id);
        $data = Dsrt::find($real_id);
        return view('dsrt.show', compact('auth', 'id', 'data'));
    }

    public function dsrt_generate(Request $request)
    {
        // $id_bs = $request->id_bs;
        // dd($request->all());
        try {

            $id_bs = Dsbs::where('kd_kab', $request->kab)->where('tahun', $request->tahun)
            ->where('semester', $request->semester)->get();
            // dd($id_bs);
            foreach ($id_bs as $bs) {
                $bss = Dsbs::where('id_bs', $bs->id_bs)->get()->first();
                $pengawas = $bss->pcl;

                if (!$pengawas) {
                    $pengawas = new User();
                }
                for ($i = 1; $i <= 10; $i++) {
                    $dsrt = Dsrt::updateOrCreate(
                        [
                            'id_bs' => $bs->id_bs, 'nu_rt' => $i, 'tahun'=>$request->tahun, 'semester' => $request->semester,
                        ],
                        [
                            'kd_kab' => substr($bs->id_bs, 2, 2),
                            'pencacah' => $bss->pencacah,
                            'pengawas' => $pengawas->pengawas,
                            'dummy_dsrt' => $bss->dummy,
                        ]
                    );
                }
            }
            return redirect()->back()->withInput()->with('success', 'Berhasil Digenerate');
        } catch (QueryException $ex) {
            return redirect()->back()->withInput()->with('error', $ex->getMessage());
        }
    }

    public function dsrt_import(Request $request)
    {
        if ($request->file('import_file')) {
            Excel::import(new DsrtImport($request), request()->file('import_file'));
            return redirect()->back()->with('success', 'Berhasil Memasukkan data');
        } else {

            return redirect()->back()->with('error', 'Kesalahan File');
        }
    }

    public function destroy(Request $request)
    {
        // dd($request->id);
        $data = Dsrt::where('id', $request->id)->delete();
        if ($data > 0) {
            return redirect()->back()->with('success', 'Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal Dihapus');
        }
    }
}
