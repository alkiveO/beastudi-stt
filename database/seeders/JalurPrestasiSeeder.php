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
            ['nama' => 'baznas depok', 'slug' => 'baznas-depok'],
            ['nama' => 'yayasan', 'slug' => 'yayasan'],
            ['nama' => 'kip kuliah', 'slug' => 'kip-kuliah'],
            ['nama' => 'bps', 'slug' => 'bps'],
        ]);
    }
}
