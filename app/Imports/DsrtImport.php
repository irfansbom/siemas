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
    private $semester;
    public function __construct(Request $request)
    {
        $this->semester = $request->semester;
        // dd($this->kab);
    }
    public function startRow(): int
    {
        return 2;
    }
    public function uniqueBy()
    {
        return ['id_bs', 'nu_rt', 'semester'];
    }
    public function model(array $row)
    {
        $auth = Auth::user();
        $dsbs = Dsbs::where('id_bs', $row[8])->get()->first();
        $data =  new Dsrt([
            'kd_kab' => $row[3],
            'id_bs' => $row[8],
            'nks' => $row[13],
            'nu_rt' => $row[52],
            'semester' => $this->semester,
            'nama_krt' => $row[29],
            'jml_art' => '0',
            'pencacah' => $dsbs->pcl->email,
            'pengawas' => $dsbs->pcl->pengawas,
        ]);
        return $data;
    }
    public function onError(\Throwable $e)
    {
        return redirect()->back()->with('error', "Terjadi Kesalahan" . $e);
    }
}
