<?php

namespace App\Http\Controllers;

use App\Models\Dsrt;
use App\Models\Kabs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $auth = Auth::user();
        $kabs = Kabs::all();
        $tab_tab1 =
            Dsrt::join('kabs', 'kabs.id_kab', 'dsrt.kd_kab')
            ->where('dummy_dsrt', '0')
            ->select(
                [
                    'dsrt.kd_kab',
                    'alias',
                    DB::raw('COUNT(*) as jml_dsrt'),
                    DB::raw('SUM(jml_art2) as jml_art2'),
                    DB::raw("SUM(CASE WHEN foto IS NOT NULL THEN 1 ELSE 0 END) AS jml_foto"),
                ]
            )
            ->groupBy('dsrt.kd_kab', 'alias')
            ->get();
        $label_tab1 = [];
        $data_tab1 = [];
        foreach ($tab_tab1 as $i => $tab1) {
            $label_tab1[] = $tab1->alias;
            $data_tab1[] = $tab1->jml_foto / $tab1->jml_dsrt * 100;
        }
        // $tab_tab1[$i++]->alias = "SUMSEL";
        $tab_tab1->push(new Dsrt([
            'kd_kab' => '00',
            'alias' => 'SUMSEL',
            'jml_dsrt' => Dsrt::where('dummy_dsrt', '0')->count("*"),
            'jml_art2' => Dsrt::where('dummy_dsrt', '0')->sum('jml_art2'),
            'jml_foto' => DB::table('dsrt')->where('dummy_dsrt', '0')->select(DB::raw("SUM(CASE WHEN foto IS NOT NULL THEN 1 ELSE 0 END) AS jml_foto"))->get()->first()->jml_foto
        ]));
        $n = Dsrt::whereNotNull('makanan_sebulan')->where('dummy_dsrt', '0')->where('dsrt.kd_kab', 'LIKE', '%' . $request->kab_filter . '%')->count('*');


        if ($n >= 10) {
            $x = 3 / 10 * $n;
            $d3 = Dsrt::whereNotNull('makanan_sebulan')
                ->whereNotNull('nonmakanan_sebulan')
                ->whereNotNull('jml_art2')
                ->where('dummy_dsrt', '0')
                ->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
                ->select(['id', 'kd_kab', 'id_bs', 'nu_rt', 'nama_krt', 'makanan_sebulan', 'nonmakanan_sebulan', 'jml_art2', 'status_rumah', 'foto', DB::raw('(makanan_sebulan + nonmakanan_sebulan) / jml_art2 AS avg_perkapita')])
                ->orderBy('avg_perkapita')->get()[$x];
            // dd($d3);
            if ($d3->avg_perkapita == null) {
                $d3->avg_perkapita = 0;
            }
            $dsrt = DB::table('dsrt')
                ->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
                ->whereNotNull('makanan_sebulan')
                ->whereNotNull('nonmakanan_sebulan')
                ->whereNotNull('jml_art2')
                ->where('dummy_dsrt', '0')
                ->select(['id', 'kd_kab', 'id_bs', 'nu_rt', 'nama_krt', 'jml_art2', 'status_rumah', 'foto', DB::raw('(makanan_sebulan + nonmakanan_sebulan) / jml_art2 AS avg_perkapita')])
                ->where(DB::raw('FLOOR((makanan_sebulan + nonmakanan_sebulan)/jml_art2)'), '<=', $d3->avg_perkapita)
                ->orderBy('avg_perkapita')
                ->paginate(15);
        } else {
            $dsrt =  Dsrt::where('status_pencacahan', 'salah')->paginate();
        }
        $dsrt->appends($request->all());
        $data = [];
        return view('home', compact('request', 'auth', 'data', 'kabs', 'request', 'tab_tab1', 'data_tab1', 'label_tab1', 'dsrt'));
    }
}
