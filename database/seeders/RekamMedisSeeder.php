<?php

namespace Database\Seeders;

use App\Models\Rekamedis;
use Illuminate\Database\Seeder;

class RekamMedisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rekamedis::insert([
            [
                'tanggal_pendaftaran' => '2014-03-01',
                'diagnosa' => 'Mual dan muntah makanan',
                'tindakan' => 'Minum obat dan vitamin',
                'pasien_id' => '1',
                'dokter_id' => '6',
                'suratketerangan' => 'tidak',
                'resep_obat_id' => '1',
            ],
            [
                'tanggal_pendaftaran' => '2014-03-02',
                'diagnosa' => 'Nyeri pinggul lebih dari sebulan',
                'tindakan' => 'Cek MRI',
                'pasien_id' => '5',
                'dokter_id' => '6',
                'suratketerangan' => 'ya',
                'resep_obat_id' => '2',
            ]
        ]);
    }
}
