<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriObat;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\KategoriObatRequest;
use App\Http\Requests\KategoriObatUpdateRequest;
use App\Traits\CodeTrait;

class KategoriObatController extends Controller
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
        $kategori_obat = KategoriObat::all();
        return view('pages.kategori_obat.index', compact('kategori_obat'));
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
        return view('pages.kategori_obat.create');
    }

    
    public function store(Request $request)
    {
        try {
            $kode = $this->getKodeTransaksi('kategori_obat','KO');

            // dd($kode);
            $request['kode'] = $kode;

            KategoriObat::create($request->all());
            return redirect()->route('kategori_obat.index')->with("success", "Tambah data berhasil");
        } catch (\Exception $th) {
            return redirect()->back()->with('error', $th);
        }
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
        $kategori_obat = KategoriObat::findOrFail($id);
        return view('pages.kategori_obat.update', compact('kategori_obat'));
    }

   
    public function update(KategoriObatUpdateRequest $request, $id)
    {
        $req = $request->except('_method', '_token', 'submit');
        try {
            KategoriObat::findOrFail($id)->update($request->all());
            return redirect()->route('kategori_obat.index')->with("success", "Update data berhasil");
        } catch (\Exception $e) {
            return redirect()->back()->with("error", "Update gagal");
        }
    }

   
    public function destroy($id)
    {
        $kategori_obat = KategoriObat::findOrFail($id);
        $kategori_obat->delete();
        return redirect()->back()->with("success", "Hapus data berhasil");
    }
}
