<?php

namespace Database\Seeders;

use App\Models\TempatRujukan;
use Illuminate\Database\Seeder;

class TempatRujukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TempatRujukan::insert([
            [
                'nama' => 'RSUD Iskak',
                'alamat' => 'Jl. Wahidin Sudiro Husodo',
            ]
        ]);
    }
}
