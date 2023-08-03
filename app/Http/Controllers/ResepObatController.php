<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResepObat;
use App\Models\ResepObatDetail;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ResepObatRequest;
use App\Http\Requests\ResepObatUpdateRequest;
use App\Models\Obat;
use App\Models\Rekamedis;
use App\Models\Resep;
use App\Traits\CodeTrait;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;

class ResepObatController extends Controller
{
    use CodeTrait;
   
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
        
        $resep_obat = ResepObat::all();

        return view('pages.resep_obat.index', compact('resep_obat'));
    }

   
    public function create()
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

        $data = [
            'obat' => Obat::all(),
        ];

        return view('pages.resep_obat.create', $data);
    }

  
    public function store(Request $request)
    {
       
        $input = new ResepObat();
        $kode = $this->getKodeTransaksi('resep_obats','RSP');
        $input->kode = $kode;
        $input->status = 'Lama';
        $input->tanggal_resep = $request->tanggal_resep;            
        $input->save();

        return redirect('admin/resep_obat/'.$input->id.'/edit')->with("success", "Tambah data berhasil");
        // try {
        //     ResepObat::create($request->all());
        //     return redirect('admin/resep_obat')->with("success", "Tambah data berhasil");
        // } catch (\Exception $th) {
        //     return redirect()->back()->with('error', $th);
        // }

        // $input = new ResepObat();
    }

  
    public function show($id)
    {
        //
    }

   
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

        // $kode_obat = ResepObat::findOrFail($id)->kode;

        $obat_dipilih = DB::table('resep_obat_details')
        ->join('obat', 'resep_obat_details.id_obat', '=', 'obat.id')
        ->where('resep_obat_details.id_resep_obat', $id)
        ->select('resep_obat_details.*', 'obat.nama as nama_obat')
        ->get();

        // dd($obat_dipilih);

        $data = [
            'resep_obat' => $obat_dipilih,
            'main_resep_obat' => ResepObat::findOrFail($id),
            'obat' => Obat::all(),
            'resep_obat_id' => $id, 
        ];

        // dd($data);
        return view('pages.resep_obat.update', $data);
    }

    
    public function update(Request $request, $id)
    {
        
        
        $input = ResepObat::find($id);
       
       
        $kode = $this->getKodeTransaksi('resep_obats','RSP');

        $input->update([
            'kode' => $kode,
            'tanggal_resep' => $request->tanggal_resep,
        ]);

        return redirect()->back()->with("success", "Update data berhasil");

    }

   
    public function destroy($id)
    {
        $resep_obat = ResepObat::findOrFail($id);
        $resep_obat->delete();
        return redirect()->back()->with("success", "Hapus data berhasil");
    }

    public function deleteObat(Request $request)
    {
        // $obat  = ResepObatDetail::where('id',$request->resep_id)->delete();
        
        $resep_obat_detail = ResepObatDetail::findOrFail($request->resep_id);

        $updateStok = Obat::find($resep_obat_detail->id_obat);

        // dd($resep_obat_detail);
        $updateStok->update([
            'stok' => $updateStok->stok + $resep_obat_detail->jumlah_obat,
        ]);

        $resep_obat_detail->delete();
        

        return response()->json('Data Telah Di Hapus');
    }

    public function storebaru(Request $request)
    {        
        $kode = $this->getKodeTransaksi('resep_obats','RO');
        $input = ResepObat::create([
            'kode' => $kode,
            'tanggal_resep' => $request->tanggal_resep,
            'status' => 'Baru'
        ]);
        

        // rekammedis
        $rekamedis = Rekamedis::where('id',$request->rekam_medis_id)->update([
            'resep_obat_baru_id' => $input->id 
        ]);

        return back();
       
    }


    public function download($id)
    {
        $rekammedis = Rekamedis::with('pasien','dokter','resepobatbaru.resepobatdetails.obat')->where('id',$id)->first();
        // dd($rekammedis);
        $data = [
            'rekammedis' => $rekammedis
        ];

        $pdf = PDF::loadView('pages.transaksi.resepbaru.resepbaru', $data)
                    ->setPaper('a4', 'potrait')
                    ->setWarnings(false)
                    ->save('myfile.pdf');;
        return $pdf->stream();
       
    }

    public function storeTelemedicine()
    {
        
    }
}
