<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
   
    public function run()
    {
        $admin = User::create([
            'username' => 'Admin',
            'nama' => 'admin',
            'email' => 'admin',
            'tanggal_lahir' => '1971-03-01',
            'jenis_kelamin' => 'L',
            'nomor_telepon' => '+6285130408600',
            'password' => bcrypt('admin'),
        ]);

        $params['user_id'] = $admin->id;
        $params['role_id'] = 1;
        $userRole = UserRole::create($params);

        $dokter = User::create([
            'username' => 'dokter',
            'nama' => 'dokter',
            'email' => 'dokter',
            'tanggal_lahir' => '1971-03-02',
            'jenis_kelamin' => 'P',
            'password' => bcrypt('dokter'),
            'nomor_telepon' => '+6285130408600',
            'nominal' => 20000
        ]);

        $dokterarray['user_id'] = $dokter->id;
        $dokterarray['role_id'] = 2;
        $userRole = UserRole::create($dokterarray);

        $pasien = User::create([
            'username' => 'pasien',
            'nama' => 'pasien',
            'email' => 'zudhapratama123@gmail.com',
            'tanggal_lahir' => '1971-03-03',
            'jenis_kelamin' => 'L',
            'kode' => '00001',
            'nomor_telepon' => '+6285130408600',
            'password' => bcrypt('pasien'),
        ]);

        $paseinarray['user_id'] = $pasien->id;
        $paseinarray['role_id'] = 3;
        $userRole = UserRole::create($paseinarray);

        $pasien = User::create([
            'username' => 'apoteker',
            'nama' => 'apoteker',
            'email' => 'apoteker',
            'jenis_kelamin' => 'P',
            'nomor_telepon' => '+6285130408600',
            'password' => bcrypt('apoteker'),
        ]);

        $paseinarray['user_id'] = $pasien->id;
        $paseinarray['role_id'] = 4;
        $userRole = UserRole::create($paseinarray);

        $pasien2 = User::create([
            'nama' => 'Mara',
            'username' => 'mara',
            'email' => 'mara',
            'tanggal_lahir' => '1971-02-02',
            'jenis_kelamin' => 'P',
            'kode' => '00002',
            'nomor_telepon' => '+6285130408600',
            'password' => bcrypt('mara'),
        ]);

        $pasien2data['user_id'] = $pasien2->id;
        $pasien2data['role_id'] = 3;
        $userRole = UserRole::create($pasien2data);

        $dokter2 = User::create([
            'username' => 'Dokter Penyakit Luar',
            'nama' => 'dokterpenyakitluar',
            'email' => 'dokterpenyakitluar',
            'tanggal_lahir' => '1971-03-02',
            'jenis_kelamin' => 'P',
            'nomor_telepon' => '+6285130408600',
            'password' => bcrypt('dokterpenyakitluar'),
            'nominal' => 20000
        ]);

        $dokterarray2['user_id'] = $dokter2->id;
        $dokterarray2['role_id'] = 2;
        $userRole = UserRole::create($dokterarray2);

        $dokter3 = User::create([
            'username' => 'Dokter Penyakit Dalam',
            'nama' => 'zy',
            'email' => 'zy',
            'tanggal_lahir' => '1971-03-02',
            'jenis_kelamin' => 'P',
            'nomor_telepon' => '+6285130408600',
            'password' => bcrypt('zy'),
            'nominal' => 20000
        ]);

        $dokterarray3['user_id'] = $dokter3->id;
        $dokterarray3['role_id'] = 2;
        $userRole = UserRole::create($dokterarray3);

         $lab = User::create([
            'username' => 'lab',
            'nama' => 'orang lab',
            'email' => 'orang lab',
            'tanggal_lahir' => '1971-03-02',
            'jenis_kelamin' => 'L',
            'nomor_telepon' => '+6285130408600',
            'password' => bcrypt('lab'),
        ]);

        $labarray['user_id'] = $lab->id;
        $labarray['role_id'] = 5;
        $userRole = UserRole::create($labarray);

    }
}
