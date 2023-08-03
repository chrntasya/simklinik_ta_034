<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepObatDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $table = 'resep_obat_details';

    protected $fillable = [        
        'jumlah_obat',
        'id_obat',
        'id_resep_obat',
    ];

    public function resepobat()
    {
        return $this->belongsTo(ResepObat::class, 'id_resep_obat');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
