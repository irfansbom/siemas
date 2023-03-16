<?php

namespace App\Imports;

use App\Models\Dsbs;
use App\Models\Dsrt;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class DsrtImport implements
    SkipsOnError,
    ToModel,
    WithStartRow,
    WithUpserts
{
    /**
     * @param Collection $collection
     */
    private $tahun;
    private $semester;
    public function __construct(Request $request)
    {
        $this->tahun = $request->tahun;
        $this->semester = $request->semester;
        // dd($this->kab);
    }
    public function startRow(): int
    {
        return 2;
    }
    public function uniqueBy()
    {
        return ['id_bs', 'tahun', 'semester', 'nu_rt'];
    }
    public function model(array $row)
    {
        $auth = Auth::user();
        if ($row['53'] == 1) {
            $dsbs = Dsbs::where('id_bs', $row[8])
                ->where('tahun', $this->tahun)
                ->where('semester', $this->semester)
                ->get()
                ->first();

            $nama_krt = $row[30];

            if ($row[38]) {
                $nama_krt = $row[38];
            }

            // dd($row[30]);
            if ($dsbs) {
                $data =  new Dsrt([
                    'kd_kab' => $row[3],
                    'id_bs' => $row[8],
                    'nks' => $row[13],
                    'tahun' => $this->tahun,
                    'semester' => $this->semester,
                    'nu_rt' => $row[54],
                    'nama_krt' => $nama_krt,
                    'jml_art' => '1',
                    'pencacah' => $dsbs->pcl->email,
                    'pengawas' => $dsbs->pcl->pengawas,
                    'dummy_dsrt' => $dsbs->dummy,
                ]);
                return $data;
            }
            return null;
        }
        return null;
    }
    public function onError(\Throwable $e)
    {
        return redirect()->back()->with('error', "Terjadi Kesalahan" . $e);
    }
}
