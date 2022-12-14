<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dsrt extends Model
{
    use HasFactory;
    protected $table = 'dsrt';
    protected $guarded = [];

    public function dsbs()
    {
        return $this->belongsTo(Dsbs::class, 'id_bs', 'id_bs');
    }

    public function pcl()
    {
        return $this->belongsTo(User::class, 'pencacah', 'email');
    }

    public function pms()
    {
        return $this->belongsTo(User::class, 'pengawas', 'email');
    }
}
