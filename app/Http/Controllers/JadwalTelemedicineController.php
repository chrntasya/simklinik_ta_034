<?php

namespace App\Http\Controllers;

use App\Models\JadwalTelemedicine;
use App\Models\Roles;
use App\Models\Spesialis;
use App\Models\TransaksiTelemedicine;
use App\Models\UserRole;
use App\Models\UserSpesialis;
use Illuminate\Http\Request;

class JadwalTelemedicineController extends Controller
{
    public function index()
    {
        $data['jadwalSenin'] = JadwalTelemedicine::with(['dokter'])->where('hari', 'senin')->get();
        $data['jadwalSelasa'] = JadwalTelemedicine::with(['dokter'])->where('hari', 'selasa')->get();
        $data['jadwalRabu'] = JadwalTelemedicine::with(['dokter'])->where('hari', 'rabu')->get();
        $data['jadwalKamis'] = JadwalTelemedicine::with(['dokter'])->where('hari', 'kamis')->get();
        $data['jadwalJumat'] = JadwalTelemedicine::with(['dokter'])->where('hari', 'jumat')->get();
        $data['jadwalSabtu'] = JadwalTelemedicine::with(['dokter'])->where('hari', 'sabtu')->get();
        $data['jadwalMinggu'] = JadwalTelemedicine::with(['dokter'])->where('hari', 'minggu')->get();

        return view('pages.jadwal_telemedicine.index',$data);
    }

    public function create()
    {
        $role = Roles::where('nama', 'dokter')->first();
        $dokter = UserRole::with(['users', 'roles'])->where('role_id', $role->id)->get();
        
        return view('pages.jadwal_telemedicine.create',[
            'dokter' => $dokter
        ]);

    }

    public function store(Request $request)
    {
        $spesialis = UserSpesialis::where('user_id',$request->dokter_id)->first();
        
        JadwalTelemedicine::create([
            'dokter_id' => $request->dokter_id,
            'hari' => $request->hari,
            'waktu_mulai' => $request->waktu_mulai, 
            'waktu_selesai' => $request->waktu_selesai,
            'stok' => $request->stok,
            'nominal' => $request->nominal,
            'spesialis_id' => $spesialis->spesialis_id
        ]);

        return redirect()->route('dokter.jadwaltelemedicine')->with('Berhasil Menambahkan Data');
    }

    public function delete(Request $request)
    {
        $count = TransaksiTelemedicine::where('jadwaltelemedicine_id',$request->id)->count();
        if ($count > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Jadwal Sudah di pakai di telemedicine'
            ]);
        }
        JadwalTelemedicine::where('id',$request->id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Jadwal Berhasil Dihapus'
        ]);
    }
}
