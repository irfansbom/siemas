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
        $assign = User::where('email', $row[3])->first();
        if ($assign) {
            // jika dia ada di db
            $user = new User([
                'kd_wilayah' => $row[0],
                'name' =>  $row[1],
                'username' => $row[2],
                'email' => $row[3],
                'password' => Hash::make($row[4]),
                'pengawas' => $row[6],
                'created_by' => $auth->id
            ]);
        } else {
            $user = User::create([
                'kd_wilayah' => $row[0],
                'name' =>  $row[1],
                'username' => $row[2],
                'email' => $row[3],
                'password' => Hash::make($row[4]),
                'pengawas' => $row[6],
                'created_by' => $auth->id
            ]);
        }
        if (in_array($row[5], ['PENCACAH', 'PENGAWAS', 'ADMIN KABKOT', 'SUPERVISOR'])) {
            if ($assign) {
                // jika dia ada di db
                $assign->syncRoles($row[5]);
            } else {
                $user->assignRole($row[5]);
            }
        }
        return $user;
    }
}
