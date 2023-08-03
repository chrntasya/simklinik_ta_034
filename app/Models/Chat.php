<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $table = 'chats';
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'transaction_telemedicine_id'
    ];

    
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
   
    public function transaksitelemedicine()
    {
        return $this->belongsTo(TransaksiTelemedicine::class, 'transaction_telemedicine_id', 'id');
    }
     
}
