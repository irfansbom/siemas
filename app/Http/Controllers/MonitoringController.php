<?php

namespace App\Http\Controllers;

use App\Exports\DsrtExport;
use App\Exports\DsrtWebMonExport;
use App\Models\Dsbs;
use App\Models\Dsrt;
use App\Models\Jadwal212;
use App\Models\Kabs;
use App\Models\Laporan212;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MonitoringController extends Controller
{
    public function users(Request $request)
    {
        $periode = Periode::first();
        $auth = Auth::user();
        $kab = $request->kab_filter;
        $kabs = Kabs::all();

        $dsbs = Dsbs::
        select('pencacah')
        ->where('tahun',$periode->tahun)
        ->where('semester', $periode->semester)
        ->where('kd_kab', "LIKE", "%" . $kab . "%")
        ->where('dummy', 0)->groupby('pencacah')
        ->get()->toArray();

        $data = User::wherein('email', $dsbs)
        ->where('dummy_user', 0)
        ->where('name', "LIKE", "%" . $request->nama_filter . "%")
        ->paginate(10);
        $data->appends($request->all());
        return view('monitoring.users', compact('auth', 'data', 'kabs', 'request', 'periode'));
    }

    public function users_show(Request $request, $id)
    {
        $periode = Periode::first();
        $auth = Auth::user();
        $user = user::find($id);
        $data = Dsrt::where('pencacah', $user->email)
            ->where('id_bs', 'LIKE', '%' . $request->bs_filter . '%')
            ->where('tahun',$periode->tahun)
            ->where('semester', $periode->semester)
            ->where('status_pencacahan', 'LIKE', '%' . $request->status_filter . '%')
            ->get();
        return view('monitoring.users_show', compact('auth', 'request', 'data', 'periode'));
    }

    public function dsrt(Request $request)
    {
        $periode = Periode::first();
        $tahun = $request->tahun_filter;
        $semester = $request->semester_filter;
        $auth = Auth::user();
        $kab = $request->kab_filter;
        $kabs = Kabs::all();
        $minimum = 0;
        if ($request->minimum_filter) {
            $minimum = $request->minimum_filter;
        }
        $maksimum = 9999999999999;
        if ($request->maksimum_filter) {
            $maksimum = $request->maksimum_filter;
        }
        $n = Dsrt::whereNotNull('makanan_sebulan')
        ->whereNotNull('nonmakanan_sebulan')
        ->whereNotNull('jml_art2')
        ->where('dummy_dsrt', '0')
        ->where('tahun', $tahun)
        ->where('semester', $semester)
        ->where('dsrt.kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
        ->count('*');
        $d3 = new Dsrt();
        $d3->avg_perkapita = 0;
        if($n >= 10){
            $x = 3 / 10 * $n;
            $d3 = Dsrt::whereNotNull('makanan_sebulan')
                ->whereNotNull('nonmakanan_sebulan')
                ->whereNotNull('jml_art2')
                ->where('dummy_dsrt', '0')
                ->where('tahun', $tahun)
                ->where('semester', $semester)
                ->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
                ->select(['id', 'kd_kab', 'id_bs','nk', 'nu_rt', 'nama_krt', 'nama_krt2', 'makanan_sebulan', 'nonmakanan_sebulan', 'jml_art2', 'status_rumah', 'foto', DB::raw("( REPLACE(REPLACE(makanan_sebulan,'Rp.',''),'.','') + REPLACE(REPLACE(nonmakanan_sebulan, 'Rp.',''),'.','' ) ) / jml_art2 AS avg_perkapita")])
                ->orderBy('avg_perkapita')->get()[$x];
            if ($d3->avg_perkapita == null) {
                $d3->avg_perkapita = 0;
            }
        }
        $data = DB::table('dsrt')
            ->select(['id', 'kd_kab', 'id_bs','nks', 'nu_rt', 'nama_krt', 'nama_krt2', 'jml_art2', 'status_rumah', 'foto', DB::raw("IFNULL( (( REPLACE(REPLACE(makanan_sebulan,'Rp.',''),'.','') + REPLACE(REPLACE(nonmakanan_sebulan, 'Rp.',''),'.','' ) )) / jml_art2 ,0) AS avg_perkapita ")])
            ->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
            ->where('id_bs', 'LIKE', '%' .  $request->bs_filter . '%')
            ->where('dummy_dsrt', '0')
            ->where('tahun', $tahun)
            ->where('semester', $semester)
            ->whereBetween(DB::raw("IFNULL( (( REPLACE(REPLACE(makanan_sebulan,'Rp.',''),'.','') + REPLACE(REPLACE(nonmakanan_sebulan, 'Rp.',''),'.','' ) )) /jml_art2,2)"), [$minimum, $maksimum])
           ->paginate(20);
        $data->appends($request->all());
        return view('monitoring.dsrt', compact('auth', 'data', 'kabs', 'request', 'd3', 'periode'));
    }

    public function dsrt_show(Request $request, $id)
    {
        $periode = Periode::first();
        $auth = Auth::user();
        $user = user::find($id);
        $data = Dsrt::find($id);
        return view('monitoring.dsrt_show', compact('auth', 'request', 'data', 'periode'));
    }

    public function dsrt_export(Request $request)
    {
        $auth = Auth::user();
        if ($auth->kd_wilayah == '00') {
            $kab = "";
            if ($request->kab_filter) {
                $kab = $request->kab_filter;
            }
        } else {
            $kab = $auth->kd_wilayah;
        }
        $data = new DsrtExport($request, $kab);
        return Excel::download($data, 'dsrt.xlsx');
    }

    public function dsrt_export_webmon(Request $request)
    {
        // dd($request->semester);
        $auth = Auth::user();
        if ($auth->kd_wilayah == '00') {
            $kab = "";
            if ($request->kab_filter) {
                $kab = $request->kab_filter;
            }
        } else {
            $kab = $auth->kd_wilayah;
        }
        $data = new DsrtWebMonExport($request, $kab);
        return Excel::download($data, 'dsrt_webmon.xlsx');
    }

    public function mon_212(Request $request){
        $periode = Periode::first();
        $auth = Auth::user();
        $kab = $request->kab_filter;
        $kabs = Kabs::all();

        $jadwal = Jadwal212::all();

        $dsbs = Dsbs::
        select('pengawas')
        ->where('tahun',$periode->tahun)
        ->where('semester', $periode->semester)
        ->where('kd_kab', "LIKE", "%" . $kab . "%")
        ->where('dummy', 0)->groupby('pengawas')
        ->get()->toArray();
        $data = User::wherein('email', $dsbs)
        ->where('name', "LIKE", "%" . $request->nama_filter . "%")
        ->paginate(15);
        // dd($data);
        $data->appends($request->all());
        return view('monitoring.mon_212', compact('periode', 'auth', 'data', 'kabs', 'kab', 'request', 'jadwal'));
    }

}
