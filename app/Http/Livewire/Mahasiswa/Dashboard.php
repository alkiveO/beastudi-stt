<?php

namespace App\Http\Livewire\Mahasiswa;

use App\Models\Monitoring;
use App\Models\Periode;
use Livewire\Component;

class Dashboard extends Component
{
    public $semester;
    public $periode_id;

    public $monitoring;
    public $textTypeMonitoring;
    public $textTypeBeastudi;
    public $pesanMonitoring;
    public $pesanBeastudi;

    public function updatedSemester($value)
    {
        $this->semester = $value;

        if ($this->semester && $this->periode_id) {
            $this->getMonitoring();
        }
    }

    public function updatedPeriodeId($value)
    {
        $this->periode_id = $value;

        if ($this->semester && $this->periode_id) {
            $this->getMonitoring();
        }
    }

    public function getMonitoring()
    {
        $this->monitoring = Monitoring::query()
            ->where('nim', auth()->guard('mahasiswa')->user()->nim)
            ->where('semester', $this->semester)
            ->where('periode_id', $this->periode_id)
            ->first();

        if (! $this->monitoring) {
            $this->textTypeMonitoring = 'text-secondary';
            $this->pesanMonitoring = 'Kamu belum mengisi form performa pada semester ' . $this->semester . ' periode ' . Periode::find($this->periode_id)->nama;
            $this->textTypeBeastudi = 'text-secondary';
            $this->pesanBeastudi = 'Harap bersabar, Admin belum mengubah status beastudi Kamu';
        }

        if ($this->monitoring) {
            $this->textTypeMonitoring = 'text-success';
            $this->pesanMonitoring = 'Kamu sudah mengisi form performa pada semester ' . $this->semester . ' periode ' . Periode::find($this->periode_id)->nama;

            if ($this->monitoring->status_beastudi == 'aman') {
                $this->textTypeBeastudi = 'text-success';
                $this->pesanBeastudi = 'Yeayy status beastudi kamu ' . strtoupper($this->monitoring->status_beastudi) . ' pada semester ' . $this->semester . ' periode ' . Periode::find($this->periode_id)->nama;
            }  elseif ($this->monitoring->status_beastudi == 'evaluasi') {
                $this->textTypeBeastudi = 'text-info';
                $this->pesanBeastudi = 'Kamu memperoleh status ' . strtoupper($this->monitoring->status_beastudi) . ' pada semester ' . $this->semester . ' periode ' . Periode::find($this->periode_id)->nama;
            } elseif ($this->monitoring->status_beastudi == 'keluar') {
                $this->textTypeBeastudi = 'text-secondary';
                $this->pesanBeastudi = 'Kamu di keluarkan dari beastudi pada semester ' . $this->semester . ' periode ' . Periode::find($this->periode_id)->nama;
            } else {
                $this->textTypeBeastudi = 'text-secondary';
                $this->pesanBeastudi = 'Harap bersabar, Admin belum mengubah status beastudi Kamu';
            }
        }
    }

    public function render()
    {
        return view('livewire.mahasiswa.dashboard', [
            'list_periode' => Periode::all(),
        ]);
    }
}
