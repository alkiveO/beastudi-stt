<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProgramStudiSeeder::class,
            JalurPrestasiSeeder::class,
            MahasiswaSeeder::class,
            AgamaSeeder::class,
            IndoRegionSeeder::class,
            PembimbingAkademikSeeder::class,
            PeriodeSeeder::class,
            KontribusiSeeder::class,
            RedaksiSeeder::class
        ]);
    }
}
