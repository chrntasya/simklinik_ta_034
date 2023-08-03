<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekamedis extends Model
{
    use HasFactory;
    public $table = 'rekamedis';
    protected $fillable = [
        'tanggal_pendaftaran',
        'diagnosa',
        'tindakan',
        'pasien_id',
        'dokter_id',
        'suratketerangan',
        'resep_obat_id',
        'resep_obat_baru_id'
    ];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'pasien_id');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'rekammedis_id');
    }

    public function resepobat()
    {
        return $this->belongsTo(ResepObat::class, 'resep_obat_id');
    }

    public function resepobatbaru()
    {
        return $this->belongsTo(ResepObat::class, 'resep_obat_baru_id');
    }

    public function rujukans()
    {
        return $this->hasMany(RujukanLab::class, 'rekamedis_id');
    }

    
}
