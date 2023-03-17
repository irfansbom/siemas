<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //


    public function index()
    {
        return view('login.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $auth = Auth::user();
            if ($auth->hasRole('PENCACAH')) {
                return redirect('pcl_dashboard');
            } else if ($auth->hasRole('PENGAWAS')) {
                return redirect('pml_dashboard');
            } else {
                return redirect('/');
            }
        } else {
            return back()->with('error', "gagal");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
