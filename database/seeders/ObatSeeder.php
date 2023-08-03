<?php

namespace Database\Seeders;

use App\Models\Obat;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Obat::insert([
            [
                'kode' => 'A1',
                'kategori_obat_id' => '1',
                'nama' => 'Gastrucid',
                'dosis' => '2x1',
                'satuan' => 'tablet',
                'harga' => '10000',
                'stok' => 99,
                'keterangan' => 'Diminum Sehari sekali',
                'tanggal_kadaluarsa' => Carbon::parse('2023-05-31')->format('Y-m-d')
                
            ],
            [
                'kode' => 'A2',
                'kategori_obat_id' => '2',
                'nama' => 'Biogesic',
                'dosis' => '3x1',
                'satuan' => 'botol',
                'harga' => '2000',
                'stok' => 99,
                'keterangan' => 'Diminum Sehari sekali',
                'tanggal_kadaluarsa' => Carbon::parse('2023-05-31')->format('Y-m-d')
            ]
        ]);
    }
}
