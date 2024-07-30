<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class MahasiswaImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model(array $row)
    {
        return Mahasiswa::updateOrCreate(
            ['nim' => $row['nim']],
            [
                'nama' => $row['nama'],
                'nim' => $row['nim'],
                'tahun_masuk' => $row['tahun_masuk'],
                'program_studi' => $row['program_studi'],
            ]
        );
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
