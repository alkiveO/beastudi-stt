<?php

namespace App\Http\Controllers\Admin;

use App\Models\Periode;
use App\Models\Mahasiswa;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class DownloadLpjController extends Controller
{
    public function __invoke()
    {
        $mahasiswa = Mahasiswa::query()
            ->where('nim', request()->nim)
            ->first();

        $periode = Periode::find(request()->periode);

        $pdf = Pdf::loadView('pdf.lpj', [
            'mahasiswa' => $mahasiswa,
            'periode' => $periode,
            'semester' => request()->semester,
        ]);

        $nama_file = 'LPJ ' . $mahasiswa->nama . ' Semester ' . request()->semester . ' Periode ' . $periode->slug . '.pdf';

        return $pdf->download($nama_file);
    }
}
