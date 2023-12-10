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
    private $tahun;
    private $semester;
    public function __construct(Request $request)
    {
        $this->tahun = $request->tahun;
        $this->semester = $request->semester;
    }
    public function startRow(): int
    {
        return 2;
    }
    public function uniqueBy()
    {
        return ['tahun', 'semester', 'kd_kab', 'kd_kec', 'kd_desa', 'kd_bs', 'nu_rt'];
    }
    public function model(array $row)
    {
        $auth = Auth::user();
        if ($row['53'] == 1) {
            return null;
        }

        $dsbs = Dsbs::where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->where('kd_kab', $row[3])
            ->where('kd_kec', $row[4])
            ->where('kd_desa', $row[5])
            ->where('kd_bs', $row[6])
            ->get()
            ->first();

        if (!$dsbs) {
            return null;
        }

        $dsrt =  Dsrt::where('tahun', $this->tahun)
            ->where('semester', $this->semester)
            ->where('kd_kab', $row[3])
            ->where('kd_kec', $row[4])
            ->where('kd_desa', $row[5])
            ->where('kd_bs', $row[6])
            ->where('nu_rt', $row[54])
            ->get()
            ->first();

        $nama_krt = $row[30]; //kolom r503
        if ($row[38]) {
            $nama_krt = $row[38];
        }
        if ($dsrt) {
            // jika sudah ada di dsbs
            $data =  new Dsrt([
                'tahun' => $this->tahun,
                'semester' => $this->semester,
                'kd_kab' => $row[3],
                'kd_kec' => $row[4],
                'kd_desa' => $row[5],
                'kd_bs' => $row[6],
                'id_bs' => '16' . $row[3] . $row[4] . $row[5] . $row[6],
                'nks' => $row[13],
                'nu_rt' => $row[54], //kolom nus_ssn
                'nama_krt_prelist' => $nama_krt,
                'jml_art_prelist' => '1',
                'pencacah' => $dsbs->pencacah,
                'pengawas' => $dsbs->pengawas,
                'flag_active' => $dsbs->flag_active,
                'updated_by' => $auth->id
            ]);
        } else {
            $data = Dsrt::create([
                'tahun' => $this->tahun,
                'semester' => $this->semester,
                'kd_kab' => $row[3],
                'kd_kec' => $row[4],
                'kd_desa' => $row[5],
                'kd_bs' => $row[6],
                'id_bs' => '16' . $row[3] . $row[4] . $row[5] . $row[6],
                'nks' => $row[13],
                'nu_rt' => $row[54], //kolom nus_ssn
                'nama_krt_prelist' => $nama_krt,
                'jml_art_prelist' => '1',
                'pencacah' => $dsbs->pencacah,
                'pengawas' => $dsbs->pengawas,
                'flag_active' => $dsbs->flag_active,
                'created_by' => $auth->id
            ]);
        }
        return $data;
    }
    public function onError(\Throwable $e)
    {
        return redirect()->back()->with('error', "Terjadi Kesalahan" . $e);
    }
}
