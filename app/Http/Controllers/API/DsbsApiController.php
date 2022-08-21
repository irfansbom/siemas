<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dsbs;
use Illuminate\Http\Request;

class DsbsApiController extends Controller
{
    //
    public function get_alokasi_dsbs_pcl(Request $request)
    {


        $data_dsbs = Dsbs::where('pencacah', $request->pencacah)
            ->join('kabs', function ($join) {
                $join->on('dsbs.kd_kab', 'kabs.id_kab');
            })
            ->join('kecs', function ($join) {
                $join->on('dsbs.kd_kab', 'kecs.id_kab')->on('dsbs.kd_kec', 'kecs.id_kec');
            })
            ->join('desas', function ($join) {
                $join->on('dsbs.kd_kab', 'desas.id_kab')->on('dsbs.kd_kec', 'desas.id_kec')->on('dsbs.kd_desa', 'desas.id_desa');
            })
            ->get()->toArray();

        if (!$data_dsbs) {
            $json = [
                'message' => 'dsbs Belum Dialokasikan',
                'status' => '0'
            ];
            return  response()->json($json, 200);
        } else {
            $json = [
                'message' => 'success',
                'body' => $data_dsbs,
                'status' => '1'
            ];
            return  response()->json($json, 200);
        }
    }

    public function get_alokasi_dsbs_pml(Request $request)
    {


        $data_dsbs = Dsbs::where('pencacah', $request->pencacah)
            ->join('kabs', function ($join) {
                $join->on('dsbs.kd_kab', 'kabs.id_kab');
            })
            ->join('kecs', function ($join) {
                $join->on('dsbs.kd_kab', 'kecs.id_kab')->on('dsbs.kd_kec', 'kecs.id_kec');
            })
            ->join('desas', function ($join) {
                $join->on('dsbs.kd_kab', 'desas.id_kab')->on('dsbs.kd_kec', 'desas.id_kec')->on('dsbs.kd_desa', 'desas.id_desa');
            })
            ->get()->toArray();

        if (!$data_dsbs) {
            $json = [
                'message' => 'dsbs Belum Dialokasikan',
                'status' => '0'
            ];
            return  response()->json($json, 200);
        } else {
            $json = [
                'message' => 'success',
                'body' => $data_dsbs,
                'status' => '1'
            ];
            return  response()->json($json, 200);
        }
    }
}
