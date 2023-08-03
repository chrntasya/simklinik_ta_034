<?php

namespace Database\Seeders;

use App\Models\JadwalDokter;
use Illuminate\Database\Seeder;

class JadwalDokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JadwalDokter::create([
            'dokter_id' => 2,
            'hari' => 'selasa',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'ruangan' => "A301",
            'stok' => 10
        ]);

        JadwalDokter::create([
            'dokter_id' => 2,
            'hari' => 'rabu',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'ruangan' => "A301",
            'stok' => 10
        ]);

        JadwalDokter::create([
            'dokter_id' => 6,
            'hari' => 'kamis',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'ruangan' => "A301",
            'stok' => 10
        ]);

        JadwalDokter::create([
            'dokter_id' => 7,
            'hari' => 'kamis',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'ruangan' => "A301",
            'stok' => 10
        ]);

        JadwalDokter::create([
            'dokter_id' => 2,
            'hari' => 'jumat',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'ruangan' => "A301",
            'stok' => 10
        ]);
        JadwalDokter::create([
            'dokter_id' => 2,
            'hari' => 'sabtu',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'ruangan' => "A301",
            'stok' => 10
        ]);
        JadwalDokter::create([
            'dokter_id' => 2,
            'hari' => 'minggu',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'ruangan' => "A301",
            'stok' => 10
        ]);

        JadwalDokter::create([
            'dokter_id' => 2,
            'hari' => 'senin',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'ruangan' => "A301",
            'stok' => 10
        ]);


    }
}
