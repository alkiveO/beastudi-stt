<?php

namespace Database\Seeders;

use App\Models\KontribusiKhusus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KontribusiSeeder extends Seeder
{
    public function run(): void
    {
        KontribusiKhusus::create(['nama' => 'kontribusi pertama', 'slug' => 'kontribusi-pertama']);
        KontribusiKhusus::create(['nama' => 'kontribusi kedua', 'slug' => 'kontribusi-kedua']);
    }
}
