<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spesialis;
use App\Models\UserRole;
use App\Http\Requests\SpesialisRequest;
use App\Http\Requests\SpesialisUpdateRequest;
use App\Models\UserSpesialis;
use App\Traits\CodeTrait;
use Illuminate\Support\Facades\Auth;

class SpesialisController extends Controller
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
        $spesialis = Spesialis::all();
        return view('pages.spesialis.index', compact('spesialis'));
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
        return view('pages.spesialis.create');
    }

    
    public function store(SpesialisRequest $request)
    {
        try {
            $kode = $this->getKodeTransaksi('spesialis','SP');
            $request['kode'] = $kode;
            Spesialis::create($request->all());
            return redirect()->route('spesialis.index')->with("success", "Tambah data berhasil");
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
        $spesialis = Spesialis::findOrFail($id);
        return view('pages.spesialis.update', compact('spesialis'));
    }

    
    public function update(SpesialisUpdateRequest $request, $id)
    {
        $req = $request->except('_method', '_token', 'submit');
        try {
            Spesialis::findOrFail($id)->update($request->all());
            return redirect()->route('spesialis.index')->with("success", "Update data berhasil");
        } catch (\Exception $e) {
            return redirect()->back()->with("error", "Update gagal");
        }
    }

   
    public function destroy($id)
    {
        $count = UserSpesialis::where('spesialis_id',$id)->count();
        if ($count > 0 ) {
            return redirect()->back()->with("error", "Data Sudah dipakai di Dokter");    
        }
        $spesialis = Spesialis::findOrFail($id);
        $spesialis->delete();
        return redirect()->back()->with("success", "Hapus data berhasil");
    }
}
