<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiTelemedicine extends Model
{
    use HasFactory;
    protected $table = 'transaksi_telemedicine';
    protected $fillable = [
        'pasien_id',
        'jadwaltelemedicine_id',
        'dokter_id',
        'spesialis_id',
        'jam_mulai',
        'jam_akhir',
        'tanggal',
        'nominal',
        'status',
        'bukti_pembayaran',
        'nomor_antrian',
        'resepobattelemedicine_id',
        'status_pengambilan_resep',
        'jenis_pengambilan',
        'alamat_pengambilan',
        'keterangan'
    ];
    
  
    public function pasien()
    {
        return $this->belongsTo(User::class, 'pasien_id', 'id');
    }

  
    public function jadwaltelemedicine()
    {
        return $this->belongsTo(JadwalTelemedicine::class, 'jadwaltelemedicine_id', 'id');
    }
   
     public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id', 'id');
    }

 
    public function spesialis()
    {
        return $this->belongsTo(Spesialis::class, 'spesialis_id', 'id');
    }

    public function resepobattelemedicine()
    {
        return $this->belongsTo(ResepObat::class, 'resepobattelemedicine_id', 'id');
    }

}
