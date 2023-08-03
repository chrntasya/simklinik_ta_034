<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranPasien extends Model
{
    use HasFactory;
    public $table = 'appointments';

    const STATUS_ANTRI = 'Antri';
    const STATUS_TELAH_DIPERIKSA = 'Telah Diperiksa';
    const STATUS_BATAL = 'Dibatalkan';

    protected $fillable = [
        'user_id',
        'nomor_antrian',
        'status',
        'dokter_id',
        'tanggal',
        'tipe_pembayaran',
        'spesialis_id',
        'jadwal_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    
    public function spesialis()
    {
        return $this->belongsTo(Spesialis::class, 'spesialis_id', 'id');
    }

   
    public function jadwal()
    {
        return $this->belongsTo(JadwalDokter::class, 'jadwal_id', 'id');
    }

    public function getHari($hari)
    {
        if ($hari == 'Sunday') {
            $hari = 'minggu';
        }elseif ($hari == 'Monday') {
            $hari = 'senin';
        }elseif ($hari == 'Tuesday') {
            $hari = 'selasa';
        }elseif ($hari == 'Wednesday') {
            $hari = 'rabu';
        }elseif ($hari == 'Thursday') {
            $hari = 'kamis';
        }elseif ($hari == 'Friday') {
            $hari = 'jumat';
        }elseif ($hari == 'Saturday') {
            $hari = 'sabtu';
        }
         
        return $hari;
        
    }
}
