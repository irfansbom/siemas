<?php

namespace App\Imports;

use App\Models\Dsbs;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class DsbsImport implements
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
        return 'id_bs';
    }
    public function model(array $row)
    {
        $auth = Auth::user();
        $user = User::where('email', $row[6])->get()->first();
        if (!$user) {
            $user = new User();
        }
        $data =  new Dsbs([
            'kd_kab' => $row[0],
            'kd_kec' => $row[1],
            'kd_desa' => $row[2],
            'nbs' => $row[3],
            'id_bs' => $row[4],
            'nks' => $row[5],
            'jumlah_rt_c1' => $row[7],
            'sumber' => $row[8],
            'status' => 0,

            'pencacah' => $user->email,
            'pengawas' => $user->pengawas,
            'created_by' => $auth->id,
        ]);
        return $data;
    }
}
