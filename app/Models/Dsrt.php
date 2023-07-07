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

    public function pml()
    {
        return $this->belongsTo(User::class, 'pengawas', 'email');
    }

    public function art()
    {
        return $this->hasMany(Dsart::class, 'id_bs', 'id_bs')
            ->where('nu_rt', $this->nu_rt)
            ->where('tahun', $this->tahun)
            ->where('semester', $this->semester);
    }


    public function kabs()
    {
        return $this->belongsTo(Kabs::class, 'kd_kab', 'id_kab');
    }
}
