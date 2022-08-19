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
