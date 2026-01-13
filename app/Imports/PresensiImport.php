<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\Monitoring;
use App\Models\Matakuliah;
use App\Models\Krs;
use App\Models\Presensi;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class PresensiImport implements ToCollection
{
    protected $programStudi;
    protected $periodeId;

    public function __construct($programStudi, $periodeId)
    {
      $this->programStudi = $this->mapProgramStudi($programStudi);
        $this->periodeId   = $periodeId;

        Log::info('[IMPORT] PresensiImport dijalankan', [
            'program_studi_raw' => $programStudi,
            'program_studi_db'  => $this->programStudi,
            'periode_id'        => $periodeId,
        ]);
    
    }
    protected function mapProgramStudi($value)
    {
        return match (strtoupper(trim($value))) {
            'TI' => 'teknik informatika',
            'SI' => 'sistem informasi',
            'MI' => 'manajemen informatika',
            default => strtolower($value),
        };
    }

    public function collection(Collection $rows)
    {
        Log::info('[IMPORT] Total baris excel', [
            'rows' => $rows->count()
        ]);

        if ($rows->count() <= 1) {
            Log::warning('[IMPORT] File excel kosong atau hanya header');
            return;
        }

        $header = $rows->first();
        $rows   = $rows->skip(1);

        Log::info('[IMPORT] Header kolom', $header->toArray());

        foreach ($rows as $rowIndex => $row) {

            Log::info('[IMPORT] Proses baris', [
                'row_index' => $rowIndex + 2, // +2 karena header & index mulai 0
                'row_data'  => $row->toArray()
            ]);

            $nim = trim($row[1] ?? null);

            if (!$nim) {
                Log::warning('[IMPORT] NIM kosong, skip baris', [
                    'row' => $rowIndex + 2
                ]);
                continue;
            }
Log::info('[IMPORT] Cari mahasiswa', [
    'nim' => $nim,
    'program_studi_db' => $this->programStudi,
]);

            // ===============================
            // MAHASISWA
            // ===============================
           $mahasiswa = Mahasiswa::where('nim', $nim)
    ->whereRaw('LOWER(program_studi) = ?', [$this->programStudi])
    ->first();


            if (!$mahasiswa) {
                Log::warning('[IMPORT] Mahasiswa tidak ditemukan', [
                    'nim' => $nim,
                    'program_studi' => $this->programStudi
                ]);
                continue;
            }

            // ===============================
            // MONITORING
            // ===============================
            $monitoring = Monitoring::where('nim', $nim)
                ->where('periode_id', $this->periodeId)
                ->first();

            if (!$monitoring) {
                Log::warning('[IMPORT] Monitoring tidak ditemukan', [
                    'nim'        => $nim,
                    'periode_id' => $this->periodeId
                ]);
                continue;
            }

            // ===============================
            // LOOP MATAKULIAH
            // ===============================
            for ($i = 5; $i < count($header); $i++) {

                $hadir = $row[$i] ?? null;

                if ($hadir === null || $hadir === '-') {
                    continue;
                }

                // Parsing header matkul
                preg_match('/^([A-Z0-9]+)\s-\s(.+)\((\d+)/', $header[$i], $match);

                if (!$match) {
                    Log::warning('[IMPORT] Format header matakuliah tidak valid', [
                        'header' => $header[$i],
                        'column' => $i
                    ]);
                    continue;
                }

                [$full, $kode, $nama, $sks] = $match;

                Log::info('[IMPORT] Matakuliah diproses', [
                    'nim'   => $nim,
                    'kode'  => $kode,
                    'nama'  => trim($nama),
                    'sks'   => $sks,
                    'hadir' => $hadir
                ]);

                // ===============================
                // MATAKULIAH
                // ===============================
                $matkul = Matakuliah::firstOrCreate(
                    ['kode_mk' => $kode],
                    [
                        'nama_mk' => trim($nama),
                        'sks'     => $sks
                    ]
                );

                // ===============================
                // KRS
                // ===============================
                $krs = Krs::firstOrCreate([
                    'mahasiswa_id'  => $mahasiswa->id,
                    'matakuliah_id' => $matkul->id,
                    'periode_id'    => $this->periodeId,
                ]);

                // ===============================
                // PRESENSI
                // ===============================
                Presensi::updateOrCreate(
                    ['krs_id' => $krs->id],
                    [
                        'total_pertemuan' => 16,
                        'total_hadir'     => (int) $hadir
                    ]
                );
            }
        }

        Log::info('[IMPORT] Proses import selesai');
    }
}
