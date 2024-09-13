<?php

namespace App\Imports;

use App\Models\Webmons;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class WebMonImport implements
    SkipsOnError,
    ToModel,
    WithStartRow,
    WithUpserts
{
    public function startRow(): int
    {
        return 4;
    }
    public function uniqueBy()
    {
        return ['kd_kab'];
    }
    public function model(array $row)
    {
        return new Webmons([
            'kd_kab' => ($row[0] == 'Total') ? '00' : substr($row[0], 3, 2),
            'target_ruta' => ($row[1] == '-') ? NULL : str_replace('.', '', $row[1]),
            'jml_sudah' => ($row[2] == '-') ? NULL : str_replace('.', '', $row[2]),
            'persen_sudah' => ($row[3] == '-') ? NULL : str_replace(',', '.', $row[3]),
            'jml_belum' => ($row[4] == '-') ? NULL : str_replace('.', '', $row[4]),
            'persen_belum' => ($row[5] == '-') ? NULL : str_replace(',', '.', $row[5])
        ]);
    }
    public function onError(\Throwable $e)
    {
        return redirect()->back()->with('error', "Terjadi Kesalahan" . $e);
    }
}
