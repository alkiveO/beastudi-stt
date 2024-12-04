<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class MahasiswaImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model(array $row)
    {
        abort_if(! array_key_exists('id', $row), 500);

        return Mahasiswa::updateOrCreate(
            ['mhs_id' => $row['id']],
            [
                'nama' => $row['nama'],
                'email' => $row['email_mahasiswa'],
                'password' => Hash::make($row['password']),
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

    public function chunkSize(): int
    {
        return 1000;
    }
}
