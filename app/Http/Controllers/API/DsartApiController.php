<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dsart;
use App\Models\Dsbs;
use App\Models\Periode;
use Illuminate\Http\Request;

class DsartApiController extends Controller
{
    //
    public function get_dsart_pcl(Request $request)
    {
        $periode = Periode::get()->first();
        $dsbs = Dsbs::select('id')
            ->where('pencacah', $request->pencacah)
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->get()
            ->toArray();
        $dsart = Dsart::wherein('id', $dsbs)->get()->toArray();
        if (!$dsart) {
            $json = [
                'message' => 'DSART Belum ada',
                'status' => '0'
            ];
            return  response()->json($json, 200);
        } else {
            $json = [
                'message' => 'success',
                'body' => $dsart,
                'status' => '1'
            ];
            return  response()->json($json, 200);
        }
    }

    public function get_dsart_pml(Request $request)
    {
        $periode = Periode::get()->first();
        $dsbs = Dsbs::select('id')->where('pengawas', $request->pengawas)
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->get()->toArray();
        $dsart = Dsart::wherein('id', $dsbs)->get()->toArray();
        if (!$dsart) {
            $json = [
                'message' => 'DSART Belum ada',
                'status' => '0'
            ];
            return  response()->json($json, 200);
        } else {
            $json = [
                'message' => 'success',
                'body' => $dsart,
                'status' => '1'
            ];
            return  response()->json($json, 200);
        }
    }

    public function upload_dsart(Request $request)
    {

        $dsart = json_decode($request->dsart);

        $affectedDsrt = Dsart::updateOrCreate(
            [
                'tahun' => $dsart->tahun,
                'semester' => $dsart->semester,
                'kd_kab' => $dsart->kd_kab,
                'kd_kec' => $dsart->kd_kec,
                'kd_desa' => $dsart->kd_desa,
                'kd_bs' => $dsart->kd_bs,
                'nu_rt' => $dsart->nu_rt,
                'nu_art' => $dsart->nu_art
            ],
            [
                'id_bs' => '16' . $dsart->kd_kab . $dsart->kd_kec . $dsart->kd_desa . $dsart->kd_bs,
                'nks' => $dsart->nks,
                'nama_art' => $dsart->nama_art,
                'pendidikan' => $dsart->pendidikan,
                'pekerjaan' => $dsart->pekerjaan,
                'pendapatan' => $dsart->pendapatan
            ]
        );

        if (($affectedDsrt)) {
            $json = [
                'message' => 'success',
                'status' => '1'
            ];
            return response()->json($json, 200);
        }
    }
}
