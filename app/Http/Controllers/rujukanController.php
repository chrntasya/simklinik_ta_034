<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RujukanLab;
use App\Models\Rekamedis;
use App\Models\TempatRujukan;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;

class rujukanController extends Controller
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
        $data = RujukanLab::with(['tempatRujukan'],['rekamedis'])->get();
        // dd($data);
        return view('pages.rujukan.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $userId = Auth::user()->id;
        // $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        // $cek = $userRole->roles->nama;
        // if ($cek == "pasien") {
        //     return redirect()->route('pasien_home');
        // }elseif ($cek == "dokter") {
        //     return redirect()->route('dokter_home');
        // }
        // $rekamedis  = Rekamedis::all();
        // $tempat     = TempatRujukan::all();
        // // dd($rekamedis);
        // $data = [
        //     'rekamedis' => $rekamedis,
        //     'tempat'    => $tempat
        // ];

        // return view('pages.rujukan.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $this->validate($request,[
        //     'kode'      => 'required','integer',
        //     'jenis_pemeriksaan' =>'required',
        //     'rekamedis' => 'required',
        //     'tgl_berkunjung' => 'required','date',
        //     'tempat_rujukan_id' => 'required',
        // ]);
        // $input = new RujukanLab();
        // $input->kode = $request->kode; 
        // $input->jenis_pemeriksaan = $request->jenis_pemeriksaan; 
        // $input->tempat_rujukan_id = $request->tempat_rujukan_id; 
        // $input->tglberkunjung = $request->tgl_berkunjung;
        // $input->rekamedis_id = $request->rekamedis; 
        // $input->save();
        // return redirect()->back()->with("success", "Rujukan Berhasil Ditambahkan");
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
        $rekamedis  = Rekamedis::all();
        $tempat     = TempatRujukan::all();
        $val        = RujukanLab::with(['tempatRujukan'])->find($id)->first();

        // dd($rekamedis);
        $data = [
            'val'       => $val,
            'rekamedis' => $rekamedis,
            'tempat'    => $tempat
        ];

        return view('pages.rujukan.edit',$data);
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
        $input = RujukanLab::find($id);
        if($request->kode){
            $input->kode = $request->kode;
        }
        if ($request->jenis_pemeriksaan) {
            $input->jenis_pemeriksaan = $request->jenis_pemeriksaan;
        }
        if ($request->tgl_berkunjung) {
            $input->tglberkunjung = $request->tgl_berkunjung;
        }
        if($request->rekamedis){
            $input->rekamedis_id = $request->rekamedis;
        }
        $input->update();
        return redirect()->back()->with("success", "Data berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $input = RujukanLab::find($id);
        $input->delete();
        return redirect()->back()->with("success", "Data berhasil dihapus");
        // dd($input); 
    }
}
