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

class DsbsImport implements
    // WithMappedCells,
    SkipsOnError,
    ToModel,
    WithStartRow,
    WithUpserts
{
    private $kab;
    public function __construct(Request $request)
    {
        $this->kab = $request->kab;
        // dd($this->kab);
    }

    public function startRow(): int
    {
        return 10;
    }
    public function uniqueBy()
    {
        return 'id_bs';
    }
    public function model(array $row)
    {
        $auth = Auth::user();
        $user = User::where('email', $row[11])->get()->first();
        // dd($user);
        if (!$user) {
            $user = new User();
        }
        $data =  new Dsbs([
            'kd_kab' => $this->kab,
            'kd_kec' => $row[1],
            'kecamatan' => $row[2],
            'kd_desa' => $row[3],
            'desa' => $row[4],
            'klas' => $row[5],
            'nbs' => $row[6],
            'id_bs' => '16' . $this->kab . $row[1] . $row[3] . $row[6],
            'nks' => $row[7],
            'jumlah_rt_c1' => $row[8],
            'sls_2020' => $row[9],
            'sls_wilkerstat' => $row[10],
            'status' => 0,
            'pencacah' => $user->email,
            'pengawas' => $user->pengawas,
            'created_by' => $auth->id,
        ]);
        return $data;
    }

    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }
}
