<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranPasien;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AntrianPasienController extends Controller
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
        if ($cek == "admin") {
            return redirect()->route('home');
        }elseif ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "apoteker") {
            return redirect()->route('apoteker_home');
        }
        $appointments = PendaftaranPasien::whereStatus(PendaftaranPasien::STATUS_ANTRI)
            ->whereDokterId(Auth::user()->id)
            // ->whereDate('tanggal', '>=', Carbon::yesterday()->format('Y-m-d'))
            ->with(['users'])
            ->get();

        
        $data = ['appointments' => $appointments];
        return view('pages.rekamedis.appointment', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function batal(Request $request, $id)
    {
        $antrian = PendaftaranPasien::whereId($id)->with(['users'])->firstOrFail();
        $antrian->status = PendaftaranPasien::STATUS_BATAL;
        if ($antrian->save()) {
            return redirect()->route('pasien.index')->with("success", ['status' =>"Sukses!", 'content' => "Antrian berhasil dibatalkan!"]);
        }
    }
}
