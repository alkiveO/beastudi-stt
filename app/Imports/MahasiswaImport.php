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
       ini_set('max_execution_time', 600); // Waktu dalam detik

        foreach ($rows as $row) {
            if (!isset($row['id'])) {
                continue;
            }

            Mahasiswa::updateOrCreate(
                ['mhs_id' => $row['id']],
                [
                    'nama' => $row['nama'],
                    'email' => $row['email_mahasiswa'],
                    'password' => ! is_null($row['password'])
                        ? Hash::make($row['password'])
                        : Hash::make('beastudi'),
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
}
