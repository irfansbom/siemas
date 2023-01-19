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
        return ['id_bs','tahun','semester'];
    }
    public function model(array $row)
    {
        $auth = Auth::user();
        $user = User::where('email', $row[11])->get()->first();
        // dd($user);
        if (!$user) {
            $user = new User();
        }

        if ($row[4] == null) {
            return null;
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
            'tahun' => $this->tahun,
            'semester' => $this->semester,
            'jml_rt' => $row[8],
            'sls' => trim($row[9],'  '),
            'sls_wilkerstat' => '[' .trim( $row[11],' ') . '] ' . trim($row[12],'  '),
            'status' => 0,
            'pencacah' => $user->email,
            'pengawas' => $user->pengawas,
            'created_by' => $auth->id,
        ]);
        return $data;
    }

    public function onError(\Throwable $e)
    {
        // dd($e);
        return redirect()->back()->with('error',  $e->getMessage());
        // print_r($e);
        // Handle the exception how you'd like.
    }
}
