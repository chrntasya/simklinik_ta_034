<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorium extends Model
{
    use HasFactory;
    protected $table = 'laboratoria';

    protected $fillable = [
        'rujukan_id',
        'file',
        'deskripsi'
    ];

   
    public function rujukan()
    {
        return $this->belongsTo(RujukanLab::class, 'rujukan_id', 'id');
    }
}
