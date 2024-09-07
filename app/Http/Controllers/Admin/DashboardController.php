<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {

        $years = range(2012, date('Y')); // Rentang tahun dari 2012 hingga tahun saat ini
        $data = [];

        foreach ($years as $year) {
            $data[$year]['sistem informasi'] = Mahasiswa::where('tahun_masuk', $year)
                ->where('program_studi', 'sistem informasi')
                ->count(); // Menghitung jumlah mahasiswa di sistem informasi

            $data[$year]['teknik informatika'] = Mahasiswa::where('tahun_masuk', $year)
                ->where('program_studi', 'teknik informatika')
                ->count(); // Menghitung jumlah mahasiswa di teknik informatika

            $data[$year]['bisnis digital'] = Mahasiswa::where('tahun_masuk', $year)
                ->where('program_studi', 'bisnis digital')
                ->count(); // Menghitung jumlah mahasiswa di bisnis digital
        }

        $countAktif = Mahasiswa::where('status', 1)->count();
        $countTidakAktif = Mahasiswa::where('status', 0)->count();
        $countKeluar = Mahasiswa::where('status', 2)->count();

        return view('admin.dashboard', compact('countAktif', 'countTidakAktif', 'countKeluar', 'data'));
    }
}
