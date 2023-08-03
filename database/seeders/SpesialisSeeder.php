<?php

namespace Database\Seeders;

use App\Models\Spesialis;
use Illuminate\Database\Seeder;

class SpesialisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Spesialis::insert([
           [
               'kode' => 'SP001',
               'nama' => 'Penyakit Dalam',
           ]
        ]);

        Spesialis::insert([
            [
                'kode' => 'SP002',
                'nama' => 'Penyakit Luar',
            ]
         ]);

         Spesialis::insert([
            [
                'kode' => 'SP003',
                'nama' => 'Penyakit Kulit',
            ]
         ]);
    }
}
