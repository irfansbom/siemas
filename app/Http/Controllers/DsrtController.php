<?php

namespace App\Http\Controllers;

use App\Imports\DsrtImport;
use App\Models\Dsart;
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

class DsrtController extends Controller
{
    //
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

        if ($request->pcl_filter) {
            $data = Dsrt::where('dsrt.kd_kab', "LIKE", "%" . $kab . "%")
                ->where('tahun',  "LIKE", "%" . $request->tahun_filter . "%")
                ->where('semester', "LIKE", "%" . $request->semester_filter . "%")
                ->where('dummy_dsrt', "LIKE", "%" . $request->dummy_filter . "%")
                ->where('dsrt.id_bs', "LIKE", "%" . $request->bs_filter . "%")
                ->where('dsrt.pencacah', "LIKE", "%" . $request->pcl_filter . "%")
                ->select(['dsrt.*'])
                ->orderby('id_bs')
                ->orderby('nu_rt')
                ->paginate(10);
        } else {
            $data = Dsrt::where('dsrt.kd_kab', "LIKE", "%" . $kab . "%")
                ->where('tahun',  "LIKE", "%" . $request->tahun_filter . "%")
                ->where('semester', "LIKE", "%" . $request->semester_filter . "%")
                ->where('dummy_dsrt', "LIKE", "%" . $request->dummy_filter . "%")
                ->where('dsrt.id_bs', "LIKE", "%" . $request->bs_filter . "%")
                ->select(['dsrt.*'])
                ->orderby('id_bs')
                ->orderby('nu_rt')
                ->paginate(10);
        }

        $dsbs = Dsbs::where('kd_kab', "LIKE", "%" . $kab . "%")->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)->orderBy('id_bs', 'asc')->get();

        $data->appends($request->all());
        return view('dsrt.index', compact('auth', 'data', 'kabs', 'dsbs', 'request', 'periode'));
    }

    public function show($id)
    {
        $periode = Periode::first();
        $auth = Auth::user();
        $real_id = Crypt::decryptString($id);
        $data = Dsrt::find($real_id);
        $dsart = Dsart::where('id_bs', $data->id_bs)
            ->where('nu_rt', $data->nu_rt)
            ->where('tahun', $data->tahun)
            ->where('semester', $data->semester)->get();
        return view('dsrt.show', compact('auth', 'id', 'data', 'periode', 'dsart'));
    }

    public function dsrt_generate(Request $request)
    {
        // $id_bs = $request->id_bs;
        // dd($request->all());
        try {
            $id_bs = Dsbs::where('kd_kab', 'LIKE', '%' . $request->kab . '%')->where('tahun', $request->tahun)
                ->where('semester', $request->semester)->get();
            // dd($id_bs);
            foreach ($id_bs as $bs) {
                $bss = Dsbs::where('id_bs', $bs->id_bs)->where('tahun', $request->tahun)
                    ->where('semester', $request->semester)->get()->first();
                $pengawas = $bss->pcl;
                // dd($bss->nks);
                if (!$pengawas) {
                    $pengawas = new User();
                }
                for ($i = 1; $i <= 10; $i++) {

                    $dsrt = Dsrt::updateOrCreate(
                        [
                            'id_bs' => $bs->id_bs, 'nu_rt' => $i, 'tahun' => $request->tahun, 'semester' => $request->semester,
                        ],
                        [
                            'kd_kab' => substr($bs->id_bs, 2, 2),
                            'nks' => $bss->nks,
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
    public function dsrt_swap(Request $request)
    {
        // dd($request->all());
        $periode = Periode::first();
        $no_1 = $request->ruta1;
        $no_2 = $request->ruta2;
        $temp_num = 50;
        $temp_kk_import_1 = "";
        $temp_kk_import_2 = "";

        $dsrt_1 = Dsrt::where('id_bs', $request->id_bs)
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('nu_rt', $request->ruta1)->first();
        $temp_kk_import_1 = $dsrt_1->nama_krt;
        $dsart_1 = Dsart::where('id_bs', $request->id_bs)
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('nu_rt', $request->ruta1)->get();

        $dsrt_2 =  Dsrt::where('id_bs', $request->id_bs)
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('nu_rt', $request->ruta2)->first();
        $temp_kk_import_2 = $dsrt_2->nama_krt;

        $dsart_2 =  Dsart::where('id_bs', $request->id_bs)
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('nu_rt', $request->ruta2)->get();

        $dsrt_1->nu_rt = $temp_num;
        foreach ($dsart_1 as $i => $art_1) {
            $dsart_1[$i]->nu_rt = $temp_num;
            $dsart_1[$i]->save();
        }
        $dsrt_1->save();

        $dsrt_2->nu_rt = $no_1;
        $dsrt_2->nama_krt = $temp_kk_import_1;
        foreach ($dsart_2 as $j => $art_2) {
            $dsart_2[$j]->nu_rt = $no_1;
            $dsart_2[$j]->save();
        }
        $dsrt_2->save();


        $dsrt_3 = Dsrt::where('id_bs', $request->id_bs)
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('nu_rt', $temp_num)->first();
        $dsart_3 = Dsart::where('id_bs', $request->id_bs)
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('nu_rt', $temp_num)->get();

        $dsrt_3->nu_rt = $no_2;
        $dsrt_3->nama_krt = $temp_kk_import_2;
        foreach ($dsart_3 as $k => $art_3) {
            $dsart_3[$k]->nu_rt = $no_2;
            $dsart_3[$k]->save();
        }
        $dsrt_3->save();

        return redirect()->back()->withInput()->with('success', 'Swap Berhasil');
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
