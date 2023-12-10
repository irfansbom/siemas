<?php

namespace App\Imports;

use App\Models\Dsbs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Throwable;

class DsbsImport implements
    SkipsOnError,
    ToModel,
    WithStartRow,
    WithUpserts
{
    private $kab;
    private $tahun;
    private $semester;
    public function __construct(Request $request)
    {
        $this->kab = $request->kab;
        $this->tahun = $request->tahun;
        $this->semester = $request->semester;
    }

    public function startRow(): int
    {
        return 10;
    }
    public function uniqueBy()
    {
        return ['tahun', 'semester', 'kd_kab', 'kd_kec', 'kd_desa', 'kd_bs'];
    }
    public function model(array $row)
    {
        $auth = Auth::user();
        if (strlen($row[1]) != 3) {
            return null;
        }
        if (strlen($row[3]) != 3) {
            return null;
        }
        if (strlen($row[6]) != 4) {
            return null;
        }
        $bs = Dsbs::where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->where('kd_kab', $this->kab)
            ->where('kd_kec',  $row[1])
            ->where('kd_desa', $row[3])
            ->where('kd_bs', $row[6])
            ->first();

        if ($bs) {
            $data =  new Dsbs([
                'tahun' => $this->tahun,
                'semester' => $this->semester,
                'kd_kab' => $this->kab,
                'kd_kec' => $row[1],
                'kd_desa' => $row[3],
                'kd_bs' => $row[6],
                'id_bs' => '16' . $this->kab . $row[1] . $row[3] . $row[6],
                'nks' => $row[7],
                'sls' => trim($row[9], '  '),
                'jml_rt' => $row[8],
                'updated_by' => $auth->id,
            ]);
        } else {
            $data = Dsbs::create([
                'tahun' => $this->tahun,
                'semester' => $this->semester,
                'kd_kab' => $this->kab,
                'kd_kec' => $row[1],
                'kd_desa' => $row[3],
                'kd_bs' => $row[6],
                'id_bs' => '16' . $this->kab . $row[1] . $row[3] . $row[6],
                'nks' => $row[7],
                'sls' => trim($row[9], '  '),
                'jml_rt' => $row[8],
                'created_by' => $auth->id,
            ]);
        }
        return $data;
    }

    public function onError(Throwable $e)
    {
        return redirect()->back()->with('error',  $e->getMessage());
    }
}
