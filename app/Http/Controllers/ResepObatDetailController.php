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
use Illuminate\Support\Facades\DB;

class ResepObatDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        
        $resep_obat_detail = ResepObatDetail::with('obat')->all();

        return view('pages.resep_obat_detail.index', compact('resep_obat_detail'));
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

        $data = [
            'obat' => Obat::all(),
            'resep'
        ];

        return view('pages.resep_obat_detail.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'obat_id' => 'required',            
            'jumlah_obat' => 'required',
        ]);
        // dd($request->all());
        $updateStok = Obat::find($request->obat_id);
        $updateStok->update([
            'stok' => $updateStok->stok - $request->jumlah_obat,
        ]);

        // cek apakah obat yang di plih sama dengan yang di input 
        $resepObat = ResepObatDetail::where('id_resep_obat',$request->id)->where('id_obat',$request->obat_id)->first();
            if ($resepObat) {
                $newStok = $resepObat->jumlah_obat +  $request->jumlah_obat;
                $resepObat->update([
                    'jumlah_obat' => $newStok
                ]);
            }else{
                $input = new ResepObatDetail();
                $input->id_resep_obat = $request->id;
                $input->id_obat = $request->obat_id;
                // $input->keterangan_obat = $request->keterangan_obat;
                $input->jumlah_obat = $request->jumlah_obat;
                $input->save();
            }
        
        return redirect()->back()->with("success", "Tambah data berhasil");
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

        // $kode_obat = ResepObatDetail::findOrFail($id)->kode;

        // $obat_dipilih = DB::table('resep_obat_details')
        // ->join('obat', 'resep_obat_details.id_obat', '=', 'obat.id')
        // ->where('resep_obat_details.kode', $kode_obat)
        // ->select('resep_obat_details.*', 'obat.nama as nama_obat')
        // ->get();

        $data = [
            'resep_obat_detail' => ResepObatDetail::where('id_resep_obat_detail'),
            'main_resep_obat_detail' => ResepObatDetail::findOrFail($id),
            'obat' => Obat::all(),
        ];

        // dd($data);
        return view('pages.resep_obat_detail.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        $input = ResepObatDetail::find($id);
        // dd($request);
        // jika request lebih banyak dari data yang sudah disimpan
        if ($request->jumlah_obat >= $input->jumlah_obat) {
            $selisih = $request->jumlah_obat - $input->jumlah_obat;

            $updateStok = Obat::find($request->obat_id);

            $updateStok->update([
            'stok' => $updateStok->stok - $selisih,
        ]);

        // jika request lebih sedikit dari data yang sudah disimpan
        } elseif ($request->jumlah_obat <= $input->jumlah_obat) {
            $selisih = $input->jumlah_obat - $request->jumlah_obat;
            $updateStok = Obat::find($request->obat_id);

            $updateStok->update([
            'stok' => $updateStok->stok + $selisih,
         ]); 
        } 

        $input->update([
            'id_obat' => $request->obat_id,
            // 'keterangan_obat' => $request->keterangan_obat,
            'jumlah_obat' => $request->jumlah_obat,
        ]);
        

        return redirect()->back()->with("success", "Update data berhasil");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $resep_obat_detail = ResepObatDetail::findOrFail($id);

        $updateStok = Obat::find($resep_obat_detail->id_obat);

        // dd($resep_obat_detail);
        $updateStok->update([
            'stok' => $updateStok->stok + $resep_obat_detail->jumlah_obat,
        ]);

        $resep_obat_detail->delete();
        return redirect()->back()->with("success", "Hapus data berhasil");
    }
}
