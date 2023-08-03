<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use App\Models\KategoriObat;
use App\Http\Requests\ObatRequest;
use App\Http\Requests\ObatUpdateRequest;
use App\Models\TransaksiDetail;
use App\Models\ResepObatDetail;
use App\Traits\CodeTrait;
use Carbon\Carbon;

class ObatController extends Controller
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
        
        $obat = Obat::with(['kategori_obat'])->get();
        return view('pages.obat.index', compact('obat'));
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
        $kategori_obat = KategoriObat::all();
        return view('pages.obat.create', compact('kategori_obat'));
    }

    
    public function store(Request $request)
    {

            $kode = $this->getKodeTransaksi('obat','OB');
            
            $request['kode'] = $kode;
            $request['tanggal_kadaluarsa'] = Carbon::parse($request->tanggal_kadaluarsa)->format('Y-m-d');
            Obat::create($request->all());
            return redirect('/admin/obat')->with("success", "Tambah data berhasil");
        
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
        $obat = Obat::with(['kategori_obat'])->findOrFail($id);
        $kategori_obat = KategoriObat::all();
        return view('pages.obat.update', compact('obat', 'kategori_obat'));
    }

   
    public function update(ObatUpdateRequest $request, $id)
    {
        $req = $request->except('_method', '_token', 'submit');
        try {
            Obat::findOrFail($id)->update($request->all());
            return redirect()->route('obat.index')->with("success", "Update data berhasil");
        } catch (\Exception $e) {
            return redirect()->back()->with("error", "Update gagal");
        }
    }

    
    public function destroy($id)
    {
        $resepObat = ResepObatDetail::where('id_obat', $id)->first();
        $transaksiDetail = TransaksiDetail::where('obat_id', $id)->first();
        $obat = Obat::findOrFail($id);
        if ($resepObat || $transaksiDetail != NULL) {
            return redirect()->back()->with("error", "Hapus data tidak berhasil, karena Obat sudah digunakan di Resep Obat dan Transaksi");
        }
        else {
            $obat->delete();
            return redirect()->back()->with("success", "Hapus data berhasil");
        }
    }

    public function cekObat(Request $request)
    {
        $obat = Obat::where('id',$request->id_obat)->first();
        
        return response()->json([
            'stok_obat' => $obat->stok
        ]);
    }
}
