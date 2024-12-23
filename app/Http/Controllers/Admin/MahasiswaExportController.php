<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\ExportMahasiswa;
use Maatwebsite\Excel\Facades\Excel;


class MahasiswaExportController extends Controller
{
    public function __invoke()
    {
        return Excel::download(new ExportMahasiswa, 'Master_Data_Dashboard_Mahasiswa_Beastudi_STT_Terpadu_Nurul_Fikri.xlsx');
    }
}
