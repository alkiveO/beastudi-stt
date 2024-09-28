<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        Mahasiswa::create([
            'mhs_id' => '2024' . now()->format('his'),
            'nim' => '12345678',
            'email' => 'user@nf.mail',
            'password' => Hash::make('12345678'),
            'nama' => 'test user',
            'rombel' => 'ti01',
            'no_ktp' => '0987654321',
            'tahun_masuk' => '2024',
            'jenis_kelamin' => 'laki-laki',
            'no_kk' => '0987654321',
            'tanggal_lahir' => '01-01-1991',
            'agama' => 'islam',
            'program_studi' => 'sistem informasi',
            'jalur_beastudi' => 'yayasan',
            'provinsi' => 'sulawesi selatan',
            'kota' => 'makassar',
            'kecamatan' => 'manggala',
            'kelurahan' => 'tamangapa',
            'kode_pos' => '90235',
            'nomor_hp' => '0987654321',
            'nomor_hp_ortu' => '0987654321',
            'alamat' => 'ini alamat lengkap',
            'status' => true
        ]);
    }
}
