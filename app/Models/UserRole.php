<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Roles;

class UserRole extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $table = 'user_roles';
    protected $fillable = [
        'user_id',
        'role_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function roles()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }
}
