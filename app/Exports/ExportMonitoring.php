<?php

namespace App\Exports;

use App\Models\Matakuliah;
use App\Models\Monitoring;
use App\Models\Evaluasi;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class ExportMonitoring implements FromArray, WithHeadings, WithEvents
{
    protected $matakuliah;
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
        // Ambil daftar matakuliah untuk kolom dinamis
        $this->matakuliah = Matakuliah::orderBy('kode_mk')->get();
    }

    /**
     * REGISTER EVENTS
     * Memperbaiki error: range(): Argument #2 ($end) must be a single byte
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestColumn = $sheet->getHighestColumn();
                
                // Konversi string kolom (misal 'AA') ke index angka (misal 27)
                $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);

                // Loop menggunakan index angka untuk auto-size agar aman dari error byte
                for ($i = 1; $i <= $highestColumnIndex; $i++) {
                    $column = Coordinate::stringFromColumnIndex($i);
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                // Opsional: Beri gaya bold pada header baris pertama
                $sheet->getStyle('1')->getFont()->setBold(true);
            },
        ];
    }

    /**
     * HEADER EXCEL
     */
    public function headings(): array
    {
        $headers = [
            'NIM',
            'Nama',
        ];

        // Header matakuliah dinamis
        foreach ($this->matakuliah as $mk) {
            $headers[] = "{$mk->kode_mk} - {$mk->nama_mk} ({$mk->sks} SKS)";
        }

        return array_merge($headers, [
            'IPS',
            'IPK',
            'Kontribusi',
            'LPJ',
            'Hasil Final Evaluasi',
        ]);
    }

    /**
     * ISI DATA EXCEL
     */
    public function array(): array
    {
        $rows = [];

        $monitorings = Monitoring::query()
            ->with(['mahasiswa.krs.presensi', 'periode'])
            ->when($this->filters['nim'] ?? null, fn ($q, $v) =>
                $q->whereHas('mahasiswa', fn ($m) => $m->where('nim', 'like', "%$v%"))
            )
            ->when($this->filters['nama'] ?? null, fn ($q, $v) =>
                $q->whereHas('mahasiswa', fn ($m) => 
                    $m->whereRaw('LOWER(nama) LIKE ?', ['%' . strtolower($v) . '%'])
                )
            )
            ->when($this->filters['semester'] ?? null, fn ($q, $v) =>
                $q->where('semester', $v)
            )
            ->when($this->filters['periode'] ?? null, fn ($q, $v) =>
                $q->where('periode_id', $v)
            )
            ->when($this->filters['status_beastudi'] ?? null, fn ($q, $v) =>
                $q->where('status_beastudi', $v)
            )
            ->orderBy('id', 'asc')
            ->get();

        foreach ($monitorings as $monitoring) {
            $mhs = $monitoring->mahasiswa;
            if (!$mhs) continue;

            // Ambil evaluasi terakhir untuk kolom kontribusi
            $evaluasiTerakhir = Evaluasi::query()
                ->where('monitoring_id', $monitoring->id)
                ->orderByDesc('tanggal')
                ->first();

            // 1. Identitas
            $row = [
                $mhs->nim,
                $mhs->nama,
            ];

            // 2. Presensi Matakuliah (Kolom Dinamis)
            foreach ($this->matakuliah as $mk) {
                $krs = $mhs->krs
                    ->where('matakuliah_id', $mk->id)
                    ->where('periode_id', $monitoring->periode_id)
                    ->first();

                $row[] = $krs?->presensi?->total_hadir ?? 0;
            }

            // 3. Data Akademik & Monitoring
            $row[] = $monitoring->ips ?? '0';
            $row[] = $monitoring->ipk ?? '0';

            // Kontribusi
            if ($evaluasiTerakhir && $evaluasiTerakhir->kontribusi !== null) {
                $row[] = $evaluasiTerakhir->kontribusi === 'Tidak' ? 'Tidak Memenuhi' : 'Memenuhi';
            } else {
                $row[] = 'Menunggu Update';
            }

            // LPJ
            $row[] = $monitoring->file_lpj ? 'Ada' : 'Tidak Ada';

            // Status Beastudi (Mapping)
            $statusMap = [
                'aman'     => 'Aman',
                'evaluasi' => 'Evaluasi',
                'keluar'   => 'Keluar',
            ];

            $row[] = $statusMap[$monitoring->status_beastudi] ?? 'Menunggu Update';

            $rows[] = $row;
        }

        return $rows;
    }
}