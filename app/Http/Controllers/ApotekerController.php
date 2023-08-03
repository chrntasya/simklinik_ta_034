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

class ApotekerController extends Controller
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
        $admin = UserRole::with(['users', 'roles'])->where('role_id', 4)->get();
        return view('pages.apoteker.index', compact('admin'));
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
        return view('pages.apoteker.create');
    }

    public function store(Request $request)
    {
        $password = Hash::make($request['password']);
        $role = Roles::where('nama', 'apoteker')->first();
        
        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $password,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_rumah' => $request->alamat_rumah,
            'nik' => $request->nik
        ]); 
        $params['user_id'] = $user->id;
        $params['role_id'] = $role->id;
        $userRole = UserRole::create($params);

        return redirect()->route('user_apoteker.index')->with("success", "Tambah data berhasil");
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
        $admin = UserRole::with(['users', 'roles'])->findOrFail($id);
        return view('pages.apoteker.update', compact('admin'));
    }

   
    public function update(Request $request, $id)
    {
        $req = $request->except('_method', '_token', 'submit');
        try {
            $user_role = UserRole::findOrFail($id);
            $request['password'] = Hash::make($request['password']);
            $user = User::findOrFail($user_role->user_id)->update($request->all());
            return redirect()->route('user_apoteker.index')->with("success", "Update data berhasil");
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e);
        }
    }

   
    public function destroy($id)
    {
        $apoteker = UserRole::findOrFail($id);
        $apoteker->delete();
        return redirect()->back()->with("success", "Hapus data berhasil");
    }
}
