<?php

namespace Database\Seeders;

use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProgramStudiSeeder extends Seeder
{
    public function run(): void
    {
        ProgramStudi::insert([
            ['nama' => 'teknik informatika', 'slug' => 'teknik-informatika'],
            ['nama' => 'sistem informasi', 'slug' => 'sistem-informasi'],
            ['nama' => 'digital marketing', 'slug' => 'digital-marketing'],
        ]);
    }
}
