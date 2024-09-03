<?php

namespace App\Http\Controllers;

use App\Imports\WebmonImport;
use App\Models\Dsrt;
use App\Models\Kabs;
use App\Models\Periode;
use App\Models\Webmons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $periode = Periode::first();
        $auth = Auth::user();
        $kabs = Kabs::all();

        //// table foto
        $tab_tab1 =
            Dsrt::where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('flag_active', '1')
            ->select(
                'dsrt.kd_kab',
                DB::raw('COUNT(id) as jml_dsrt'),
                DB::raw('SUM(jml_art_cacah) as jml_art_cacah'),
                DB::raw('SUM(CASE WHEN status_pencacahan >=3 THEN 1 ELSE 0 END) as selesai_cacah'),
                DB::raw("COUNT(foto) AS jml_foto"),
            )
            ->groupBy('dsrt.kd_kab')
            ->join('webmon', \DB::raw('SUBSTRING(dsrt.kd_kab, 1, 2)'), '=', 'webmon.kd_kab')
            ->get();

        $label_tab1 = [];
        $data_chart_foto = [];
        $data_chart_selesai = [];
        foreach ($tab_tab1 as $i => $tab1) {
            $label_tab1[] = $tab1->kabs['alias'];
            $data_chart_foto[] = $tab1->jml_foto / $tab1->jml_dsrt * 100;
            $data_chart_selesai[] = $tab1->selesai_cacah / $tab1->jml_dsrt * 100;
        }
        $tab_tab1->push(new Dsrt([
            'kd_kab' => '00',
            'kabs' => ["alias" => 'SUMSEL'],
            'jml_dsrt' => Dsrt::where('flag_active', '1')
                ->where('tahun', $periode->tahun)
                ->where('semester', $periode->semester)
                ->count("*"),

            'jml_art_cacah' => Dsrt::where('flag_active', '1')
                ->where('tahun', $periode->tahun)
                ->where('semester', $periode->semester)
                ->sum('jml_art_cacah'),

            'selesai_cacah' => Dsrt::where('flag_active', '1')
                ->where('tahun', $periode->tahun)
                ->where('semester', $periode->semester)
                ->select(DB::raw("SUM(CASE WHEN status_pencacahan >=3 THEN 1 ELSE 0 END) as selesai_cacah"))
                ->get()
                ->first()
                ->selesai_cacah,

            'jml_foto' => DB::table('dsrt')
                ->where('flag_active', '1')
                ->where('tahun', $periode->tahun)
                ->where('semester', $periode->semester)
                ->select(DB::raw("SUM(CASE WHEN foto IS NOT NULL THEN 1 ELSE 0 END) AS jml_foto"))
                ->get()
                ->first()
                ->jml_foto
        ]));
        foreach ($tab_tab1 as $i => $tab1) {
            $webmon = Webmons::where('kd_kab', $tab1->kd_kab)
                ->select('*')
                ->get()
                ->first();
            if ($webmon) {
                $tab_tab1[$i]->target_ruta = $webmon->target_ruta;
                $tab_tab1[$i]->jml_sudah = $webmon->jml_sudah;
                $tab_tab1[$i]->persen_sudah = $webmon->persen_sudah;
                $tab_tab1[$i]->jml_belum = $webmon->jml_belum;
                $tab_tab1[$i]->persen_belum = $webmon->persen_belum;
            }
        }

        //// table dsrt
        $n = Dsrt::where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('flag_active', '1')
            ->whereNotNull('makanan_sebulan')
            ->where('dsrt.kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
            ->count('id');
        $d3 = new Dsrt();
        $d3->avg_perkapita = 0;
        $dsrt = [];
        // if ($n >= 10) {
        //     $x = 3 / 10 * $n;
        //     $x = (int)$x;
        //     $d3 = Dsrt::where('tahun', $periode->tahun)
        //         ->where('semester', $periode->semester)
        //         ->where('flag_active', '1')
        //         ->whereNotNull('makanan_sebulan')
        //         ->whereNotNull('nonmakanan_sebulan')
        //         ->whereNotNull('jml_art_prelist')
        //         ->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
        //         ->select(['id', 'kd_kab', 'kd_kec', 'kd_desa', 'kd_bs', 'nu_rt', 'nama_krt_prelist', 'nama_krt_cacah', 'makanan_sebulan', 'nonmakanan_sebulan', 'jml_art_prelist', 'status_rumah', 'foto', DB::raw("( REPLACE(REPLACE(makanan_sebulan,'Rp.',''),'.','') + REPLACE(REPLACE(nonmakanan_sebulan, 'Rp.',''),'.','' ) ) / jml_art_prelist AS avg_perkapita")])
        //         ->orderBy('avg_perkapita')
        //         ->get()[$x];
        //     if ($d3->avg_perkapita == null) {
        //         $d3->avg_perkapita = 0;
        //     }
        //     $dsrt = DB::table('dsrt')
        //         ->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
        //         ->whereNotNull('makanan_sebulan')
        //         ->whereNotNull('nonmakanan_sebulan')
        //         ->whereNotNull('jml_art_prelist')
        //         ->where('flag_active', '0')
        //         ->where('tahun', $periode->tahun)
        //         ->where('semester', $periode->semester)
        //         ->select(['id', 'kd_kab', 'kd_kec', 'kd_desa', 'kd_bs', 'nu_rt', 'nama_krt_prelist', 'nama_krt_cacah', 'jml_art_prelist', 'status_rumah', 'foto', DB::raw("( REPLACE(REPLACE(makanan_sebulan,'Rp.',''),'.','') + REPLACE(REPLACE(nonmakanan_sebulan, 'Rp.',''),'.','' ) ) / jml_art_prelist AS avg_perkapita")])
        //         ->where(DB::raw("FLOOR((REPLACE(REPLACE(makanan_sebulan,'Rp.',''),'.','') + REPLACE(REPLACE(nonmakanan_sebulan, 'Rp.',''),'.','' ))/jml_art_cacah)"), '<=', $d3->avg_perkapita)
        //         ->orderBy('avg_perkapita')
        //         ->paginate(20);

        //     $dsrt->appends($request->all());
        // }
        return view('home', compact('request', 'auth', 'kabs', 'request', 'tab_tab1', 'data_chart_foto', 'data_chart_selesai', 'label_tab1', 'dsrt', 'd3', 'periode'));
    }

    public function webmon_import(Request $request)
    {
        if ($request->file('import_file')) {
            Excel::import(new WebmonImport($request), request()->file('import_file'));
            return redirect()->back()->with('success', 'Berhasil Memasukkan data');
        } else {
            return redirect()->back()->with('error', 'Kesalahan File');
        }
    }
}
