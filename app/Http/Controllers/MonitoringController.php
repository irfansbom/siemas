<?php

namespace App\Http\Controllers;

use App\Models\Dsrt;
use App\Models\Kabs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
