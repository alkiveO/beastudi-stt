<?php

namespace Database\Seeders;

use App\Models\Periode;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PeriodeSeeder extends Seeder
{
    public function run(): void
    {
        Periode::insert([
            ['nama' => $nama = '2024/2025', 'slug' => '2024-2025'],
            ['nama' => $nama = '2025/2026', 'slug' => '2025/2026'],
        ]);
    }
}
