<?php

namespace Database\Seeders;

use App\Models\KategoriObat;
use Illuminate\Database\Seeder;

class KategoriObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KategoriObat::insert([
            [
                'kode' => '0012',
                'nama' => 'Antasida',
            ],
            [
                'kode' => '0013',
                'nama' => 'Analgetik',
            ]
        ]);
    }
}
