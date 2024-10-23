<?php

namespace App\Http\Controllers;

use App\Exports\DsartExport;
use App\Exports\DsrtExport;
use App\Exports\DsrtWebMonExport;
use App\Exports\MonUsersExport;
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

        $dsbs = Dsbs::select('pencacah')
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('kd_kab', "LIKE", "%" . $kab . "%")
            ->where('flag_active', 1)->groupby('pencacah')
            ->get()->toArray();

        $data = User::wherein('email', $dsbs)
            ->where('flag_active', 1)
            ->where('name', "LIKE", "%" . $request->nama_filter . "%")
            ->orderby('kd_kab')
            ->orderby('name')
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
            ->where('kd_kab', "LIKE", "%" . $request->kab . "%")
            ->where('kd_kec', "LIKE", "%" . $request->kec_filter . "%")
            ->where('kd_desa', "LIKE", "%" . $request->desa_filter . "%")
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('status_pencacahan', 'LIKE', '%' . $request->status_filter . '%')
            ->orderby('kd_kab',)
            ->orderby('kd_kec')
            ->orderby('kd_desa')
            ->orderby('nu_rt')
            ->get();
        return view('monitoring.users_show', compact('auth', 'request', 'data', 'periode'));
    }

    public function users_export(Request $request)
    {
        $response = Excel::download(new MonUsersExport($request), 'Mon_users_' . $request->kab_filter . '.xlsx');
        ob_end_clean();
        return $response;
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

        $data_temp = Dsrt::whereNotNull('makanan_sebulan')
            ->whereNotNull('jml_art_cacah')
            ->where('flag_active', '1')
            ->where('tahun', $tahun)
            ->where('semester', $semester)
            ->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
            ->select([
                '*',
                DB::raw("CAST(REPLACE(REPLACE(makanan_sebulan, 'Rp.', ''), '.', '') AS SIGNED) / jml_art_cacah AS avg_perkapita")
            ])
            ->orderBy(DB::raw("CAST(avg_perkapita AS SIGNED)"), 'asc')
            ->get();


        $total = $data_temp->count();
        $desil = [];

        for ($i = 1; $i <= 10; $i++) {
            $index = round(($i * $total) / 10) - 1;
            $desil[$i] = $data_temp[$index]->avg_perkapita;
        }
        // dd($data_temp[1]['avg_perkapita']);
        $data = Dsrt::where('flag_active', '1')
            ->where('tahun', $tahun)
            ->where('semester', $semester)
            ->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
            ->select(['*', DB::raw("CAST(REPLACE(REPLACE(makanan_sebulan, 'Rp.', ''), '.', '') AS SIGNED) / jml_art_cacah AS avg_perkapita")])
            ->where('status_pencacahan', 'LIKE', $request->status_filter)
            ->whereBetween(DB::raw("CAST(REPLACE(REPLACE(makanan_sebulan, 'Rp.', ''), '.', '') AS SIGNED) / jml_art_cacah"), [$minimum, $maksimum])
            ->paginate(20);
        $data->appends($request->all());

        // dd($desil);
        // $d3 = new Dsrt();
        // $d3->avg_perkapita = 0;
        // if ($n >= 10) {
        //     $x = 3 / 10 * $n;
        //     $d3 = Dsrt::whereNotNull('makanan_sebulan')
        //         ->whereNotNull('jml_art_cacah')
        //         ->where('flag_active', '1')
        //         ->where('tahun', $tahun)
        //         ->where('semester', $semester)
        //         ->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
        //         ->select(['id', 'kd_kab', 'id_bs', 'nks', 'nu_rt', 'nama_krt_prelist', 'nama_krt_cacah', 'status_pencacahan', 'makanan_sebulan', 'nonmakanan_sebulan', 'jml_art_cacah', 'status_rumah', 'foto', 'durasi_pencacahan', 'gsmp_desk', 'bantuan_desk', DB::raw("( REPLACE(REPLACE(makanan_sebulan,'Rp.',''),'.','') ) / jml_art_cacah AS avg_perkapita")])
        //         ->orderBy('avg_perkapita')->get()[$x];
        //     if ($d3->avg_perkapita == null) {
        //         $d3->avg_perkapita = 0;
        //     }
        // }
        // $status_pencacahan = 0;
        // if (!empty($request->status_filter)) {
        //     $status_pencacahan = $request->status_filter;
        // }
        // $data = DB::table('dsrt')
        //     ->select(['id', 'kd_kab', 'id_bs', 'nks', 'nu_rt', 'nama_krt_prelist', 'nama_krt_cacah', 'status_pencacahan', 'makanan_sebulan', 'jml_art_cacah', 'status_rumah', 'foto', 'durasi_pencacahan', 'gsmp_desk', 'bantuan_desk', DB::raw("IFNULL( (( REPLACE(REPLACE(makanan_sebulan,'Rp.',''),'.','')) / jml_art_cacah ,0) AS avg_perkapita ")])
        //     ->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
        //     ->where('id_bs', 'LIKE', '%' .  $request->bs_filter . '%')
        //     ->where('nks', "LIKE", "%" . $request->nks_filter . "%")
        //     ->where('status_pencacahan', 'LIKE', $request->status_filter)
        //     ->where('flag_active', '1')
        //     ->where('tahun', $tahun)
        //     ->where('semester', $semester)
        //     ->whereBetween(DB::raw("IFNULL( (( REPLACE(REPLACE(makanan_sebulan,'Rp.',''),'.','')) / jml_art_cacah ,0) AS avg_perkapita "), [$minimum, $maksimum])
        //     ->paginate(20);
        // $data->appends($request->all());
        return view('monitoring.dsrt', compact('auth', 'data', 'kabs', 'desil', 'request', 'periode'));
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
        if ($auth->kd_kab == '00') {
            $kab = "";
            if ($request->kab_filter) {
                $kab = $request->kab_filter;
            }
        } else {
            $kab = $auth->kd_kab;
        }
        $data = new DsrtExport($request, $kab);
        $response = Excel::download($data, 'dsrt.xlsx');
        ob_end_clean();
        return $response;
    }

    public function dsart_export(Request $request)
    {
        $auth = Auth::user();
        if ($auth->kd_kab == '00') {
            $kab = "";
            if ($request->kab_filter) {
                $kab = $request->kab_filter;
            }
        } else {
            $kab = $auth->kd_kab;
        }
        $data = new DsartExport($request, $kab);
        $response = Excel::download($data, 'dsart.xlsx');
        ob_end_clean();
        return $response;
    }

    public function dsrt_export_webmon(Request $request)
    {
        // dd($request->semester);
        $auth = Auth::user();
        if ($auth->kd_kab == '00') {
            $kab = "";
            if ($request->kab_filter) {
                $kab = $request->kab_filter;
            }
        } else {
            $kab = $auth->kd_kab;
        }
        $data = new DsrtWebMonExport($request, $kab);
        $response = Excel::download($data, 'dsrt_webmon.xlsx');
        ob_end_clean();
        return $response;
    }

    public function mon_212(Request $request)
    {
        $periode = Periode::first();
        $auth = Auth::user();
        $kab = $request->kab_filter;
        $kabs = Kabs::all();

        $jadwal = Jadwal212::all();

        $dsbs = Dsbs::select('pengawas')
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('kd_kab', "LIKE", "%" . $kab . "%")
            ->where('flag_active', 1)
            ->groupby('pengawas')
            ->get()->toArray();

        $data = User::wherein('email', $dsbs)
            ->where('name', "LIKE", "%" . $request->nama_filter . "%")
            ->paginate(15);
        // dd($data);
        $data->appends($request->all());
        return view('monitoring.mon_212', compact('periode', 'auth', 'data', 'kabs', 'kab', 'request', 'jadwal'));
    }
}
