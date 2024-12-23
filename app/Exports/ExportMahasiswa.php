<?php
namespace App\Exports;

use App\Models\Mahasiswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ExportMahasiswa implements FromView, WithEvents
{
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                foreach (range('A', 'Z') as $column) {
                    $sheet
                        ->getColumnDimension($column)
                        ->setAutoSize(true);
                }
            },
        ];
    }

    public function view(): View
    {
        $mahasiswas = Mahasiswa::query()
            ->orderBy('nama')
            ->get();

        return view('admin.export_excel', compact(
            'mahasiswas'
        ));
    }
}
