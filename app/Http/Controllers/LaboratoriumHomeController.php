<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Spesialis;
use App\Models\UserRole;
use App\Models\UserSpesialis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaboratoriumHomeController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        if ($cek == "admin") {
            return redirect()->route('home');
        }elseif ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "dokter") {
            return redirect()->route('dokter_home');
        }
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $data['role'] = $userRole->roles->nama;
        $data['obat'] = Obat::count();
        $data['dokter'] = UserSpesialis::count();
        $data['pasien'] = UserRole::where('role_id', 3)->count();
        $data['spesialis'] = Spesialis::count();
        return view('pages.dashboard.laboratorium_dashboard', $data);
    }
}
