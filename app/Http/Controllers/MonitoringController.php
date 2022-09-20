<?php

namespace App\Http\Controllers;

use App\Models\Dsrt;
use App\Models\Kabs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    //

    public function users(Request $request)
    {
        $auth = Auth::user();
        $kab = $request->kab_filter;
        $kabs = Kabs::all();
        $data = User::role('PENCACAH')
            ->where('dummy_user', 0)
            ->where('name', "LIKE", "%" . $request->nama_filter . "%")
            ->where('kd_wilayah', "LIKE", "%" . $kab . "%")
            ->paginate(10);
        // $dsbs = Dsbs::where('kd_kab', "LIKE", "%" . $kab . "%")->get();
        $data->appends($request->all());
        return view('monitoring.users', compact('auth', 'data', 'kabs', 'request'));
    }

    public function users_show(Request $request, $id)
    {
        $auth = Auth::user();
        $user = user::find($id);
        $data = Dsrt::where('pencacah', $user->email)
            ->where('id_bs', 'LIKE', '%' . $request->bs_filter . '%')
            ->where('status_pencacahan', 'LIKE', '%' . $request->status_filter . '%')
            ->get();
        return view('monitoring.users_show', compact('auth', 'request', 'data'));
    }

    public function dsrt(Request $request)
    {
        $auth = Auth::user();
        $kab = $request->kab_filter;
        $kabs = Kabs::all();
        $n = Dsrt::whereNotNull('makanan_sebulan')->whereNotNull('nonmakanan_sebulan')->whereNotNull('jml_art2')->where('dummy_dsrt', '0')->where('dsrt.kd_kab', 'LIKE', '%' . $request->kab_filter . '%')->count('*');
        $x = 3 / 10 * $n;
        $d3 = Dsrt::whereNotNull('makanan_sebulan')
            ->whereNotNull('nonmakanan_sebulan')
            ->whereNotNull('jml_art2')
            ->where('dummy_dsrt', '0')
            ->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
            ->select(['id', 'kd_kab', 'id_bs', 'nu_rt', 'nama_krt', 'nama_krt2', 'makanan_sebulan', 'nonmakanan_sebulan', 'jml_art2', 'status_rumah', 'foto', DB::raw('(makanan_sebulan + nonmakanan_sebulan) / jml_art2 AS avg_perkapita')])
            ->orderBy('avg_perkapita')->get()[$x];
        if ($d3->avg_perkapita == null) {
            $d3->avg_perkapita = 0;
        }
        $minimum = 0;
        if ($request->minimum_filter) {
            $minimum = $request->minimum_filter;
        }
        $maksimum = 9999999999999;
        if ($request->maksimum_filter) {
            $maksimum = $request->maksimum_filter;
        }
        $data = DB::table('dsrt')
            ->select(['id', 'kd_kab', 'id_bs', 'nu_rt', 'nama_krt', 'nama_krt2', 'jml_art2', 'status_rumah', 'foto', DB::raw('IFNULL( (makanan_sebulan + nonmakanan_sebulan) / jml_art2 ,0) AS avg_perkapita ')])
            ->where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
            ->where('id_bs', 'LIKE', '%' .  $request->bs_filter . '%')
            ->where('dummy_dsrt', '0')
            ->whereBetween(DB::raw('IFNULL( (makanan_sebulan + nonmakanan_sebulan) /jml_art2,2)'), [$minimum, $maksimum])
            // ->where(DB::raw('FLOOR((makanan_sebulan + nonmakanan_sebulan)/jml_art2)'), '>=', $minimum)
            // ->where(DB::raw('FLOOR((makanan_sebulan + nonmakanan_sebulan)/jml_art2)'), '<=', $maksimum)
            ->paginate(15);
        // dd($data);
        $data->appends($request->all());
        return view('monitoring.dsrt', compact('auth', 'data', 'kabs', 'request', 'd3'));
    }

    public function dsrt_show(Request $request, $id)
    {
        $auth = Auth::user();
        $user = user::find($id);
        $data = Dsrt::find($id);
        return view('monitoring.dsrt_show', compact('auth', 'request', 'data'));
    }
}
