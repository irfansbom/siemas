<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $periode = Periode::first();
        $auth = Auth::user();
        $rekap = Http::accept('application/json')->get('http://66.96.237.94:8181/ssn16/rekap.php')->json();
        return view('rekap', compact('rekap', 'auth', 'periode'));
    }
}
