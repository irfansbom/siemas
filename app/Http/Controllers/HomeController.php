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
            ->select(
                [
                    'kd_kab',
                    'alias',
                    DB::raw('COUNT(*) as jml_dsrt'),
                    DB::raw('SUM(jml_art) as jml_art'),
                    DB::raw("SUM(CASE WHEN foto IS NOT NULL THEN 1 ELSE 0 END) AS jml_foto"),
                ]
            )
            ->groupBy('kd_kab', 'alias')
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
            'jml_dsrt' => Dsrt::count("*"),
            'jml_art' => Dsrt::sum('jml_art'),
            'jml_foto' => DB::table('dsrt')->select(DB::raw("SUM(CASE WHEN foto IS NOT NULL THEN 1 ELSE 0 END) AS jml_foto"))->get()->first()->jml_foto
        ]));
        $n = Dsrt::whereNotNull('makanan_sebulan')->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')->count('*');
        if ($n >= 10) {
            $x = 3 / 10 * $n;
            $d3 = Dsrt::whereNotNull('makanan_sebulan')->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
                ->select(['id', 'kd_kab', 'id_bs', 'nu_rt', 'nama_krt', 'jml_art', 'status_rumah', 'foto', DB::raw('(makanan_sebulan + nonmakanan_sebulan) / jml_art AS avg_perkapita')])
                ->orderBy('avg_perkapita')->get()[$x];
            $dsrt = DB::table('dsrt')
                ->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
                ->whereNotNull('makanan_sebulan')
                ->select(['id', 'kd_kab', 'id_bs', 'nu_rt', 'nama_krt', 'jml_art', 'status_rumah', 'foto', DB::raw('(makanan_sebulan + nonmakanan_sebulan) / jml_art AS avg_perkapita')])
                ->where(DB::raw('FLOOR((makanan_sebulan + nonmakanan_sebulan)/jml_art)'), '<=', $d3->avg_perkapita)
                ->orderBy('avg_perkapita')
                ->paginate(15);
        } else {
            $dsrt =  Dsrt::where('status_pencacahan', 'salah')->paginate();
        }
        $dsrt->appends($request->all());
        $data = [];
        // $data = Dsrt::where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
        //     ->where('id_bs', 'LIKE', '%' . $request->bs_filter . '%')
        //     ->where('status_pencacahan', "LIKE", "%" . $request->status_filter . "%")
        //     ->paginate(10);
        // $data->appends($request->all());
        return view('home', compact('request', 'auth', 'data', 'kabs', 'request', 'tab_tab1', 'data_tab1', 'label_tab1', 'dsrt'));
    }
}
