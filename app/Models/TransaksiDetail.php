<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;
    protected $table = 'transaksi_detail';

    protected $fillable = [
        'transaksi_id',
        'obat_id',
        'jumlah',
        'subtotal'
    ];
   
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id', 'id');
    }


}
