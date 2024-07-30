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
            ['nama' => 'yayasan', 'slug' => 'yayasan'],
            ['nama' => 'kipk-k', 'slug' => 'kipk-k'],
            ['nama' => 'hafidz quran', 'slug' => 'hafidz-quran'],
        ]);
    }
}
