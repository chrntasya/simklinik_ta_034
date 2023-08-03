<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Roles;
use App\Http\Requests\PasienRequest;
use App\Http\Requests\PasienUpdateRequest;
use App\Traits\CodeTrait;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    use CodeTrait;
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
        $pasien = UserRole::with(['users', 'roles'])->where('role_id', 3)->get();
        return view('pages.pasien.index', compact('pasien'));
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
        return view('pages.pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PasienRequest $request)
    {
        try {
            $request['password'] = Hash::make($request['password']);
            $role = Roles::where('nama', 'pasien')->first();
            $request['kode'] = $this->getKodeTransaksi('users','RM');
            // dd($request->all());            
            $user = User::create($request->all());           
            $params['user_id'] = $user->id;
            $params['role_id'] = $role->id;
            $userRole = UserRole::create($params);

            return redirect()->route('user_pasien.index')->with("success", "Tambah data berhasil");
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
        $pasien = UserRole::with(['users', 'roles'])->findOrFail($id);
        return view('pages.pasien.update', compact('pasien'));
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
        
        $req = $request->except('_method', '_token', 'submit');
        try {
            $user_role = UserRole::findOrFail($id);
            $request['password'] = Hash::make($request['password']);
            $user = User::findOrFail($user_role->user_id)->update($request->all());
            return redirect()->route('user_pasien.index')->with("success", "Update data berhasil");
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
        $pasien = UserRole::findOrFail($id);
        $pasien->delete();
        return redirect()->back()->with("success", "Hapus data berhasil");
    }

    public function register(Request $request){
        
        try {
            $request['password'] = Hash::make($request['password']);
            $role = Roles::where('nama', 'pasien')->first();
            $request['kode'] = $this->getKodeTransaksi('users','RM');
            // dd($request->all());            
            $user = User::create($request->all());           
            $params['user_id'] = $user->id;
            $params['role_id'] = $role->id;
            $userRole = UserRole::create($params);

            return redirect()->route('login')->with("success", "Akun Berhasil Dibuat");
        } catch (\Exception $th) {
            return redirect()->back()->with('error', $th);
        }
    }
}
