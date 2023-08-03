<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    
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
        $admin = UserRole::with(['users', 'roles'])->where('role_id', 1)->get();
        return view('pages.admin.index', compact('admin'));
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
        return view('pages.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $password = Hash::make($request['password']);
        $role = Roles::where('nama', 'admin')->first();
        
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

        return redirect()->route('user_admin.index')->with("success", "Tambah data berhasil");
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
        $admin = UserRole::with(['users', 'roles'])->findOrFail($id);
        return view('pages.admin.update', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateRequest $request, $id)
    {
        $req = $request->except('_method', '_token', 'submit');
        try {
            $user_role = UserRole::findOrFail($id);
            $request['password'] = Hash::make($request['password']);
            $user = User::findOrFail($user_role->user_id)->update($request->all());
            return redirect()->route('user_admin.index')->with("success", "Update data berhasil");
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e);
        }
    }

    // $input['password'] = Hash::make($input['password']);

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = UserRole::findOrFail($id);
        $admin->delete();
        return redirect()->back()->with("success", "Hapus data berhasil");
    }
}
