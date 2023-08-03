<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTelemedicine extends Model
{
    use HasFactory;
    protected $table = 'jadwal_telemedicines';
    protected $fillable = [
        'dokter_id',
        'hari',
        'waktu_mulai',
        'waktu_selesai',
        'stok',
        'nominal',
        'spesialis_id'
    ];

  
    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id','id');
    }

   
    public function spesialis()
    {
        return $this->belongsTo(Spesialis::class, 'spesialis_id', 'id');
    }

}
