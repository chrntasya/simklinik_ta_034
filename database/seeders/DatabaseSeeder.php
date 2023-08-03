<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            SpesialisSeeder::class,
            UserSpesialisSeeder::class,
            KategoriObatSeeder::class,
            ObatSeeder::class,
            ResepObatSeeder::class,
            ResepObatDetailSeeder::class,
            RekamMedisSeeder::class,
            TempatRujukanSeeder::class,
            RujukanSeeder::class,
            JadwalDokterSeeder::class,
            AppointmentSeeder::class,
            JadwalTelemedicineSeeder::class,
            TransaksiTelemedicineSeeder::class
        ]);
    }
}
