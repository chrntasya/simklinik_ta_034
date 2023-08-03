<?php

namespace Database\Seeders;

use App\Models\RujukanLab;
use Illuminate\Database\Seeder;

class RujukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RujukanLab::insert([
            [
                'kode' => '1',
                'jenis_pemeriksaan' => 'MRI',
                // 'pasien_id' => 5,
                'tempat_rujukan_id' => 1,
                // 'dokter_id' => 2,
                'rekamedis_id' => 2,
                'tglberkunjung' => '2014-03-07',
            ]
        ]);
    }
}
