<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    use HasFactory;
    protected $guarded= ['id'];

    public $table = 'resep_obats';
    protected $fillable = [
        'kode',
        'tanggal_resep',
        'status'
    ];

    public function resepobatdetails()
    {
        return $this->hasMany(ResepObatDetail::class, 'id_resep_obat');
    }

 
    public function transaksitelemedicine()
    {
        return $this->hasOne(TransaksiTelemedicine::class, 'resepobattelemedicine_id');
    }
}
