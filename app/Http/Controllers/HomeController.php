<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Roles;
use App\Models\Spesialis;
use App\Models\UserSpesialis;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Traits\Cek;

class HomeController extends Controller
{
    
    public function __construct()
    {
        
        $this->middleware('auth'); 
    }

  
    public function index()
    {
        // $status=$this->cekRoleAdmin(Auth::user()->id);
        // if ($status == false) {
        //     return redirect()->route('pasien_home');
        // }
        
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        if ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "dokter") {
            return redirect()->route('dokter_home');
        }elseif ($cek == "apoteker") {
            return redirect()->route('apoteker_home');
        }else{
            $data['obat'] = Obat::count();
            $data['dokter'] = UserSpesialis::count();
            $data['pasien'] = UserRole::where('role_id', 3)->count();
            $data['spesialis'] = Spesialis::count();
            return view('pages.dashboard.dashboard', $data);
        }
        
    }


    public function notification() {
        $expired = auth()->user()->unreadNotifications;

        return response()->json([
            'notification' => $expired
        ]);
    }

    public function deletenotification(){
        foreach (auth()->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return back();
    }
}
