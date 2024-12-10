<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class MahasiswaImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue
{
    public function collection(Collection $rows)
    {
        // TODO: gunakan pendekatan lain
        // butuh waktu sekitar 3 menit utk
        // import sebanyak 600 data

        ini_set('max_execution_time', 600); // Waktu dalam detik

        foreach ($rows as $row) {
            if (! isset($row['id'])) {
                continue;
            }

            // Cek apakah password adalah hash atau plain text
            $password = $row['password'] ?? '';
            if (! empty($password) && ! $this->isPasswordHashed($password)) {
                $password = Hash::make($password);
            } elseif (empty($password)) {
                $password = Hash::make('beastudi');
            }

            Mahasiswa::updateOrCreate(
                ['mhs_id' => $row['id']],
                [
                    'nama' => $row['nama'],
                    'email' => $row['email_mahasiswa'],
                    'password' => $password,
                    'nim' => $row['nim'],
                    'tahun_masuk' => $row['angkatan'],
                    'program_studi' => strtolower($row['program_studi']),
                    'rombel' => $row['rombongan_belajar'],
                    'jalur_beastudi' => strtolower($row['jalur_beasiswa']),
                    'nomor_hp' => $row['no_hpwa'],
                    'kecamatan' => strtoupper($row['kecamatan']),
                    'kelurahan' => strtoupper($row['kelurahan']),
                    'kota' => strtoupper($row['kabupaten']),
                    'provinsi' => strtoupper($row['provinsi']),
                    'kode_pos' => $row['kode_pos'],
                    'no_ktp' => $row['nonik'],
                    'no_kk' => $row['nokk'],
                    'no_ktp_kepala_keluarga' => $row['nik_kepala_keluarga'],
                    'nama_kepala_keluarga' => $row['nama_kepala_keluarga_sesuai_kk'],
                    'status' => true
                ]
            );
        }
    }

    public function chunkSize(): int
    {
        return 100;
    }

    private function isPasswordHashed($password)
    {
        // Check if the password is hashed (assuming hash is 60 characters long, for bcrypt)
        return strlen($password) === 60 && preg_match('/^\$2[ayb]\$.{56}$/', $password);
    }
}
