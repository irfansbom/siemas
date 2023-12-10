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
        // $data = Dsrt::all();
        // dd($kab);

        if ($request->pcl_filter) {
            $data = Dsrt::where('tahun',  "LIKE", "%" . $tahun . "%")
                ->where('semester', "LIKE", "%" . $semester . "%")
                ->where('kd_kab', "LIKE", "%" . $kab . "%")
                ->where('kd_kec', "LIKE", "%" . $request->kec_filter . "%")
                ->where('kd_desa', "LIKE", "%" . $request->desa_filter . "%")
                ->where('nks', "LIKE", "%" . $request->nks_filter . "%")
                ->where('pencacah', "LIKE", "%" . $request->pcl_filter . "%")
                ->where('flag_active', "LIKE", "%" . $flag_active . "%")
                ->orderby('kd_kab')
                ->orderby('kd_kec')
                ->orderby('kd_desa')
                ->orderby('kd_bs')
                ->orderby('nu_rt')
                ->paginate(10);
        } else {
            $data = Dsrt::where('tahun',  "LIKE", "%" . $tahun . "%")
                ->where('semester', "LIKE", "%" . $semester . "%")
                ->where('kd_kab', "LIKE", "%" . $kab . "%")
                ->where('kd_kec', "LIKE", "%" . $request->kec_filter . "%")
                ->where('kd_desa', "LIKE", "%" . $request->desa_filter . "%")
                ->where('nks', "LIKE", "%" . $request->nks_filter . "%")
                // ->where('pencacah', "LIKE", "%" . $request->pcl_filter . "%")
                ->where('flag_active', "LIKE", "%" . $flag_active . "%")
                ->orderby('kd_kab')
                ->orderby('kd_kec')
                ->orderby('kd_desa')
                ->orderby('kd_bs')
                ->orderby('nu_rt')
                ->paginate(10);
        }

        $dsbs = Dsbs::where('kd_kab', "LIKE", "%" . $kab . "%")
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->orderBy('kd_bs', 'asc')->get();

        $data->appends($request->all());
        return view('dsrt.index', compact('auth', 'data', 'kabs', 'dsbs', 'request', 'periode',  'semester', 'tahun', 'flag_active'));
    }

    public function show($id)
    {
        $periode = Periode::first();
        $auth = Auth::user();
        $real_id = Crypt::decryptString($id);
        $data = Dsrt::find($real_id);
        $dsart = Dsart::where('tahun', $data->tahun)
            ->where('semester', $data->semester)
            ->where('kd_kab', $data->kd_kab)
            ->where('kd_kec', $data->kd_kec)
            ->where('kd_desa', $data->kd_desa)
            ->where('kd_bs', $data->kd_bs)
            ->where('nu_rt', $data->nu_rt)
            ->get();
        return view('dsrt.show', compact('auth', 'id', 'data', 'periode', 'dsart'));
    }

    public function dsrt_generate(Request $request)
    {
        $auth = Auth::user();
        try {
            $dsbs = Dsbs::where('kd_kab', 'LIKE', '%' . $request->kab . '%')
                ->where('tahun', $request->tahun)
                ->where('semester', $request->semester)
                ->get();
            foreach ($dsbs as $bs) {
                $bss = Dsbs::where('tahun', $request->tahun)
                    ->where('semester', $request->semester)
                    ->where('kd_kab', $bs->kd_kab)
                    ->where('kd_kec', $bs->kd_kec)
                    ->where('kd_desa', $bs->kd_desa)
                    ->where('kd_bs', $bs->kd_bs)
                    ->get()
                    ->first();
                for ($i = 1; $i <= 10; $i++) {
                    $dsrt = Dsrt::updateOrCreate(
                        [
                            'tahun' => $request->tahun,
                            'semester' => $request->semester,
                            'kd_kab' => $bss->kd_kab,
                            'kd_kec' => $bss->kd_kec,
                            'kd_desa' => $bss->kd_desa,
                            'kd_bs' => $bss->kd_bs,
                            'id_bs' => '16', $bss->kd_kab . $bss->kd_kec . $bss->kd_desa . $bss->kd_bs,
                            'nu_rt' => $i,
                        ],
                        [
                            'nks' => $bss->nks,
                            'pencacah' => $bss->pencacah,
                            'pengawas' => $bss->pengawas,
                            'flag_active' => $bss->flag_active,
                            'created_by' => $auth->id,
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
        $periode = Periode::first();
        $no_1 = $request->ruta1;
        $no_2 = $request->ruta2;
        $temp_num = 50;
        $nama_krt_prelist1 = "";
        $nama_krt_prelist2 = "";

        $id_bs = $request->id_bs;

        $kd_kab = substr($id_bs, 2, 2);
        $kd_kec = substr($id_bs, 4, 3);
        $kd_desa = substr($id_bs, 7, 3);
        $kd_bs = substr($id_bs, 10, 4);

        $dsrt_1 = Dsrt::where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('kd_kab', $kd_kab)
            ->where('kd_kec', $kd_kec)
            ->where('kd_desa', $kd_desa)
            ->where('kd_bs', $kd_bs)
            ->where('nu_rt', $no_1)
            ->first();
        $nama_krt_prelist1 = $dsrt_1->nama_krt;
        $dsart_1 = Dsart::where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('kd_kab', $kd_kab)
            ->where('kd_kec', $kd_kec)
            ->where('kd_desa', $kd_desa)
            ->where('kd_bs', $kd_bs)
            ->where('nu_rt', $no_1)
            ->get();

        $dsrt_2 =  Dsrt::where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('kd_kab', $kd_kab)
            ->where('kd_kec', $kd_kec)
            ->where('kd_desa', $kd_desa)
            ->where('kd_bs', $kd_bs)
            ->where('nu_rt', $no_2)
            ->first();
        $nama_krt_prelist2 = $dsrt_2->nama_krt;

        $dsart_2 =  Dsart::where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('kd_kab', $kd_kab)
            ->where('kd_kec', $kd_kec)
            ->where('kd_desa', $kd_desa)
            ->where('kd_bs', $kd_bs)
            ->where('nu_rt', $no_2)
            ->get();


        // memasukkan dsrt pertama & dsartnya ke nomor 50
        $dsrt_1->nu_rt = $temp_num;
        foreach ($dsart_1 as $i => $art_1) {
            $dsart_1[$i]->nu_rt = $temp_num;
            $dsart_1[$i]->save();
        }
        $dsrt_1->save();

        // memasukkan dsrt kedua & dsartnya ke nomor pertama tadi
        $dsrt_2->nu_rt = $no_1;
        $dsrt_2->nama_krt_prelist = $nama_krt_prelist1; //nama krt_prelist berubah yg pertama
        foreach ($dsart_2 as $j => $art_2) {
            $dsart_2[$j]->nu_rt = $no_1;
            $dsart_2[$j]->save();
        }
        $dsrt_2->save();


        // mengambil dsrt pertama yang sudah jadi nomor 50
        $dsrt_3 = Dsrt::where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('kd_kab', $kd_kab)
            ->where('kd_kec', $kd_kec)
            ->where('kd_desa', $kd_desa)
            ->where('kd_bs', $kd_bs)
            ->where('nu_rt', $temp_num)
            ->first();
        $dsart_3 = Dsart::where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('kd_kab', $kd_kab)
            ->where('kd_kec', $kd_kec)
            ->where('kd_desa', $kd_desa)
            ->where('kd_bs', $kd_bs)
            ->where('nu_rt', $temp_num)
            ->get();

        // memasukkan dsrt pertama & dsartnya ke nomor kedua
        $dsrt_3->nu_rt = $no_2;
        $dsrt_3->nama_krt_prelist = $nama_krt_prelist2;
        foreach ($dsart_3 as $k => $art_3) {
            $dsart_3[$k]->nu_rt = $no_2;
            $dsart_3[$k]->save();
        }
        $dsrt_3->save();

        return redirect()->back()->withInput()->with('success', 'Swap Berhasil');
    }

    public function dsart_swap(Request $request)
    {
        // dd($request->all());
        $periode = Periode::first();
        $no_1 = $request->ruta1;
        $no_2 = $request->ruta2;
        $temp_num = 50;
        $temp_kk_import_1 = "";
        $temp_kk_import_2 = "";

        $dsart_1 = Dsart::where('id_bs', $request->id_bs)
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('nu_rt', $request->ruta1)->get();

        $dsart_2 =  Dsart::where('id_bs', $request->id_bs)
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('nu_rt', $request->ruta2)->get();

        foreach ($dsart_1 as $i => $art_1) {
            $dsart_1[$i]->nu_rt = $temp_num;
            $dsart_1[$i]->save();
        }

        foreach ($dsart_2 as $j => $art_2) {
            $dsart_2[$j]->nu_rt = $no_1;
            $dsart_2[$j]->save();
        }

        $dsart_3 = Dsart::where('id_bs', $request->id_bs)
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('nu_rt', $temp_num)->get();

        foreach ($dsart_3 as $k => $art_3) {
            $dsart_3[$k]->nu_rt = $no_2;
            $dsart_3[$k]->save();
        }

        return redirect()->back()->withInput()->with('success', 'Swap Berhasil');
    }

    public function destroy($id)
    {
        // dd($request->id);
        $data = Dsrt::where('id', $id)->delete();
        if ($data > 0) {
            return redirect()->back()->with('success', 'Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal Dihapus');
        }
    }
}
