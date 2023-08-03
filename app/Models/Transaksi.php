<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'kode',
        'resep_obat_id',
        'pasien_id',
        'tanggal_periksa',
        'tanggal_bayar',
        'total',
        'rekammedis_id',
        'jasa_dokter',
        'total',
        'bayar',
        'kembalian',
        'resep_obat_baru_id'
    ];

    public function resep()
    {
        return $this->belongsTo(Resep::class, 'resep_obat_id', 'id');
    }

    public function resepbaru()
    {
        return $this->belongsTo(Resep::class, 'resep_obat_baru_id', 'id');
    }

    public function rekammedis()
    {
        return $this->belongsTo(Rekamedis::class, 'rekammedis_id', 'id');
    }   
    public function pasien()
    {
        return $this->belongsTo(User::class, 'pasien_id', 'id');
    }

    
    public function transaksidetail()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }
}
