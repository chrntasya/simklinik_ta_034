<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSpesialis extends Model
{
 
    public $table = 'user_spesialis';
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'spesialis_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function user_spesialis()
    {
        return $this->belongsTo(Spesialis::class, 'spesialis_id');
    }
}
