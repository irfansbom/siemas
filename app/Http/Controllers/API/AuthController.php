<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function login_android(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->join('kabs', function ($join) {
            $join->on('users.kd_wilayah', 'kabs.id_kab');
        })->first();

        if (!$user) {
            $json = [
                'message' => 'User tidak terdaftar',
                'status' => '0'
            ];
            return response()->json($json, 200);
        }

        if (!$user->hasanyrole('PENCACAH|PENGAWAS')) {
            $json = [
                'message' => 'Aplikasi ini hanya untuk petugas',
                'status' => '0'
            ];
            return response()->json($json, 200);
        }
        if (!$user || !Hash::check($request->password, $user->password)) {
            $json = [
                'message' => 'Gagal login, email atau password salah',
                'status' => '0'
            ];
            return response()->json($json, 200);
        }
        $token = $user->createToken($request->email)->plainTextToken;
        $user->token = $token;
        $json = [
            'message' => 'success',
            'body' => $user,
            'status' => '1'
        ];

        return  response()->json($json, 200);
        // return response($res, 200);
    }

    public function logout_android(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->tokens()->where('id', $request->tokenId)->delete();

        return response()->json([
            'message' => 'success',
        ], 200);
    }

    public function get_periode(Request $request)
    {
        $periode = Periode::all()->toArray();
        $json = [
            'message' => 'success',
            'body' => $periode,
            'status' => '1'
        ];
        return  response()->json($json, 200);
    }
}
