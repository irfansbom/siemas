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
        $data = Dsrt::where('kd_kab', "LIKE", "%" . $kab . "%")
            ->where('id_bs', "LIKE", "%" . $request->bs_filter . "%")
            ->paginate(10);
        $dsbs = Dsbs::where('kd_kab', "LIKE", "%" . $kab . "%")->get();
        $data->appends($request->all());
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
        // dd($request->all());
        $id_bs = $request->id_bs;
        try {
            foreach ($id_bs as $bs) {
                $bss = Dsbs::where('id_bs', $bs)->get()->first();
                $pengawas = User::where('email', $bss->pencacah)->get()->first();
                if (!$pengawas) {
                    $pengawas = new User();
                }
                for ($i = 1; $i <= 10; $i++) {
                    $dsrt = Dsrt::updateOrCreate(
                        [
                            'id_bs' => $bs, 'nu_rt' => $i,  'semester' => $request->semester,
                        ],
                        [
                            'kd_kab' => substr($bs, 2, 2),
                            'pencacah' => $bss->pencacah,
                            'pengawas' => $pengawas->pengawas,
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
        $data = Dsrt::where('id', $request->id)->delete();
        if ($data > 0) {
            return redirect()->back()->with('success', 'Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal Dihapus');
        }
    }
}
