<?php

namespace Database\Seeders;

use App\Models\Redaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RedaksiSeeder extends Seeder
{
    public function run(): void
    {
        Redaksi::create([
            'jenis' => 'login page mahasiswa',
            'slug' => 'login-page-mahasiswa',
            'judul' => 'informasi beastudi',
            'deskripsi' => 'Smply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Smply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s when an unknown printerit to make a type specimen book. <br> <br> Smply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'
        ]);
    }
}
