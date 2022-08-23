<?php

namespace App\Http\Controllers;

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
            ->paginate(10);
        // $dsbs = Dsbs::where('kd_kab', "LIKE", "%" . $kab . "%")->get();
        $data->appends($request->all());
        return view('monitoring.users', compact('auth', 'data', 'kabs', 'request'));
    }
}
