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
            ['nama' => $nama = '2024 ganjil', 'slug' => Str::slug($nama)],
            ['nama' => $nama = '2024 genap', 'slug' => Str::slug($nama)],
            ['nama' => $nama = '2025 ganjil', 'slug' => Str::slug($nama)],
            ['nama' => $nama = '2025 genap', 'slug' => Str::slug($nama)],
            ['nama' => $nama = '2026 ganjil', 'slug' => Str::slug($nama)],
            ['nama' => $nama = '2026 genap', 'slug' => Str::slug($nama)],
        ]);
    }
}
