<?php

namespace Database\Seeders;

use App\Models\Agama;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgamaSeeder extends Seeder
{
    public function run(): void
    {
        Agama::insert([
            ['nama' => 'islam'],
            ['nama' => 'kristen'],
            ['nama' => 'hindu'],
            ['nama' => 'buddha']
        ]);
    }
}
