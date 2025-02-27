<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Monitoring;
use App\Models\Periode;

class MonitoringChart extends Component
{
    public $nim;
    public $tahunAngkatan;
    public $tahunAjaran;
    public $chartData = [];

    protected $listeners = ['updateChart' => 'loadChartData'];

    public function mount()
    {
        $this->tahunAjaran = Periode::latest()->first()->id;

        $this->loadChartData();
    }

    public function loadChartData($nim = null, $tahunAngkatan = null, $tahunAjaran = null)
    {
        // Gunakan nilai default jika tidak ada parameter
        $nim = $nim ?? $this->nim;
        $tahunAngkatan = $tahunAngkatan ?? $this->tahunAngkatan;
        $tahunAjaran = $tahunAjaran ?? $this->tahunAjaran;

        // Query dengan filter
        $query = Monitoring::query();

        if ($nim) {
            $query->where('nim', $nim);
        }

        if ($tahunAjaran) {
            $query->whereHas('periode', function ($q) use ($tahunAjaran) {
                $q->where('id', $tahunAjaran);
            });
        }

        // Ambil data monitoring
        $data = $query->select('semester', 'ipk', 'ips')
            ->orderBy('semester')
            ->get()
            ->keyBy('semester');

        // Daftar semester 1 - 8
        $semesters = range(1, 8);
        $ipkData = [];
        $ipsData = [];

        foreach ($semesters as $semester) {
            $ipkData[] = $data[$semester]->ipk ?? null;
            $ipsData[] = $data[$semester]->ips ?? null;
        }

        // Simpan data baru
        $this->chartData = [
            'semesters' => $semesters,
            'ipk' => $ipkData,
            'ips' => $ipsData,
        ];

        $this->emit('refreshMonitoringChart', $this->chartData);
    }

    public function render()
    {
        return view('livewire.monitoring-chart', ['chartData' => $this->chartData]);
    }
}

