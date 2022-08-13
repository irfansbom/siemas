<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class UserImport_S1 implements
    ToModel,
    WithStartRow
// WithUpserts
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
        // try {
        // $user = new User();
        // $user->kd_wilayah = $row[0];
        // $user->name = $row[1];
        // $user->username = $row[2];
        // $user->email = $row[3];
        // $user->password = Hash::make($row[4]);
        // $user->pengawas = $row[6];
        // $user->created_by = $auth->id;
        $user =  new User([
            'kd_wilayah' => $row[0],
            'name' =>  $row[1],
            'username' => $row[2],
            'email' => $row[3],
            'password' => Hash::make($row[4]),
            'pengawas' => $row[6],
            'created_by' => $auth->id
        ]);

        $user->assignRole($row[5]);
        Log::debug($row);
        Log::debug($row[5]);
        Log::debug($user);
        Log::debug($user->assignRole($row[5]));
        // $user
        // dd($row);
        // } catch (Exception $ex) {
        //     return redirect('users')->with('error', $ex->getMessage());
        // }
        // $user->removeRole($user->roles->first());
        // $user->save();
        // $user->fresh();
        // $user->assignRole($row[5]);

        // try {
        // } catch (Throwable $e) {
        //     return redirect('users')->with('error', $e->getMessage());
        // }

        return $user;
    }
}
