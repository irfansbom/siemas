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
        return 'id_bs';
    }
    public function model(array $row)
    {
        $auth = Auth::user();
        $user = User::where('email', $row[9])->get()->first();
        if (!$user) {
            $user = new User();
        }
        $dsbs = Dsbs::where('id_bs', $row[6])->first();
        if ($dsbs) {
            $dsbs->pencacah = $user->email;
            $dsbs->pengawas = $user->pengawas;
            $dsbs->updated_by = $auth->id;
        }
        return $dsbs;
    }
    // public function onError(\Throwable $e)
    // {
    //     //
    // }
}
