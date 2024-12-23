<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Mahasiswa;
use App\Models\Periode;

class DownloadSpbController extends Controller
{
    public function __invoke()
    {
        $mahasiswa = Mahasiswa::query()
            ->where('nim', request()->nim)
            ->first();

        $periode = Periode::find(request()->periode);

        $pdf = Pdf::loadView('pdf.spb', [
            'mahasiswa' => $mahasiswa,
            'periode' => $periode,
            'semester' => request()->semester,
        ]);

        $nama_file = 'SPB ' . $mahasiswa->nama . ' Semester ' . request()->semester . ' Periode ' . $periode->slug . '.pdf';

        return $pdf->download($nama_file);
    }
}
