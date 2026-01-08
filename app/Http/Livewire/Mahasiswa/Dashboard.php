<?php


namespace App\Http\Livewire\Mahasiswa;

use App\Models\Monitoring;
use App\Models\Periode;
use App\Models\Evaluasi;
use Livewire\Component;

class Dashboard extends Component
{
    public $semester;
    public $periode_id;

    public $monitoring;

    public $textTypeMonitoring = 'text-secondary';
    public $textTypeBeastudi   = 'text-secondary';

    public $pesanMonitoring;
    public $pesanBeastudi;

    // 🔥 evaluasi
    public $jenisSp;
    public $keteranganEvaluasi;

    public function updatedSemester($value)
    {
        $this->semester = $value;
        $this->loadMonitoring();
    }

    public function updatedPeriodeId($value)
    {
        $this->periode_id = $value;
        $this->loadMonitoring();
    }

    protected function loadMonitoring()
    {
        // reset dulu
        $this->reset([
            'monitoring',
            'jenisSp',
            'keteranganEvaluasi',
        ]);

        if (!$this->semester || !$this->periode_id) {
            return;
        }

        $periode = Periode::find($this->periode_id);

        $this->monitoring = Monitoring::where('nim', auth()->guard('mahasiswa')->user()->nim)
            ->where('semester', $this->semester)
            ->where('periode_id', $this->periode_id)
            ->first();

        /**
         * =========================
         * BELUM ADA MONITORING
         * =========================
         */
        if (!$this->monitoring) {
            $this->textTypeMonitoring = 'text-danger fw-bold';
            $this->pesanMonitoring =
                'Kamu belum mengisi form performa pada semester '
                . $this->semester . ' periode ' . $periode->nama;

            $this->textTypeBeastudi = 'text-secondary';
            $this->pesanBeastudi =
                'Harap bersabar, Admin belum mengubah status beastudi Kamu';

            return;
        }

        /**
         * =========================
         * STATUS MONITORING
         * =========================
         */
        $this->textTypeMonitoring = 'text-success fw-bold';
        $this->pesanMonitoring =
            'Kamu sudah mengisi form performa pada semester '
            . $this->semester . ' periode T.A ' . $periode->nama;

        /**
         * =========================
         * STATUS BEASTUDI
         * =========================
         */
        if ($this->monitoring->status_beastudi === 'aman') {
            $this->textTypeBeastudi = 'text-success fw-bold';
              $this->pesanBeastudi = 'AMAN pada semester ' . $this->semester . ' periode T.A ' . Periode::find($this->periode_id)->nama;
        } elseif ($this->monitoring->status_beastudi === 'evaluasi') {
            $this->textTypeBeastudi = 'text-warning fw-bold';
             $this->pesanBeastudi = 'EVALUASI pada semester ' . $this->semester . ' periode T.A ' . Periode::find($this->periode_id)->nama;
        } elseif ($this->monitoring->status_beastudi === 'keluar') {
            $this->textTypeBeastudi = 'text-danger fw-bold';
             $this->pesanBeastudi = 'KELUAR pada semester ' . $this->semester . ' periode T.A ' . Periode::find($this->periode_id)->nama;
        } else {
            $this->textTypeBeastudi = 'text-secondary';
            $this->pesanBeastudi =
                'Harap bersabar, Admin belum mengubah status beastudi Kamu';
        }

        /**
         * =========================
         * 🔥 AMBIL EVALUASI TERAKHIR
         * =========================
         */
        $lastEvaluasi = Evaluasi::where('monitoring_id', $this->monitoring->id)
            ->orderBy('tanggal', 'desc')
            ->first();

        if ($lastEvaluasi) {
            $this->jenisSp = $lastEvaluasi->jenis_sp;
            $this->keteranganEvaluasi = $lastEvaluasi->keterangan;
        }
    }

    public function render()
    {
        return view('livewire.mahasiswa.dashboard', [
            'list_periode' => Periode::orderBy('nama')->get(),
        ]);
    }
}


// namespace App\Http\Livewire\Mahasiswa;

// use App\Models\Monitoring;
// use App\Models\Periode;
// use Livewire\Component;

// class Dashboard extends Component
// {
//     public $semester;
//     public $periode_id;

//     public $monitoring;
//     public $textTypeMonitoring;
//     public $textTypeBeastudi;
//     public $pesanMonitoring;
//     public $pesanBeastudi;

//     public function updatedSemester($value)
//     {
//         $this->semester = $value;

//         if ($this->semester && $this->periode_id) {
//             $this->getMonitoring();
//         }
//     }

//     public function updatedPeriodeId($value)
//     {
//         $this->periode_id = $value;

//         if ($this->semester && $this->periode_id) {
//             $this->getMonitoring();
//         }
//     }

//     public function getMonitoring()
//     {
//         $this->monitoring = Monitoring::query()
//             ->where('nim', auth()->guard('mahasiswa')->user()->nim)
//             ->where('semester', $this->semester)
//             ->where('periode_id', $this->periode_id)
//             ->first();

//         if (! $this->monitoring) {
//             $this->textTypeMonitoring = 'text-secondary';
//             $this->pesanMonitoring = 'Kamu belum mengisi form performa pada semester ' . $this->semester . ' periode ' . Periode::find($this->periode_id)->nama;
//             $this->textTypeBeastudi = 'text-secondary';
//             $this->pesanBeastudi = 'Harap bersabar, Admin belum mengubah status beastudi Kamu';
//         }

//         if ($this->monitoring) {
//             $this->textTypeMonitoring = 'text-success';
//             $this->pesanMonitoring = 'Kamu sudah mengisi form performa pada semester ' . $this->semester . ' periode T.A ' . Periode::find($this->periode_id)->nama;

//             if ($this->monitoring->status_beastudi == 'aman') {
//                 $this->textTypeBeastudi = 'text-success';
//                 $this->pesanBeastudi = 'AMAN pada semester ' . $this->semester . ' periode T.A ' . Periode::find($this->periode_id)->nama;
//             }  elseif ($this->monitoring->status_beastudi == 'evaluasi') {
//                 $this->textTypeBeastudi = 'text-warning';
//                 $this->pesanBeastudi = 'EVALUASI pada semester ' . $this->semester . ' periode T.A ' . Periode::find($this->periode_id)->nama;
//             } elseif ($this->monitoring->status_beastudi == 'keluar') {
//                 $this->textTypeBeastudi = 'text-danger';
//                 $this->pesanBeastudi = 'KELUAR pada semester ' . $this->semester . ' periode T.A ' . Periode::find($this->periode_id)->nama;
//             } else {
//                 $this->textTypeBeastudi = 'text-secondary';
//                 $this->pesanBeastudi = 'Harap bersabar, Admin belum mengubah status beastudi Kamu';
//             }
//         }
//     }

//     public function render()
//     {
//         return view('livewire.mahasiswa.dashboard', [
//             'list_periode' => Periode::all(),
//         ]);
//     }
// }
