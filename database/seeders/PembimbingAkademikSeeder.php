<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PembimbingAkademik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PembimbingAkademikSeeder extends Seeder
{
    public function run(): void
    {
        PembimbingAkademik::insert([
            ['nama' => 'Dr. Sirojul Munir, S.Si, M.Kom', 'program_studi' => 'teknik informatika'],
            ['nama' => 'Ahmad Rio Adriansyah, S.Si. M.Si', 'program_studi' => 'teknik informatika'],
            ['nama' => 'Tubagus Rizky Dharmawan, S.T, M.Sc', 'program_studi' => 'teknik informatika'],
            ['nama' => 'Tifani Nabarian, S.Kom, M.T.I', 'program_studi' => 'teknik informatika'],
            ['nama' => 'Reza Primardiansyah, S.T, M.Kom', 'program_studi' => 'teknik informatika'],
            ['nama' => 'Henry Saptono, S.Si, M.Kom', 'program_studi' => 'teknik informatika'],
            ['nama' => 'HILMY ABIDZAR TAWAKAL, S.T, M.Kom', 'program_studi' => 'teknik informatika'],
            ['nama' => 'SALMAN EL FARISI, S.Kom, M.Kom', 'program_studi' => 'teknik informatika'],
            ['nama' => 'Dr. Sigit Puspito Wigati Jarot, S.T., M.Sc', 'program_studi' => 'teknik informatika'],
            ['nama' => 'ZAKI IMADUDDIN, S.T, M.Kom', 'program_studi' => 'teknik informatika'],
            ['nama' => 'NASRUL, S.Kom, M.Kom', 'program_studi' => 'teknik informatika'],

            ['nama' => 'Dr. AMALIA RAHMAH, S.T, M.T', 'program_studi' => 'sistem informasi'],
            ['nama' => 'MISNA ASQIA, S.Kom, M.Kom', 'program_studi' => 'sistem informasi'],
            ['nama' => 'BACHTIAR FIRDAUS, S.T, M.P', 'program_studi' => 'sistem informasi'],
            ['nama' => 'KURNIAWAN DWI PRASETYO, S.T, M.T', 'program_studi' => 'sistem informasi'],
            ['nama' => 'NUGROHO DWI SAPUTRA, S.Kom, M.Ti', 'program_studi' => 'sistem informasi'],
            ['nama' => 'Drs. RUSMANTO, M.M', 'program_studi' => 'sistem informasi'],
            ['nama' => 'SAPTO WALUYO, S.Sos, M.Sc', 'program_studi' => 'sistem informasi'],
            ['nama' => 'SUHENDI, M.M.S.I, S.T', 'program_studi' => 'sistem informasi'],
            ['nama' => 'WARSONO, S.Kom, M.Ti', 'program_studi' => 'sistem informasi'],
            ['nama' => 'YEKTI WIRANI, S.T, M.Ti', 'program_studi' => 'sistem informasi'],
            ['nama' => 'DEDY ACHMADI, S.T, M.T', 'program_studi' => 'sistem informasi'],

            ['nama' => 'Davied Wahyu Wismanindra, S.Kom., M.M', 'program_studi' => 'bisnis digital'],
            ['nama' => 'Krisna Panji, S.Kom., M.M', 'program_studi' => 'bisnis digital'],
            ['nama' => 'Tri Mukhlison Anugrah, S.E., M.M', 'program_studi' => 'bisnis digital'],
            ['nama' => 'Betty Amalia, S.E., M.M', 'program_studi' => 'bisnis digital'],
            ['nama' => 'Fitrah Rachmat Kautsar, S.TP., M.E', 'program_studi' => 'bisnis digital'],
            ['nama' => 'Agus Prasetro M, S.E.,M.M', 'program_studi' => 'bisnis digital']
        ]);
    }
}
