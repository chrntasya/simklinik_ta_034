<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RujukanLab extends Model
{
    use HasFactory;

    public $table = 'rujukan';
    protected $fillable = [
        'kode',
        'jenis_pemeriksaan',
        'pasien_id',
        'dokter_id',
        'tempat_rujukan_id',
        'rekamedis_id',
        'tglberkunjung',
    ];

    // public function pasien()
    // {
    //     return $this->belongsTo(User::class, 'pasien_id');
    // }

    // public function dokter()
    // {
    //     return $this->belongsTo(User::class, 'dokter_id');
    // }
    public function rekamedis()
    {
        return $this->belongsTo(Rekamedis::class, 'rekamedis_id');
    }


    public function dokterspesialis()
    {
        return $this->belongsTo(UserSpesialis::class, 'dokter_id', 'user_id');
    }

    public function tempatRujukan()
    {
        return $this->belongsTo(TempatRujukan::class, 'tempat_rujukan_id');
    }
}
