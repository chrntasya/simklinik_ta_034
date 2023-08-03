<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeIcd extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $table = 'kode_icd';
    protected $fillable = [
        'kode',
        'nama_diagnosa_penyakit',
    ];
}
