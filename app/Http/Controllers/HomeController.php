<?php

namespace App\Http\Controllers;

use App\Models\Dsrt;
use App\Models\Kabs;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $periode = Periode::first();
        $auth = Auth::user();
        $kabs = Kabs::all();

        // if ($auth->hasRole('PENCACAH')) {
        //     return redirect('pcl_dashboard');
        // }

        //// table foto
        $tab_tab1 =
            Dsrt::join('kabs', 'kabs.id_kab', 'dsrt.kd_kab')
            ->where('dummy_dsrt', '0')
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->select(
                [
                    'dsrt.kd_kab',
                    'alias',
                    DB::raw('COUNT(*) as jml_dsrt'),
                    DB::raw('SUM(jml_art2) as jml_art2'),
                    DB::raw('SUM(CASE WHEN status_pencacahan >=3 THEN 1 ELSE 0 END) as selesai_cacah'),
                    DB::raw("SUM(CASE WHEN foto IS NOT NULL THEN 1 ELSE 0 END) AS jml_foto"),
                ]
            )
            ->groupBy('dsrt.kd_kab', 'alias')
            ->get();
        $label_tab1 = [];
        $data_chart_foto = [];
        $data_chart_selesai = [];
        foreach ($tab_tab1 as $i => $tab1) {
            $label_tab1[] = $tab1->alias;
            $data_chart_foto[] = $tab1->jml_foto / $tab1->jml_dsrt * 100;
            $data_chart_selesai[] = $tab1->selesai_cacah / $tab1->jml_dsrt * 100;
        }
        $tab_tab1->push(new Dsrt([
            'kd_kab' => '00',
            'alias' => 'SUMSEL',
            'jml_dsrt' => Dsrt::where('dummy_dsrt', '0')->where('tahun', $periode->tahun)
                ->where('semester', $periode->semester)->count("*"),

            'jml_art2' => Dsrt::where('dummy_dsrt', '0')->where('tahun', $periode->tahun)
                ->where('semester', $periode->semester)->sum('jml_art2'),

            'selesai_cacah' => Dsrt::where('dummy_dsrt', '0')->where('tahun', $periode->tahun)
                ->where('semester', $periode->semester)->select(DB::raw("SUM(CASE WHEN status_pencacahan >=3 THEN 1 ELSE 0 END) as selesai_cacah"))->get()->first()->selesai_cacah,

            'jml_foto' => DB::table('dsrt')->where('dummy_dsrt', '0')->where('tahun', $periode->tahun)
                ->where('semester', $periode->semester)->select(DB::raw("SUM(CASE WHEN foto IS NOT NULL THEN 1 ELSE 0 END) AS jml_foto"))->get()->first()->jml_foto
        ]));

        //// table dsrt
        $n = Dsrt::whereNotNull('makanan_sebulan')->where('dummy_dsrt', '0')
            ->where('dsrt.kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)->count('*');

        $d3 = new Dsrt();
        $d3->avg_perkapita = 0;

        if ($n >= 10) {
            $x = 3 / 10 * $n;
            $x = (int)$x;
            // dd($x);
            $d3 = Dsrt::whereNotNull('makanan_sebulan')
                ->whereNotNull('nonmakanan_sebulan')
                ->whereNotNull('jml_art2')
                ->where('dummy_dsrt', '0')
                ->where('tahun', $periode->tahun)
                ->where('semester', $periode->semester)
                ->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
                ->select(['id', 'kd_kab', 'id_bs', 'nu_rt', 'nama_krt', 'nama_krt', 'makanan_sebulan', 'nonmakanan_sebulan', 'jml_art2', 'status_rumah', 'foto', DB::raw("( REPLACE(REPLACE(makanan_sebulan,'Rp.',''),'.','') + REPLACE(REPLACE(nonmakanan_sebulan, 'Rp.',''),'.','' ) ) / jml_art2 AS avg_perkapita")])
                // ->get();
                // dd($d3);
                ->orderBy('avg_perkapita')->get()[$x];
            if ($d3->avg_perkapita == null) {
                $d3->avg_perkapita = 0;
            }
            $dsrt = DB::table('dsrt')
                ->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
                ->whereNotNull('makanan_sebulan')
                ->whereNotNull('nonmakanan_sebulan')
                ->whereNotNull('jml_art2')
                ->where('dummy_dsrt', '0')
                ->where('tahun', $periode->tahun)
                ->where('semester', $periode->semester)
                ->select(['id', 'kd_kab', 'id_bs', 'nu_rt', 'nama_krt', 'nama_krt2', 'jml_art2', 'status_rumah', 'foto', DB::raw("( REPLACE(REPLACE(makanan_sebulan,'Rp.',''),'.','') + REPLACE(REPLACE(nonmakanan_sebulan, 'Rp.',''),'.','' ) ) / jml_art2 AS avg_perkapita")])
                ->where(DB::raw("FLOOR((REPLACE(REPLACE(makanan_sebulan,'Rp.',''),'.','') + REPLACE(REPLACE(nonmakanan_sebulan, 'Rp.',''),'.','' ))/jml_art2)"), '<=', $d3->avg_perkapita)
                ->orderBy('avg_perkapita')
                ->paginate(20);
        } else {
            $dsrt = Dsrt::where('status_pencacahan', '10')
                ->where('tahun', $periode->tahun)
                ->where('semester', $periode->semester)
                ->where('dummy_dsrt', '0')
                ->paginate();
        }
        $dsrt->appends($request->all());
        $data = [];


        return view('home', compact('request', 'auth', 'data', 'kabs', 'request', 'tab_tab1', 'data_chart_foto', 'data_chart_selesai', 'label_tab1', 'dsrt', 'd3', 'periode'));
    }
}
