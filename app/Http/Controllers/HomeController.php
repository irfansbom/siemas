<?php

namespace App\Http\Controllers;

use App\Models\Dsrt;
use App\Models\Kabs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    public function index(Request $request)
    {
        $auth = Auth::user();
        $data = Dsrt::where('kd_kab', 'LIKE', '%' . $request->kab_filter . '%')
            ->where('id_bs', 'LIKE', '%' . $request->bs_filter . '%')
            ->paginate(10);
        $kabs = Kabs::all();
        return view('home', compact('request', 'auth', 'data', 'kabs', 'request'));
    }
}
