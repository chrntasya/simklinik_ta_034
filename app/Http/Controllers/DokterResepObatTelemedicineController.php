<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\ResepObat;
use App\Models\TransaksiTelemedicine;
use App\Traits\CodeTrait;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DokterResepObatTelemedicineController extends Controller
{
    use CodeTrait;
    public function index()
    {
        $history = TransaksiTelemedicine::with(['dokter','spesialis','jadwaltelemedicine','pasien'])
                   ->where('status','Terverifikasi')
                   ->where('dokter_id',auth()->user()->id)->get();

        return view('pages.resep_telemedicine_dokter.index',[
            'history' => $history
        ]);
    }

    public function create($id)
    {
        $transaksi = TransaksiTelemedicine::where('id',$id)->with('resepobattelemedicine.resepobatdetails')->first();
        $obats = Obat::get();

        return view('pages.resep_telemedicine_dokter.create',[
            'transaksi' => $transaksi,
            'obats' => $obats
        ]);
    }

    public function store(Request $request)
    {
        
        $kode = $this->getKodeTransaksi('resep_obats','RSP');
        $resepobat = ResepObat::create([
            'kode' => $kode,
            'tanggal_resep' => Carbon::parse($request->tanggal_resep)->format('Y-m-d'),
            'status' => 'Lama'
        ]);

        $transaksitelemedicine = TransaksiTelemedicine::with('resepobattelemedicine.resepobatdetails')->where('id',$request->id)->update([
            'resepobattelemedicine_id' => $resepobat->id,
            'status_pengambilan_resep' => 'belum'
        ]);

        $transaksi = TransaksiTelemedicine::with('resepobattelemedicine.resepobatdetails')->where('id',$request->id)->first();

        return redirect('dokter/resepobattelemedicine/'. $transaksi->id .'/create');

    }

    public function print($id){
        $transaksi = TransaksiTelemedicine::where('id',$id)->with(['dokter','spesialis','jadwaltelemedicine','pasien','resepobattelemedicine.resepobatdetails'])->first();

        $data = [
            'transaksi' => $transaksi
        ];
        

        $pdf = PDF::loadView('pages.resep_telemedicine_dokter.download.print', $data)
                    ->setPaper('a4', 'potrait')
                    ->setWarnings(false)
                    ->save('myfile.pdf');

        return $pdf->stream();
    }

    

    

    
}
