<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    use HasFactory;
    public $table = 'jadwal_dokter';
    protected $fillable = [
        'dokter_id',
        'hari',
        'waktu_mulai',
        'waktu_selesai',
        'ruangan',
        'stok'
    ];

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

   
    public function pendaftaranpasien()
    {
        return $this->hasMany(PendaftaranPasien::class, 'jadwal_id');
    }
}
