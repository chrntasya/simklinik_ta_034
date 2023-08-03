<?php

namespace App\Http\Controllers;

use App\Models\PembelianObatSuppliers;
use App\Models\Obat;
use Illuminate\Http\Request;
use App\Http\Requests\PembelianObatSuppliersRequest;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class PembelianObatSuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('pages.pembelian_obat_supplier.index', [
        //     'pembelian_obat_supplier' => PembelianObatSupplier::where('user_id', auth()->user()->id)->get()
        // ]);
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
        $pembelian_obat_suppliers = PembelianObatSuppliers::with(['obat'])->get();
        // dd($pembelian_obat_suppliers);
        return view('pages.pembelian_obat_suppliers.index', compact('pembelian_obat_suppliers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $pembelian_obat_suppliers = PembelianObatSuppliers::all();
        $obat_id = Obat::all();
        return view('pages.pembelian_obat_suppliers.create', compact('pembelian_obat_suppliers', 'obat_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PembelianObatSuppliersRequest $request)
    {
        // dd($request->all());
        try {
            $tanggal=null;
            if ($request->tanggal_kadaluarsa) {
                $tanggal = Carbon::parse($request->tanggal_kadaluarsa)->format('Y-m-d');
            }
            $updateStok = Obat::find($request->obat_id);
            $updateStok->update([
                'stok' => $updateStok->stok + $request->stok,
                'tanggal_kadaluarsa' => $tanggal
            ]);
            PembelianObatSuppliers::create($request->all());
            return redirect('/admin/pembelian_obat_suppliers')->with("success", "Tambah data berhasil");
        } catch (\Exception $th) {
            return redirect()->back()->with('error', "Isi field dengan benar");
        }
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
        $pembelian_obat_suppliers = PembelianObatSuppliers::with(['obat'])->findOrFail($id);
        $obat_id = Obat::all();
        return view('pages.pembelian_obat_suppliers.update', compact('pembelian_obat_suppliers', 'obat_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PembelianObatSuppliersRequest $request, $id)
    {
        $req = $request->except('_method', '_token', 'submit');
        try {
            $updateStok = Obat::find($request->obat_id);
            $perubahanA = PembelianObatSuppliers::findOrFail($id)->stok;
            $perubahanStok = $request->stok - $perubahanA;
            $updateStok->update([
                'stok' => $updateStok->stok + $perubahanStok,
                'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa
            ]);
            PembelianObatSuppliers::findOrFail($id)->update($request->all());
            return redirect()->route('pembelian_obat_suppliers.index')->with("success", "Update data berhasil");
        } catch (\Exception $e) {
            return redirect()->back()->with("error", "Update gagal");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembelian_obat_suppliers = PembelianObatSuppliers::findOrFail($id);
        $updateStok = Obat::find($pembelian_obat_suppliers->obat_id);
            $updateStok->update([
                'stok' => $updateStok->stok - $pembelian_obat_suppliers->stok
            ]);
            $pembelian_obat_suppliers->delete();
        return redirect()->back()->with("success", "Hapus data berhasil");
    }
}
