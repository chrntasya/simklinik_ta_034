<?php

namespace Database\Seeders;

use App\Models\JadwalTelemedicine;
use Illuminate\Database\Seeder;

class JadwalTelemedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JadwalTelemedicine::create([
            'dokter_id' => 2,
            'hari' => 'selasa',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'stok' => 10,
            'nominal' => 230000,
            'spesialis_id' => 1
        ]);

        JadwalTelemedicine::create([
            'dokter_id' => 2,
            'hari' => 'rabu',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'stok' => 10,
            'nominal' => 230000,
            'spesialis_id' => 1
        ]);

        JadwalTelemedicine::create([
            'dokter_id' => 6,
            'hari' => 'kamis',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'stok' => 10,
            'nominal' => 230000,
            'spesialis_id' => 2
        ]);

        JadwalTelemedicine::create([
            'dokter_id' => 7,
            'hari' => 'kamis',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'stok' => 10,
            'nominal' => 230000,
            'spesialis_id' => 2
        ]);

        JadwalTelemedicine::create([
            'dokter_id' => 2,
            'hari' => 'jumat',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'stok' => 10,
            'nominal' => 230000,
            'spesialis_id' => 2
        ]);
        JadwalTelemedicine::create([
            'dokter_id' => 2,
            'hari' => 'sabtu',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'stok' => 10,
            'nominal' => 230000,
            'spesialis_id' => 3
        ]);
        JadwalTelemedicine::create([
            'dokter_id' => 2,
            'hari' => 'minggu',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'stok' => 10,
            'nominal' => 230000,
            'spesialis_id' => 3
        ]);

        JadwalTelemedicine::create([
            'dokter_id' => 2,
            'hari' => 'senin',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'stok' => 10,
            'nominal' => 230000,
            'spesialis_id' => 2
        ]);
    }
}
