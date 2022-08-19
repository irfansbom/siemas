<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dsrt;
use Illuminate\Http\Request;

class DsrtApiController extends Controller
{
    //
    public function get_alokasi_dsrt_pcl(Request $request)
    {
        

        $data_dsrt = Dsrt::where('pencacah', $request->pencacah)
            ->get()->toArray();

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
        

        $data_dsrt = Dsrt::where('pencacah', $request->pencacah)
            ->get()->toArray();

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
