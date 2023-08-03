<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesialis extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $table = 'spesialis';
    protected $fillable = [
        'kode',
        'nama',
    ];

    
    public function transactiontelemedicine()
    {
        return $this->hasMany(TransaksiTelemedicine::class, 'spesialis_id');
    }
}
