<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ExportMonitoring;
use Maatwebsite\Excel\Facades\Excel;
class ExportController extends Controller
{
    //
   public function exportMonitoring(Request $request) 
{
    // Jangan tambahkan pengecekan PengMonitoring::first() di sini 
    // jika ingin admin bisa download kapan saja.

    if (ob_get_level() > 0) ob_end_clean();

    return Excel::download(
        new ExportMonitoring([
            'nim'             => $request->nim,
            'nama'            => $request->nama,
            'semester'        => $request->semester,
            'periode'         => $request->periode,
            'status_beastudi' => $request->status_beastudi,
        ]), 
        'Monitoring Beastudi.xlsx'
    );
}
}
