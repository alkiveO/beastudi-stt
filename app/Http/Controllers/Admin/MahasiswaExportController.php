<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\ExportMahasiswa;
use Maatwebsite\Excel\Facades\Excel;


class MahasiswaExportController extends Controller
{
    public function __invoke()
    {
        return Excel::download(new ExportMahasiswa, 'Master Data Mahasiswa Beastudi STT Terpadu Nurul Fikri.xlsx');
    }
}
