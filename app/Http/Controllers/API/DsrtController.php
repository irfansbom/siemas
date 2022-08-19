<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dsrt;
use Illuminate\Http\Request;

class DsrtController extends Controller
{
    //



    public function get_alokasi_dsrt_pcl(Request $request)
    {
        $request->validate([
            'pencacah' => ['required']
        ]);

        $data_dsrt = Dsrt::where('pencacah', $request->pencacah)
            ->join('desas', function ($join) {
                $join->on('bs.id_kab', 'desas.id_kab')
                    ->on('bs.id_kec', 'desas.id_kec')
                    ->on('bs.id_desa', 'desas.id_desa');
            })
            ->join('kecs', function ($join) {
                $join->on('bs.id_kab', 'kecs.id_kab')
                    ->on('bs.id_kec', 'kecs.id_kec');
            })
            ->join('kabs', function ($join) {
                $join->on('bs.id_kab', 'kabs.id_kab');
            })
            ->get()->toArray();;

        if (!$data_dsrt) {
            $json = [
                'message' => 'DSRT Belum Dialokasikan',
                'status' => '0'
            ];
            return  response()->json($json, 200);
        } else {
            $json = [
                'message' => 'success',
                'body' => $data_dsrt,
                'status' => '1'
            ];
            return  response()->json($json, 200);
        }
    }

    public function get_alokasi_dsrt_pml(Request $request)
    {
        $request->validate([
            'pengawas' => ['required']
        ]);

        $data_dsrt = Dsrt::where('pencacah', $request->pencacah)
            ->join('desas', function ($join) {
                $join->on('bs.id_kab', 'desas.id_kab')
                    ->on('bs.id_kec', 'desas.id_kec')
                    ->on('bs.id_desa', 'desas.id_desa');
            })
            ->join('kecs', function ($join) {
                $join->on('bs.id_kab', 'kecs.id_kab')
                    ->on('bs.id_kec', 'kecs.id_kec');
            })
            ->join('kabs', function ($join) {
                $join->on('bs.id_kab', 'kabs.id_kab');
            })
            ->get()->toArray();;

        if (!$data_dsrt) {
            $json = [
                'message' => 'DSRT Belum Dialokasikan',
                'status' => '0'
            ];
            return  response()->json($json, 200);
        } else {
            $json = [
                'message' => 'success',
                'body' => $data_dsrt,
                'status' => '1'
            ];
            return  response()->json($json, 200);
        }
    }
}
