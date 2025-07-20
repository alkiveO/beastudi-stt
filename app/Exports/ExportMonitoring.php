<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ExportMonitoring implements FromView, WithEvents, WithColumnFormatting
{
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $columns = array_merge(
                    range('A', 'Z'),
                    array_map(function($c) {
                        return 'A' . $c;
                    }, range('A', 'Z'))
                );

                foreach ($columns as $column) {
                    $sheet
                        ->getColumnDimension($column)
                        ->setAutoSize(true);
                }

                $sheet->getRowDimension('1')->setRowHeight(50);
            },
        ];
    }

    public function view(): View
    {
        ini_set('max_execution_time', 600); // Waktu dalam detik

        $mahasiswas = Mahasiswa::query()
            ->with(['monitorings'])
            ->orderBy('nama')
            ->get();

        return view('admin.exports.monitoring', compact(
            'mahasiswas'
        ));
    }
}
