<?php

namespace App\Http\Controllers;

use App\Models\TransaksiTelemedicine;
use Illuminate\Http\Request;

class ResepTelemedicinePasienController extends Controller
{
  public function index()
  {
        $transaksi = TransaksiTelemedicine::where('pasien_id',auth()->user()->id)
                                            ->with(['dokter','spesialis','jadwaltelemedicine','pasien','resepobattelemedicine.resepobatdetails'])
                                            ->where('status','Terverifikasi')->get();
        // dd($transaksi);

        return view('pages.pasien_resep_telemedicine.index',compact('transaksi'));
  }

  public function storepengantaran(Request $request)
  {
        $alamat = null;

        if ($request->alamat_pengambilan) {
            $alamat = $request->alamat_pengambilan;
        }

        if ($request->jenis_pengambilan == 'klinik') {
            $alamat = null;
        }
        
        $transaksi = TransaksiTelemedicine::where('id',$request->id)->update([
            'jenis_pengambilan' => $request->jenis_pengambilan,
            'alamat_pengambilan' => $alamat
        ]);

        return back();
  }


}
