<?php

namespace App\Http\Controllers;

use App\Mail\KirimNomorAntrianEmail;
use Illuminate\Http\Request;
use App\Models\JadwalDokter;
use App\Models\UserSpesialis;
use App\Models\Obat;
use App\Models\Spesialis;
use App\Models\PendaftaranPasien;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Models\UserRole;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;


class LayananController extends Controller
{

    protected $appointment;

    public function __construct()
    {
        $this->appointment = new PendaftaranPasien();
    }
    public function index()
    {
        
    }

    public function berobat()
    {
        $userId = auth()->user()->id;
     
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;

        if ($cek == "admin") {
            return redirect()->route('home');
        }elseif ($cek == "dokter") {
            return redirect()->route('dokter_home');
        }elseif ($cek == "apoteker") {
            return redirect()->route('apoteker_home');
        }

        // dd($userId);


        $daftarUser = PendaftaranPasien::with(['dokter','spesialis','jadwal'])->where('user_id',$userId)->latest()->get();
       
        $spesialis = Spesialis::get();
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
            
                                    //    dd($user->jadwal_id);
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

        // dd($daftarUser);

        return view('pages.pasien.berobat',compact('spesialis','daftarUser'));
    }

    // fungsi untuk pendaftaran pasien
    public function pasien_mendaftar(Request $request)
    {
        
        $userId = auth()->user()->id;

        // cek Roles
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        
        if ($cek == "admin") {
            return redirect()->route('home');
        }elseif ($cek == "dokter") {
            return redirect()->route('dokter_home');
        }elseif ($cek == "apoteker") {
            return redirect()->route('apoteker_home');
        }

        // end of cek roles

        // cek jadwal
        $jadwal = JadwalDokter::with('dokter')->where('dokter_id',$request->dokter_id)->where('hari',$request->hari)->first();

        $nomor_antrian = $request->nomor_antrian + 1;
        $pendaftaranPasien = PendaftaranPasien::create
            ([
                'user_id' => $userId, 
                'nomor_antrian' => $nomor_antrian, 
                'status' => 'Antri',
                'tanggal' => Carbon::parse($request->tanggal)->format('Y-m-d'),
                'tipe_pembayaran' => $request->tipe_pembayaran,
                'dokter_id' => $request->dokter_id,
                'spesialis_id' => $request->spesialis_id,
                'jadwal_id' => $request->jadwal_id
           ]);

        return redirect()->route('berobat')->with('success','Pendaftaran Anda Berhasil');
        

        
    }

    public function update_status_pendaftaran($id)
    {
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;

        if ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "dokter") {
            return redirect()->route('dokter_home');
        }

        $pendaftaran = PendaftaranPasien::where('id', $id)->update(['status' => 'sudah dilayani']);
        $data['obat'] = Obat::count();
        $data['dokter'] = UserSpesialis::count();
        $data['pasien'] = UserRole::where('role_id', 3)->count();
        $data['spesialis'] = Spesialis::count();
        return view('pages.dashboard.dashboard', $data);
    }

    
    public function pilihDokter(Request $request)
    {

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

        //  cek apakah hari yang di pilih itu untuk h-1 atau hari h atau tidak
        $selisihTanggal = $dateTanggal->diff($dateToday);
        if ($selisihTanggal->d > 0 ) {
            return back()->with('error','Hanya Bisa Memilih H-1 Hari');
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

        // dd($jadwalDokter);


        return view('pages.pasien.listdokter',compact('jadwalDokter','tanggal','dataspesialis'));
        
    }

   

   public function cancel(Request $request)
   {
        $pasien = PendaftaranPasien::findOrFail($request->id);
        $pasien->delete();
   }

   public function print($id)
   {
        $userRole = UserRole::with(['roles'])->where('user_id', auth()->user()->id)->first();
        $cek = $userRole->roles->nama;

        if ($cek == "admin") {
            return redirect()->route('home');
        }elseif ($cek == "dokter") {
            return redirect()->route('dokter_home');
        }elseif ($cek == "apoteker") {
            return redirect()->route('apoteker_home');
        }

        $pendaftaranPasien = PendaftaranPasien::with('jadwal')->where('id',$id)->first();

        $url = url('/update-status-pendaftaran/' . $pendaftaranPasien->id);
        $qrcode= QrCode::generate($url);

        $mailTo = Auth::user()->email;
        $nama = Auth::user()->nama;

        $data = [
            'nomor_antrian' => $pendaftaranPasien->nomor_antrian,
            'dokter' => $pendaftaranPasien->jadwal->dokter->nama,
            'waktu_mulai' => $pendaftaranPasien->jadwal->waktu_mulai,
            'waktu_selesai' => $pendaftaranPasien->jadwal->waktu_selesai,
            'ruangan' => $pendaftaranPasien->jadwal->ruangan,
            'qrcode' => $qrcode
        ];

        // fungsi untuk print pdf
        $pdf = FacadePdf::loadView('nomor_antrian_pdf',$data)->setPaper('a4', 'portrait');

        // fungsi untuk mengirimkan email
        Mail::to($mailTo)->send(new KirimNomorAntrianEmail($pendaftaranPasien->nomor_antrian, $pendaftaranPasien->jadwal, $qrcode, $nama));
        $pdf->set_option('setRemoteEnabled',TRUE);

        return $pdf->download('antrian.pdf');
   }
}
