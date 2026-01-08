<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Monitoring;
use App\Models\Evaluasi;
use App\Models\Krs;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class SuratPeringatanController extends Controller
{
    public function cetak($monitoringId)
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();
Carbon::setLocale('id');
        /**
         * =========================
         * 1. VALIDASI MONITORING
         * (HARUS MILIK MAHASISWA LOGIN)
         * =========================
         */
        $monitoring = Monitoring::with(['periode'])
            ->where('id', $monitoringId)
            ->where('nim', $mahasiswa->nim)
            ->firstOrFail();

        /**
         * =========================
         * 2. EVALUASI TERAKHIR
         * =========================
         */
    $evaluasi = Evaluasi::where('monitoring_id', $monitoring->id)
            ->latest('tanggal')
            ->firstOrFail();

        /**
         * =========================
         * AMBIL PRESENSI PER MK
         * =========================
         */
        $krsList = Krs::with(['matakuliah', 'presensi'])
            ->where('mahasiswa_id', $monitoring->mahasiswa->id)
            ->where('periode_id', $monitoring->periode_id)
            ->get();

        $presensi = $krsList->map(function ($krs) {
            return [
                'nama_mk' => $krs->matakuliah->nama_mk,
                'hadir'   => $krs->presensi->total_hadir ?? 0,
                'total'   => $krs->presensi->total_pertemuan ?? 16,
            ];
        });

        /**
         * =========================
         * DATA PDF
         * =========================
         */
        $data = [
            'nama'        => $monitoring->mahasiswa->nama,
            'ipk'           => $monitoring->ipk,
            'ips'       => $monitoring->ips,
            'nim'         => $monitoring->mahasiswa->nim,
            'program_studi' => $monitoring->mahasiswa->program_studi,
            'semester'    => $monitoring->semester,
            'periode'     => $monitoring->periode->nama,

            'jenis_sp'    => $evaluasi->jenis_sp,
            'keterangan'  => $evaluasi->keterangan,
            'tanggal_surat' => $evaluasi->tanggal,
            'lpj' => $monitoring->file_lpj,

            'presensi'    => $presensi,
            'kontribusi' => $evaluasi->kontribusi,

            'nama_ketua'  => 'Ketua Satker Beastudi',
        ];


        /**
         * =========================
         * 5. GENERATE PDF
         * =========================
         */
   $pdf = Pdf::loadView('mahasiswa.surat-peringatan', $data)
    ->setPaper('A4', 'portrait');


        return $pdf->stream(
            'Surat_Peringatan_' . $mahasiswa->nim . '.pdf'
        );
    }

}
