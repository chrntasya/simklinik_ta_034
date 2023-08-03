<?php

namespace Database\Seeders;

use App\Models\PendaftaranPasien;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PendaftaranPasien::create([
            'user_id' => 1,
            'nomor_antrian' => 3,
            'status' => 'Antri',
            'dokter_id' => 2,
            'spesialis_id' => 1,
            'tipe_pembayaran' => 'umum',
            'jadwal_id' =>  1,
            'tanggal' => Carbon::parse(now())->format('Y-m-d')
        ]);

        PendaftaranPasien::create([
            'user_id' => 1,
            'nomor_antrian' => 2,
            'status' => 'Dibatalkan',
            'dokter_id' => 6,
            'spesialis_id' => 1,
            'tipe_pembayaran' => 'umum',
            'jadwal_id' =>  2,
            'tanggal' => Carbon::parse(now())->format('Y-m-d')
        ]);

        PendaftaranPasien::create([
            'user_id' => 1,
            'nomor_antrian' => 1,
            'status' => 'Telah Diperiksa',
            'dokter_id' => 7,
            'spesialis_id' => 1,
            'tipe_pembayaran' => 'umum',
            'jadwal_id' =>  3,
            'tanggal' => Carbon::parse(now())->format('Y-m-d')
        ]);
    }
}
