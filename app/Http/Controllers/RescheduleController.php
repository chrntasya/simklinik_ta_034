<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use App\Models\User;
use App\Models\JadwalDokter;
use App\Models\UserSpesialis;
use App\Notifications\RescheduleNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PendaftaranPasien;
use App\Models\Spesialis;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Notification;

class RescheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $appointment;

    public function __construct()
    {
        $this->appointment = new PendaftaranPasien();
    }
    public function index()
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
        $appointments = PendaftaranPasien::whereStatus(PendaftaranPasien::STATUS_ANTRI)
            // ->whereDate('tanggal', '>=', Carbon::yesterday()->format('Y-m-d'))
            ->with(['users','dokter'])
            ->get();

        
        $data = ['appointments' => $appointments];
        return view('pages.reschedule.index', $data);
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
        $jadwaldokter =  JadwalDokter::select('users.nama as nama_dokter', 'spesialis.nama as nama_spesialis', 'jadwal_dokter.hari', 'jadwal_dokter.waktu_mulai', 'jadwal_dokter.waktu_selesai','stok','ruangan')
        ->join('users', 'users.id', '=', 'jadwal_dokter.dokter_id')
        ->join('user_spesialis', 'user_spesialis.user_id', '=', 'users.id')
        ->join('spesialis', 'spesialis.id', '=', 'user_spesialis.spesialis_id')
        ->orderBy('users.id')->get();
        // dd($jadwaldokter);
        $spesialis = Spesialis::get();
        $data = PendaftaranPasien::findOrFail($id);
        // dd($data);
        return view('pages.reschedule.edit', compact('data','spesialis','jadwaldokter'));
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
        // dd($request);
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
        // dapatkan data spesialis terlebih dahulu 
        $dokterspesialis = UserSpesialis::where('spesialis_id',$request->spesialis_id)->select('user_id')->get();
        $dataspesialis = Spesialis::where('id',$request->spesialis_id)->first();

        for ($i=0; $i <count($dokterspesialis) ; $i++) { 
            $spesialis[$i] = $dokterspesialis[$i]->user_id;
        }

        // dapatkan tanggalnya
        $today = Carbon::parse(now())->format('Y-m-d');
        $tanggal = $request->tanggal;

        $dateToday = new DateTime(now());
        $dateTanggal = new DateTime($tanggal);
       

        //  cek apakah hari yang di pilih itu kurang dari hari ini maka tidak bisa 
        if ($today > $tanggal) {
           return back()->with('error','Tidak Bisa Memilih Tanggal Sebelum Hari Ini');
        }
        // dapatkan hari nya
        $day = $dateTanggal->format('l');
        $hari = $this->appointment->getHari($day);
        $hours = $dateToday->format('H');
        
        // ngambil data jadwal dokter yang ada hubunganya sama dokter dan hubunganya sama spesialis
        $jadwalDokter = JadwalDokter::with(['dokter.userspesialis' => function($query) use($request){
                                            $query->where('spesialis_id',$request->spesialis_id)->with('user_spesialis');
                                        }])->whereIn('dokter_id',$spesialis)->where('hari',$hari)->get();
        
        if (count($jadwalDokter) == 0) {
            return back()->with('informasi','Pelayanan Pada Tanggal dan Spesialis Tersebut Belum Tersedia');
        }
        // jika hari ini maka tidak akan bisa daftar ke dokter yang sudah masa jamnya selesei
        // cek nomor antrian dengan cara looping
        foreach ($spesialis as $key => $value) {
            $nomor = PendaftaranPasien::where('dokter_id',$value)->where('spesialis_id',$request->spesialis_id)
                     ->where('tanggal',$tanggal)->max('nomor_antrian');
           

           foreach ($jadwalDokter as  $item => $jadwal) {

               $waktuselesei = Carbon::parse($jadwal['waktu_selesai'])->format('H');
               
               // cek jika hari ini sama dengan hari pendaftaran
                if ($dateToday->format('Y-m-d') == $dateTanggal->format('Y-m-d')) {    
                                 
                   // tambahi kondisi jika pas hari h masa jamnya habis maka status berubah menjadi tidak bisa menambah
                  if ((int)$waktuselesei < (int)$hours) {
                      $jadwal['status'] = 'error waktu';
                  }else{
                      $jadwal['status'] = 'success';
                   }

               }else{
                   $jadwal['status'] = 'success';
               }

               // untuk memasukan nomor antrian terbaru
               if ($jadwal['dokter_id'] == $value) {
                   $jadwal['nomor_antrian'] = $nomor;
               }

               // untuk mengecek apakah kuota sudah penuh atau belum
               if ($jadwal['nomor_antrian'] == $jadwal->stok) {
                   $jadwal['status'] = 'error stok';
               }

           }
       }
       return view('pages.reschedule.listdokter',compact('jadwalDokter','tanggal','dataspesialis'));
        
        // try {
        //     $reschedule = PendaftaranPasien::findOrFail($id);    
        //     $reschedule->spesialis_id = $request->spesialis_id;
        //     $reschedule->tanggal = $request->tanggal;
        //     $reschedule->save();
        //     $messages['tanggal'] = $request->tanggal;
        //     $messages['spesialis'] = Spesialis::where('id',$request->spesialis_id)->first()->nama ;
        //     $user = User::find($reschedule->user_id);
        //     $mail =$user->notify(new RescheduleNotification($messages));
        //     return redirect()->route('reschedule.edit', $reschedule->id)->with('success', 'Berhasil Update');
        // } catch (\Exception $e) {
        //     // Tangani pengecualian jika data reschedule tidak ditemukan atau validasi gagal
        //     return redirect()->back()->withErrors($e->getMessage());
        // }
    }
    public function admin_reschedule(Request $request ,$id)
    {
        $userId = Auth::user()->id;
        
        // cek Roles
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        
        if ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "dokter") {
            return redirect()->route('dokter_home');
        }elseif ($cek == "apoteker") {
            return redirect()->route('apoteker_home');
        }

        // end of cek roles
        
        // cek jadwal
        $jadwal = JadwalDokter::with('dokter')->where('dokter_id',$request->dokter_id)->where('hari',$request->hari)->first();
        
        $nomor_antrian = $request->nomor_antrian + 1;
        
            $reschedule = PendaftaranPasien::findOrFail($id);    
            $reschedule->spesialis_id = $request->spesialis_id;
            $reschedule->tanggal =  Carbon::parse($request->tanggal)->format('Y-m-d');
            $reschedule->nomor_antrian = $nomor_antrian;
            $reschedule->dokter_id =$request->dokter_id;
            $reschedule->jadwal_id = $request->jadwal_id;
            $reschedule->status = 'Antri';
            $reschedule->tipe_pembayaran=$request->tipe_pembayaran;
            $reschedule->save();
            $messages['tanggal'] = Carbon::parse($request->tanggal)->format('d-m-Y');
            $messages['antrian'] = $nomor_antrian;
            $messages['spesialis'] = Spesialis::where('id',$request->spesialis_id)->first()->nama ;
            $messages['dokter'] = User::find($request->dokter_id)->nama;
            $user = User::find($reschedule->user_id);
            
            // Notification::send($user['email'],new RescheduleNotification($messages)); 
            Notification::route('mail', 'zudhapratama123@gmail.com')->notify(new RescheduleNotification($messages));

            return redirect()->route('reschedule.index')->with('success', 'Berhasil Update');

     
        
        return redirect()->route('reschedule.index')->with('success','Pendaftaran Anda Berhasil');
        

        
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
