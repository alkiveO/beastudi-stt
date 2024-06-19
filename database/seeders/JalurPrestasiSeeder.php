<?php

namespace Database\Seeders;

use App\Models\JalurPrestasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JalurPrestasiSeeder extends Seeder
{
    public function run(): void
    {
        JalurPrestasi::insert([
            ['nama' => 'prestasi', 'slug' => 'prestasi'],
            ['nama' => 'hafidz quran', 'slug' => 'hafidz-quran'],
        ]);
    }
}
