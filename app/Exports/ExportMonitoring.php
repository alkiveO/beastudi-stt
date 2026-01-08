<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Monitoring;
use App\Models\Evaluasi;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class ExportMonitoring implements FromArray, WithHeadings, WithEvents


{

   public function registerEvents(): array
{
    return [
        AfterSheet::class => function (AfterSheet $event) {

            $sheet = $event->sheet->getDelegate();

            // Auto size semua kolom yang terpakai
            foreach (range('A', $sheet->getHighestColumn()) as $column) {
                $sheet->getColumnDimension($column)->setAutoSize(true);
            }

        },
    ];
}

    protected $matakuliah;

    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
        $this->matakuliah = Matakuliah::orderBy('kode_mk')->get();
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

        // Header matakuliah (kode + nama + SKS)
        foreach ($this->matakuliah as $mk) {
            $headers[] = "{$mk->kode_mk} - {$mk->nama_mk} ({$mk->sks} SKS)";
        }

        return array_merge($headers, [
            'IPS',
            'IPK',
            'Kontribusi',
            'LPJ',
            'Hasil Final Evaluasi Semester Genap 2024/2025',
        ]);
    }

    /**
     * ISI DATA EXCEL
     */

  public function array(): array
{
    $rows = [];

    // 🔥 Ambil monitoring sesuai filter (sama seperti halaman)
    $monitorings = Monitoring::query()
        ->with([
            'mahasiswa.krs.presensi',
        ])
        ->when($this->filters['nim'] ?? null, fn ($q, $v) =>
            $q->whereHas('mahasiswa', fn ($m) =>
                $m->where('nim', 'like', "%$v%")
            )
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
        ->latest()
        ->get();

    foreach ($monitorings as $monitoring) {

        $mhs = $monitoring->mahasiswa;
        if (!$mhs) continue;
$evaluasiTerakhir = Evaluasi::query()
    ->where('monitoring_id', $monitoring->id)
    ->orderByDesc('tanggal')
    ->first();

        // ================= IDENTITAS =================
        $row = [
            $mhs->nim,
            $mhs->nama,
        ];

        // ================= PRESENSI PER MATAKULIAH =================
        foreach ($this->matakuliah as $mk) {

            $krs = $mhs->krs
                ->where('matakuliah_id', $mk->id)
                ->where('periode_id', $monitoring->periode_id)
                ->first();

            $row[] = $krs?->presensi?->total_hadir ?? 0;
        }

        // ================= DATA MONITORING =================
        $row[] = $monitoring->ips ?? '-';
        $row[] = $monitoring->ipk ?? '-';
if ($evaluasiTerakhir && $evaluasiTerakhir->kontribusi !== null) {
    $row[] = $evaluasiTerakhir->kontribusi === 'Tidak'
        ? 'Tidak Memenuhi'
        : 'Memenuhi';
} else {
    $row[] = 'Menunggu Update';
}

      $row[] = $monitoring->file_lpj ? 'Ada' : 'Tidak Ada';

// STATUS BEASTUDI
$statusMap = [
    'aman'     => 'Aman',
    'evaluasi' => 'Evaluasi',
    'keluar'   => 'Keluar',
];

$row[] = $monitoring->status_beastudi
    ? ($statusMap[$monitoring->status_beastudi] ?? 'Menunggu Update')
    : 'Menunggu Update';

        $rows[] = $row;
    }

    return $rows;
}


}

// namespace App\Exports;

// use App\Models\Mahasiswa;
// use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Events\AfterSheet;
// use Maatwebsite\Excel\Concerns\WithEvents;
// use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
// use Maatwebsite\Excel\Concerns\WithColumnFormatting;

// class ExportMonitoring implements FromView, WithEvents, WithColumnFormatting
// {
//     public function columnFormats(): array
//     {
//         return [
//             'B' => NumberFormat::FORMAT_NUMBER
//         ];
//     }

//     public function registerEvents(): array
//     {
//         return [
//             AfterSheet::class => function (AfterSheet $event) {
//                 $sheet = $event->sheet->getDelegate();

//                 $columns = array_merge(
//                     range('A', 'Z'),
//                     array_map(function($c) {
//                         return 'A' . $c;
//                     }, range('A', 'Z'))
//                 );

//                 foreach ($columns as $column) {
//                     $sheet
//                         ->getColumnDimension($column)
//                         ->setAutoSize(true);
//                 }

//                 $sheet->getRowDimension('1')->setRowHeight(50);
//             },
//         ];
//     }

//     public function view(): View
//     {
//         ini_set('max_execution_time', 600); // Waktu dalam detik

//         $mahasiswas = Mahasiswa::query()
//             ->with(['monitorings'])
//             ->whereHas('monitorings')
//             ->orderBy('nama')
//             ->get();

//         return view('admin.exports.monitoring', compact(
//             'mahasiswas'
//         ));
//     }
// }
