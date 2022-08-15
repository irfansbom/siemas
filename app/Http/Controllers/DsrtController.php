<?php

namespace App\Http\Controllers;

use App\Models\Dsbs;
use App\Models\Dsrt;
use App\Models\Kabs;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $data = Dsrt::where('kd_kab', "LIKE", "%" . $kab . "%")->paginate(10);
        $dsbs = Dsbs::where('kd_kab', "LIKE", "%" . $kab . "%")->get();
        // $data_pencacah = User::where('kd_wilayah', "LIKE", "%" . $kab . "%")->role('pencacah')->get();
        return view('dsrt.index', compact('auth', 'data', 'kabs', 'dsbs'));
    }

    public function dsrt_generate(Request $request)
    {
        // dd($request->all());
        $id_bs = $request->id_bs;
        try {
            foreach ($id_bs as $bs) {
                for ($i = 1; $i <= 10; $i++) {
                    $dsrt = Dsrt::updateOrCreate(
                        [
                            'id_bs' => $bs, 'nu_rt' => $i,  'semester' => $request->semester,
                        ],
                        [
                            'kd_kab' => substr($bs, 2, 2),
                            'nama_krt' => "",
                            'jml_art' => "",
                        ]
                    );
                }
            }
            return redirect()->back()->withInput()->with('success', 'Berhasil Digenerate');
        } catch (QueryException $ex) {
            return redirect()->back()->withInput()->with('error', $ex->getMessage());
        }
    }
}
