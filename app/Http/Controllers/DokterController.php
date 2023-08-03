<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Roles;
use App\Models\Spesialis;
use App\Models\UserSpesialis;
use App\Http\Requests\DokterRequest;
use App\Http\Requests\DokterUpdateRequest;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
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
        $role = Roles::where('nama', 'dokter')->first();
        $spesialis = Spesialis::all();
        $dokterSpesialis = UserSpesialis::with(['users', 'user_spesialis'])->get();
        $dokter = UserRole::with(['users', 'roles'])->where('role_id', $role->id)->get();
        return view('pages.dokter.index', compact('dokter', 'dokterSpesialis', 'spesialis'));
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
        $spesialis = Spesialis::all();
        return view('pages.dokter.create', compact('spesialis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DokterRequest $request)
    {
        try {
            $request['password'] = Hash::make($request['password']);
            $role = Roles::where('nama', 'dokter')->first();
            $user = User::create($request->all());
            $params['user_id'] = $user->id;
            $params['role_id'] = $role->id;
            $userRole = UserRole::create($params);
            $userSpesialis['user_id'] = $user->id;
            $userSpesialis['spesialis_id'] = $request['spesialis'];
            $dokterSpesialis = UserSpesialis::create($userSpesialis);
            return redirect()->route('user_dokter.index')->with("success", "Tambah data berhasil");
        } catch (\Exception $th) {
            return redirect()->back()->with('error', $th);
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
        $spesialis = Spesialis::all();
        $dokter = UserSpesialis::with(['users', 'user_spesialis'])->findOrFail($id);
        return view('pages.dokter.update', compact('dokter', 'spesialis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DokterUpdateRequest $request, $id)
    {
        $req = $request->except('_method', '_token', 'submit');
        try {
            $dokterSpesialis = UserSpesialis::findOrFail($id);
            $user = User::findOrFail($dokterSpesialis->user_id)->update($request->all());
            $dokter['user_id'] = $dokterSpesialis->user_id;
            $dokter['spesialis_id'] = $request['spesialis'];
            $updateDokterSpesialis = UserSpesialis::findOrFail($id)->update($dokter);
            return redirect()->route('user_dokter.index')->with("success", "Update data berhasil");
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e);
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
        $userSpesialis = UserSpesialis::findOrFail($id);
        $dokter = User::findOrFail($userSpesialis->user_id);
        $dokter->delete();
        return redirect()->back()->with("success", "Hapus data berhasil");
    }
}
