<?php

namespace App\Imports;

use App\Models\Dsrt;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class DsrtImport implements
    ToModel,
    WithStartRow,
    WithUpserts
{
    /**
     * @param Collection $collection
     */
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
        $data =  new Dsrt([
            'kd_kab' => $row[0],
            'id_bs' => $row[1],
            'nu_rt' => $row[2],
            'semester' => '1',
            'nama_krt' => $row[3],
            'jml_art' => $row[4],
        ]);
        return $data;
    }
}
