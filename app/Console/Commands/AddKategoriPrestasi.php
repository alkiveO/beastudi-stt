<?php

namespace App\Console\Commands;

use App\Models\KategoriPrestasi;
use Illuminate\Console\Command;

class AddKategoriPrestasi extends Command
{
    protected $signature = 'app:add-kategori-prestasi';

    protected $description = 'Create kategori prestasi';

    public function handle()
    {
        KategoriPrestasi::insert([
            ['nama' => 'PKM Kemendikbud'],
            ['nama' => 'PKM Internal Kampus'],
            ['nama' => 'Lomba Nasional/Lembaga Resmi'],
            ['nama' => 'Lomba Regional/Daerah'],
            ['nama' => 'Lomba Internal Kampus'],
            ['nama' => 'Lomba Non-Akademik'],
        ]);
    }
}
