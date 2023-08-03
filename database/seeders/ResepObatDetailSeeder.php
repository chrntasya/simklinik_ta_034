<?php

namespace Database\Seeders;

use App\Models\ResepObatDetail;
use Illuminate\Database\Seeder;

class ResepObatDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ResepObatDetail::insert([
            [
                // 'keterangan_obat' => 'Pagi dan malam',
                'jumlah_obat' => '10',
                'id_obat' => '1',
                'id_resep_obat' => '1',
            ],
            [
                // 'keterangan_obat' => 'Sebelum makan',
                'jumlah_obat' => '3',
                'id_obat' => '2',
                'id_resep_obat' => '1',
            ],
        ]);
    }
}
