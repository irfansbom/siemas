<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasRoles, HasFactory, Notifiable,  HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guard_name = 'siemas';
    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pml()
    {
        return $this->belongsTo(User::class, 'pengawas', 'email');
    }

    public function dsbs()
    {
        return $this->hasMany(Dsbs::class, 'pencacah', 'email');
    }
    public function dsrt()
    {
        $periode = Periode::first();
        return $this->hasMany(Dsrt::class, 'pencacah', 'email')->where('tahun', $periode->tahun)->where('semester', $periode->semester);
    }

    public function dsrt_sdh_cacah()
    {
        $periode = Periode::first();
        return $this->hasMany(Dsrt::class, 'pencacah', 'email')->where('status_pencacahan', ">=", 1)->where('tahun', $periode->tahun)->where('semester', $periode->semester);
    }

    public function mon_212()
    {
        $periode = Periode::first();
        return $this->hasMany(Laporan212::class, 'pengawas', 'email')->where('tahun', $periode->tahun)->where('semester', $periode->semester);
    }
}
