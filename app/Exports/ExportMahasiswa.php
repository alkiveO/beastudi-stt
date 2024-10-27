<?php
namespace App\Exports;

use App\Models\Mahasiswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ExportMahasiswa implements FromView
{
    public function view(): View
    {
        $mahasiswas = Mahasiswa::query()
            ->latest()
            ->get();

        return view('admin.export_excel', compact(
            'mahasiswas'
        ));
    }
}
