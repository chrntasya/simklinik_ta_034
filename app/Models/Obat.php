<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KategoriObat;

class Obat extends Model
{
    use HasFactory;
    public $table = 'obat';
    protected $fillable = [
        'kode',
        'kategori_obat_id',
        'nama',
        'satuan',
        'dosis',
        'harga',
        'tanggal_produksi',
        'tanggal_kadaluarsa',
        'stok',
        'keterangan',
        'lokasi'
    ];

    public function kategori_obat()
    {
        return $this->belongsTo(KategoriObat::class, 'kategori_obat_id');
    }
}
