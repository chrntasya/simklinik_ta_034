<?php
namespace App\Helpers\Traits;

use App\Models\UserRole;
trait Cek
{
    function cekRoleAdmin($role)
    {      
        $userRole = UserRole::with(['roles'])->where('user_id', $role)->first();
        $cek = $userRole->roles->nama;
        if ($cek == "pasien") 
        {
            return false;
        }
    }
}