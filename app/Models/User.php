<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $table = 'users';
    protected $fillable = [
        'username',
        'password',
        'nama',
        'email',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat_rumah',
        'nomor_telepon',
        'pekerjaan',
        'kode',
        'nominal',
        'nik'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function role_users()
    {
        return $this->hasOne('\App\Models\UserRole');
    }

   
    public function userspesialis()
    {
        return $this->hasMany(UserSpesialis::class, 'user_id');
    }

    public function jadwalTelemedicne()
    {
        return $this->hasMany(jadwalTelemedicne::class, 'dokter_id');
    }

  
}
