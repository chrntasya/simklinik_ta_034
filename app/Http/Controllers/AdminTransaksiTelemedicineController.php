<?php

namespace App\Http\Controllers;

use App\Models\TransaksiTelemedicine;
use Illuminate\Http\Request;

class AdminTransaksiTelemedicineController extends Controller
{
    public function index() {
        $history = TransaksiTelemedicine::with(['dokter','spesialis','jadwaltelemedicine'])->get();   

        return view('pages.admin_transaksi_telemedicine.index',[
            'history' => $history
        ]);
    }

    public function updateStatus(Request $request) {
        
        TransaksiTelemedicine::where('id',$request->id)->update([
            'status' => $request->status
        ]);

        return back();
    }

    public function indexResep()
    {
        $telemedicine = TransaksiTelemedicine::with(['dokter','spesialis','jadwaltelemedicine','pasien'])->get();  
        // dd($telemedicine);  
        return view('pages.admin_resep_telemedicine.index',compact('telemedicine'));
    }   
    
    public function penerimaan(Request $request)
    {
        $telemedicine = TransaksiTelemedicine::where('id',$request->id)->update([
            'status_pengambilan_resep' => $request->status_pengambilan_resep,
            'keterangan' =>  $request->keterangan
        ]);
        
        return back()->with('success','Data Berhasil Ditambahkan');
    }

    



}
