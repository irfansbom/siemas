<?php

namespace App\Imports;

use App\Models\Dsbs;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Throwable;

class AlokasiDsbsImport implements
    // SkipsOnError,
    ToModel,
    WithStartRow,
    WithUpserts
{

    public function startRow(): int
    {
        return 2;
    }
    public function uniqueBy()
    {
        return ['tahun', 'semester', 'kd_kab', 'kd_kec', 'kd_desa', 'kd_bs'];
    }

    public function model(array $row)
    {
        $auth = Auth::user();
        $periode = Periode::first();
        if (strlen($row[2]) != 2) {
            return null;
        }
        if (strlen($row[3]) != 3) {
            return null;
        }
        if (strlen($row[4]) != 3) {
            return null;
        }
        if (strlen($row[5]) != 6) {
            return null;
        }
        $pcl = "";
        $pml = "";
        $pencacah = User::where('email', $row[8])->get()->first();
        if ($pencacah) {
            $pcl = $pencacah->email;
        }
        // dd(penc);
        $pengawas = User::where('email', $row[9])->get()->first();
        if ($pengawas) {
            $pml = $pengawas->email;
        }

        $bs = Dsbs::where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('kd_kab', $row[2])
            ->where('kd_kec',  $row[3])
            ->where('kd_desa', $row[4])
            ->where('kd_bs', $row[5])
            ->first();

        if ($bs) {
            // $data =  new Dsbs([
            //     'tahun' => $periode->tahun,
            //     'semester' => $periode->semester,
            //     'kd_kab' => $row[2],
            //     'kd_kec' => $row[3],
            //     'kd_desa' => $row[4],
            //     'kd_bs' => $row[5],
            //     'nks' => $row[5],
            //     'pencacah' => $pcl,
            //     'pengawas' => $pml,
            //     'updated_by' => $auth->id,
            // ]);
            $bs->pencacah = $pcl;
            $bs->pengawas = $pml;
            $bs->updated_by = $auth->id;

            return $bs;
        }
        return null;
    }
    public function onError(Throwable $e)
    {
        return redirect()->back()->with('error',  $e->getMessage());
    }
}
