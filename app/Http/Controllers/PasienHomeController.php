<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Obat;
use App\Models\PendaftaranPasien;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Roles;
use App\Models\Spesialis;
use App\Models\UserSpesialis;
use Carbon\Carbon;
use DateTime;

class PasienHomeController extends Controller
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
        }elseif ($cek == "dokter") {
            return redirect()->route('dokter_home');
        }elseif ($cek == "apoteker") {
            return redirect()->route('apoteker_home');
        }else{
            $userId = Auth::user()->id;
            $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
            $data['role'] = $userRole->roles->nama;
            $data['obat'] = Obat::count();
            $data['dokter'] = UserSpesialis::count();
            $data['pasien'] = UserRole::where('role_id', 3)->count();
            $data['spesialis'] = Spesialis::count();

            // get data antrian
            $daftarUser = PendaftaranPasien::where('status','Antri')->with(['dokter','spesialis','jadwal'])->where('user_id',$userId)->latest()->get();

            $dateToday = new DateTime(now());
            $hours = $dateToday->format('H');
            $dateToday = new DateTime(now());

            // get nomor antrian berdasarkan spesialis dan tanggal dan dokter
            // status antri dan dapatkan antrian paling
            foreach ($daftarUser as $item => $user) {
                $data = PendaftaranPasien::where('dokter_id',$user->dokter_id)
                                       ->where('spesialis_id',$user->spesialis_id)
                                       ->where('jadwal_id',$user->jadwal_id)
                                       ->where('tanggal',$user->tanggal)
                                       ->where('status','Antri')
                                       ->min('nomor_antrian');
                $waktu =  PendaftaranPasien::where('dokter_id',$user->dokter_id)
                                            ->where('spesialis_id',$user->spesialis_id)
                                            ->where('jadwal_id',$user->jadwal_id)
                                            ->where('tanggal',$user->tanggal)
                                            // ->where('status','Antri')
                                            ->with('jadwal')
                                            ->first();

                $waktuMulai = Carbon::parse($waktu->jadwal->waktu_mulai)->format('H'); 
                
                $dateTanggal = new DateTime($waktu->tanggal);

                if ($dateToday->format('Y-m-d') == $dateTanggal->format('Y-m-d')) { 
                    if ((int)$waktuMulai > (int) $hours  ) {
                        $user['status_mulai'] = 'Belum';
                    }else{
                        $user['status_mulai'] = 'Sudah';
                    }
                }else{
                    $user['status_mulai'] = 'Sudah';
                }
            
                      $user['nomor_antrian_sekarang'] = $data;
                }


            return view('pages.dashboard.pasien_dashboard', compact('data','daftarUser'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
