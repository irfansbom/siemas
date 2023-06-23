<?php

namespace App\Imports;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class UserImport_S1 implements
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
        return 'email';
    }
    public function model(array $row)
    {
        $auth = Auth::user();
        $kd_kab = $auth->kd_kab;
        if ($auth->hasRole(['SUPER ADMIN', 'ADMIN PROVINSI'])) {
            $kd_kab = $row[0];
        }
        $assign = User::where('email', $row[3])->first();
        if ($assign) {
            // jika dia ada di db
            $user = new User([
                'kd_kab' => $kd_kab,
                'name' =>  $row[1],
                'email' => $row[2],
                'password' => Hash::make($row[3]),
                'updated_by' => $auth->id
            ]);
        } else {
            $user = User::create([
                'kd_kab' => $kd_kab,
                'name' =>  $row[1],
                'email' => $row[2],
                'password' => Hash::make($row[3]),
                'created_by' => $auth->id
            ]);
        }
        if (in_array($row[5], ['PENCACAH', 'PENGAWAS', 'ADMIN KABKOT', 'SUPERVISOR'])) {
            if ($assign) {
                // jika dia ada di db
                $assign->syncRoles($row[4]);
            } else {
                $user->assignRole($row[4]);
            }
        }
        return $user;
    }
}
