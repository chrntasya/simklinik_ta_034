<?php

namespace Database\Seeders;

use App\Models\ResepObat;
use Illuminate\Database\Seeder;

class ResepObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ResepObat::insert([
            [
                'kode' => 'RO001',
                'tanggal_resep' => '01/08/2014',
                'status' => 'Lama'
            ],
            [
                'kode' => 'RO002',
                'tanggal_resep' => '2/08/2014',
                'status' => 'Lama'
            ],
        ]);
    }
}
