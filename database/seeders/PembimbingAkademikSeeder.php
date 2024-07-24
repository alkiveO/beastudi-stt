<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PembimbingAkademik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PembimbingAkademikSeeder extends Seeder
{
    public function run(): void
    {
        PembimbingAkademik::insert([
            ['nama' => 'Dosen 1'],
            ['nama' => 'Dosen 2'],
        ]);
    }
}
