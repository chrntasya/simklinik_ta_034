<?php

namespace Database\Seeders;

use App\Models\TransaksiTelemedicine;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TransaksiTelemedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransaksiTelemedicine::insert([
            'pasien_id' => 3,
            'jadwaltelemedicine_id' => 3,
            'dokter_id' => 6,
            'spesialis_id' => 2,
            'jam_mulai' => Carbon::parse('08:00:00')->format('H:i:s'),
            'jam_akhir'=> Carbon::parse('17:00:00')->format('H:i:s'),
            'tanggal' => Carbon::parse(now())->format('Y-m-d'),
            'nominal' => 2070000,
            'status' => 'Terverifikasi',
            'bukti_pembayaran' => null,
            'nomor_antrian' => 1,
            'resepobattelemedicine_id' => null,
            'status_pengambilan_resep' => null
        ]);
    }
}
