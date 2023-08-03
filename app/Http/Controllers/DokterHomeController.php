<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Roles;
use App\Models\Spesialis;
use App\Models\UserSpesialis;
use App\Models\JadwalDokter;
use App\Http\Requests\JadwalDokterRequest;
use App\Models\PendaftaranPasien;
use Illuminate\Support\Facades\Auth;

class DokterHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        if ($cek == "admin") {
            return redirect()->route('home');
        }elseif ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "apoteker") {
            return redirect()->route('apoteker_home');
        }
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $data['role'] = $userRole->roles->nama;
        $data['obat'] = Obat::count();
        $data['dokter'] = UserSpesialis::count();
        $data['pasien'] = UserRole::where('role_id', 3)->count();
        $data['spesialis'] = Spesialis::count();
        return view('pages.dashboard.dokter_dashboard', $data);
    }

    public function jadwal_dokter()
    {
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        if ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "dokter") {
            return redirect()->route('dokter_home');
        }elseif ($cek == "apoteker") {
            return redirect()->route('apoteker_home');
        }
        
        $data['jadwalSenin'] = JadwalDokter::with(['dokter'])->where('hari', 'senin')->get();
        $data['jadwalSelasa'] = JadwalDokter::with(['dokter'])->where('hari', 'selasa')->get();
        $data['jadwalRabu'] = JadwalDokter::with(['dokter'])->where('hari', 'rabu')->get();
        $data['jadwalKamis'] = JadwalDokter::with(['dokter'])->where('hari', 'kamis')->get();
        $data['jadwalJumat'] = JadwalDokter::with(['dokter'])->where('hari', 'jumat')->get();
        $data['jadwalSabtu'] = JadwalDokter::with(['dokter'])->where('hari', 'sabtu')->get();
        $data['jadwalMinggu'] = JadwalDokter::with(['dokter'])->where('hari', 'minggu')->get();

        return view('pages.dokter.jadwal', $data);
    }

    public function form_jadwal_dokter()
    {
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        if ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "dokter") {
            return redirect()->route('dokter_home');
        }elseif ($cek == "apoteker") {
            return redirect()->route('apoteker_home');
        }

        $role = Roles::where('nama', 'dokter')->first();
        $spesialis = Spesialis::all();
        $dokter = UserRole::with(['users', 'roles'])->where('role_id', $role->id)->get();

        return view('pages.dokter.create_jadwal', compact('dokter'));
    }

    public function delete_jadwal_dokter($id)
    {

        $count = PendaftaranPasien::where('jadwal_id',$id)->count();

        if ($count > 0) {
            return redirect()->back()->with("error", "Hapus data tidak berhasil, karena  sudah digunakan di Appointment");
        }
        $jadwal = JadwalDokter::findOrFail($id);
        $jadwal->delete();
        return redirect()->back()->with("success", "Hapus data berhasil");
    }

    public function buat_jadwal_dokter(JadwalDokterRequest $request)
    {
        $jadwal = JadwalDokter::create($request->all());

        return redirect()->route('jadwal_dokter')->with("success", "Buat data berhasil");
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

  
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
