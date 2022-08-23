<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dsbs extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function pcl()
    {
        return $this->belongsTo(User::class, 'pencacah', 'email');
    }
}
