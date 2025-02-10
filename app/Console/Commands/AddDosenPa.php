<?php

namespace App\Console\Commands;

use App\Models\PembimbingAkademik;
use Illuminate\Console\Command;

class AddDosenPa extends Command
{
    protected $signature = 'app:add-dosen-pa';

    protected $description = 'add dosen pa';

    public function handle()
    {
        PembimbingAkademik::insert([
            [
                'nama' => 'Reza Maulana, S.Kom., M.Kom',
                'program_studi' => 'teknik informatika',
            ],
            [
                'nama' => 'Edi Wibowo, S.E., M.M',
                'program_studi' => 'sistem informasi',
            ]
        ]);
    }
}
