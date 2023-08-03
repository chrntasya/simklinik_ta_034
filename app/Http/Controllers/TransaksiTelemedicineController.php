<?php

namespace App\Http\Controllers;

use App\Models\JadwalTelemedicine;
use App\Models\PendaftaranPasien;
use App\Models\Spesialis;
use App\Models\TransaksiTelemedicine;
use App\Models\UserSpesialis;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransaksiTelemedicineController extends Controller
{
    protected $appointment;

    public function __construct()
    {
        $this->appointment = new PendaftaranPasien();
    }
    
    public function index()
    {
        $spesialis = Spesialis::get();
        return view('pages.pasien_transaksi_telemedicine.index',[
            'spesialis' => $spesialis
        ]);
    }

    public function listDokter(Request $request)
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
        //   if ($selisihTanggal->d > 0 ) {
        //       return back()->with('error','Hanya Bisa Memilih H-1 Hari');
        //   }
  
          // dapatkan hari nya
          $day = $dateTanggal->format('l');
          $hari = $this->appointment->getHari($day);
          $hours = $dateToday->format('H');
          
          // ngambil data jadwal dokter yang ada hubunganya sama dokter dan hubunganya sama spesialis
          $jadwalDokter = JadwalTelemedicine::with(['dokter.userspesialis' => function($query) use($request){
                                              $query->where('spesialis_id',$request->spesialis_id)->with('user_spesialis');
                                          }])->where('spesialis_id',$request->spesialis_id)->whereIn('dokter_id',$spesialis)->where('hari',$hari)->get();
          
          if (count($jadwalDokter) == 0) {
              return back()->with('informasi','Pelayanan Pada Tanggal dan Spesialis Tersebut Belum Tersedia');
          }
          
          // jika hari ini maka tidak akan bisa daftar ke dokter yang sudah masa jamnya selesei
          // cek nomor antrian dengan cara looping
          foreach ($spesialis as $key => $value) {
               $nomor = TransaksiTelemedicine::where('dokter_id',$value)->where('spesialis_id',$request->spesialis_id)
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
  
          
  
  
          return view('pages.pasien_transaksi_telemedicine.listdokter',compact('jadwalDokter','tanggal','dataspesialis'));
    }


    public function daftarTelemedicine(Request $request)
    {
        $data = $request->all();

        $dokter = JadwalTelemedicine::with('dokter.userspesialis')
                        ->with('spesialis')
                        ->where('id',$request->jadwal_id)
                        ->where('dokter_id',$request->dokter_id)
                        ->where('spesialis_id',$request->spesialis_id)
                        ->where('hari',$request->hari)->first();

        
        $waktu_mulai = strtotime($request->tanggal . $dokter->waktu_mulai);
        $waktu_selesai = strtotime($request->tanggal . $dokter->waktu_selesai);
        
        $diff = $waktu_selesai - $waktu_mulai;          
        $jam = floor($diff / (60 * 60));
        $menit = $diff - $jam * (60 * 60);
        $generateJam = $menit/3600;
        $totalwaktu = $jam + $generateJam;
        

        $nominal = $totalwaktu * $dokter->nominal;
        
        $data = TransaksiTelemedicine::create([
            'pasien_id' => auth()->user()->id,
            'jadwaltelemedicine_id' => $request->jadwal_id,
            'dokter_id' => $request->dokter_id,
            'spesialis_id' => $request->spesialis_id,
            'jam_mulai' => $dokter->waktu_mulai,
            'jam_akhir' => $dokter->waktu_selesai,
            'tanggal' => $request->tanggal,
            'nominal' => $nominal,
            'status' => 'Belum Terbayar',            
            'nomor_antrian' => ($request->nominal  ? $request->nominal : 0 ) + 1
        ]);

        
        
        return redirect()->route('pasien.transactiontelemedicine.index')->with('sukses','Data Berhasil Di Tambahkan');

    }

    public function transaksiTelemedicine(Request $request)
    {
        
       

       
                  
    }


    // =============================================== HISTORY TRANSACTION ====================================== 
    public function transactionTelemedicine()
    {
        $history = TransaksiTelemedicine::with(['dokter','spesialis','jadwaltelemedicine'])->where('pasien_id',auth()->user()->id)->get();

        
        // tanggal sekarang
        $tanggalNow = Carbon::parse(now())->format('Y-m-d');
        $jamNow = Carbon::parse(now())->format('H:i');

        // jamsekarang


        foreach ($history as $item =>   $value) {
            if ($value->status == 'Terverifikasi') {
                if ($value->tanggal == $tanggalNow) {                
                    $value['status_tanggal'] = 'success';
    
                    $waktu_mulai = strtotime($value->tanggal . $value->jam_mulai);
                    $waktu_selesai = strtotime($value->tanggal . $value->jam_akhir);
                    $waktu_now = strtotime($value->tanggal . $jamNow);
                    if ($waktu_now > $waktu_mulai && $waktu_now < $waktu_selesai) {
                        $value['status_waktu'] = 'success';    
                    }else{
                        $value['status_waktu'] = 'error';    
                    }
    
                }else{
                    $value['status_tanggal'] = 'error';
                    $value['status_waktu'] = 'error';
                }
            }
         
        }
     
        return view('pages.pasien_transaksi_telemedicine.history_transaksi.index',[
            'history' => $history
        ]);
    }

    public function uploadBuktiPembayaran(Request $request)
    {
        $img = $request->file('bukti_pembayaran');

        if ($img) { 
            // dd($img);                
            $dataFoto =$img->getClientOriginalName();
            $waktu = time();
            $name = $waktu.$dataFoto;
            $nameFile = Storage::putFileAs('bukti_pembayaran',$img,$name);            
            $nameFile = $name;

            TransaksiTelemedicine::where('id',$request->id)->update([
                'bukti_pembayaran' => $nameFile,
                'status' => 'Telah Dibayar'
            ]);
        }

        return back();
    }

    public function deleteBukti(Request $request)
    {
        $image = TransaksiTelemedicine::where('id',$request->id)->first();
        if ($image->bukti_pembayaran) {
            Storage::disk('public')->delete($image->bukti_pembayaran);  
        }

        $image->update([
            'bukti_pembayaran' => null,
            'status' => 'Belum Terbayar'
        ]);

        return response()->json('Data Berhasil Diubah');
    }

    public function deleteTransaksi(Request $request)
    {
        $transaksi = TransaksiTelemedicine::where('id',$request->id)->first();
        if ($transaksi->bukti_pembayaran) {
            Storage::disk('public')->delete($transaksi->bukti_pembayaran);  
        }

        $transaksi->delete();

        return response()->json('Data Berhasil Diubah');
    }


    public function transactionTelemedicinedokter(){
        $history = TransaksiTelemedicine::with(['dokter','spesialis','jadwaltelemedicine'])->where('dokter_id',auth()->user()->id)->get();

        
        // tanggal sekarang
        $tanggalNow = Carbon::parse(now())->format('Y-m-d');
        $jamNow = Carbon::parse(now())->format('H:i');

        // jamsekarang


        foreach ($history as $item =>   $value) {
            if ($value->status == 'Terverifikasi') {
                if ($value->tanggal == $tanggalNow) {                
                    $value['status_tanggal'] = 'success';
    
                    $waktu_mulai = strtotime($value->tanggal . $value->jam_mulai);
                    $waktu_selesai = strtotime($value->tanggal . $value->jam_akhir);
                    $waktu_now = strtotime($value->tanggal . $jamNow);
                    if ($waktu_now > $waktu_mulai && $waktu_now < $waktu_selesai) {
                        $value['status_waktu'] = 'success';    
                    }else{
                        $value['status_waktu'] = 'error';    
                    }
    
                }else{
                    $value['status_tanggal'] = 'error';
                    $value['status_waktu'] = 'error';
                }
            }
         
        }
     
        return view('pages.pasien_transaksi_telemedicine.history_transaksi.dokter',[
            'history' => $history
        ]);
    }


   

}
