<?php

namespace App\Http\Controllers;

use App\Models\Laboratorium;
use App\Models\RujukanLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaboratoriumController extends Controller
{
    public function index(){
        $lab = Laboratorium::with('rujukan')->get();
        

        return view('pages.laboratorium.index',compact('lab'));        
    }

    public function listRujukan(){
        $rujukan = RujukanLab::with('rekamedis.dokter','rekamedis.pasien','tempatRujukan')->where('status','Baru')->get();

        // dd($rujukan);

        return view('pages.laboratorium.listrujukan',compact('rujukan'));
    }

    public function create($id){
        $rujukan = RujukanLab::with('rekamedis.dokter','rekamedis.pasien','tempatRujukan')->where('id',$id)->first();

        return view('pages.laboratorium.create',compact('rujukan'));
    }

    public function store(Request $request){
        $nameFile = null;
        $img = $request->file('file');
        if ($img) { 
            // dd($img);                
            $dataFoto =$img->getClientOriginalName();
            $waktu = time();
            $name = $waktu.$dataFoto;
            $nameFile = Storage::putFileAs('file_lab',$img,$name);            
            $nameFile = $name;            
        }

        Laboratorium::create([
            'rujukan_id' => $request->rujukan_id,
            'deskripsi' => $request->deskripsi,
            'file' => $nameFile
        ]);

        return redirect()->route('lab.index')->with('success','Data Berhasil ditambahkan');


    }

    public function edit($id){
        $lab = Laboratorium::where('id',$id)->with('rujukan.rekamedis.pasien','rujukan.rekamedis.dokter')->first();


        return view('pages.laboratorium.edit', compact('lab'));
    }

    public function update(Request $request,$id) {
        $img = $request->file('file');

        $lab = Laboratorium::where('id',$id)->first();
        $nameFile = $lab->file;

        if ($img) {
            Storage::disk('public')->delete($lab->file); 

            $dataFoto =$img->getClientOriginalName();
            $waktu = time();
            $name = $waktu.$dataFoto;
            $nameFile = Storage::putFileAs('file_lab',$img,$name);            
            $nameFile = $name; 
        }

        $lab->update([
            'file' => $nameFile,
            'deskripsi' => $request->deskripsi
        ]);



        return redirect()->route('lab.index')->with('success','Data Berhasil =diubah');

    }

    public function delete(Request $request){
        $lab = Laboratorium::where('id',$request->id)->first();
        

        Storage::disk('public')->delete($lab->file); 


        $lab->delete();

        return back()->with('success','Data berhasil di Hapus');
    }

}
