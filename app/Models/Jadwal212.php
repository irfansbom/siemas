<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal212 extends Model
{
    use HasFactory;
    protected $table = "jadwal_212";

    protected $fillable = [
        'tanggal'
    ];
}
