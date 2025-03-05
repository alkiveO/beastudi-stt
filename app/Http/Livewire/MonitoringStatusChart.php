<?php

namespace App\Http\Livewire;

use App\Models\Periode;
use Livewire\Component;
use App\Models\Mahasiswa;
use App\Models\Monitoring;

class MonitoringStatusChart extends Component
{
    public $nim;
    public $tahunAngkatan;
    public $tahunAjaran;
    public $chartData = [];

    protected $listeners = ['updateChart' => 'loadChartData'];

    public function mount()
    {
        $tahunMasuk = Mahasiswa::select('tahun_masuk')
            ->groupBy('tahun_masuk')
            ->orderByDesc('tahun_masuk')
            ->pluck('tahun_masuk');

        $this->tahunAngkatan = $tahunMasuk[0];

        $this->tahunAjaran = Periode::latest()->first()->id;

        $this->loadChartData();
    }

    public function loadChartData($nim = null, $tahunAngkatan = null, $tahunAjaran = null)
    {
        $nim = $nim ?? $this->nim;
        $tahunAngkatan = $tahunAngkatan ?? $this->tahunAngkatan;
        $tahunAjaran = $tahunAjaran ?? $this->tahunAjaran;

        $monitoringData = Monitoring::query()
            ->when($nim, fn($query) => $query->where('nim', $nim))
            ->when($tahunAngkatan, fn($query) => $query->whereHas('mahasiswa', fn($q) => $q->where('tahun_masuk', $tahunAngkatan)))
            ->when($tahunAjaran, fn($query) => $query->whereHas('periode', fn($q) => $q->where('id', $tahunAjaran)))
            ->get();

        $statusCounts = [
            'Aman' => $monitoringData->where('status_beastudi', 'aman')->count(),
            'Evaluasi' => $monitoringData->where('status_beastudi', 'evaluasi')->count(),
            'Keluar' => $monitoringData->where('status_beastudi', 'keluar')->count(),
        ];

        $this->chartData = [
            'labels' => array_keys($statusCounts),
            'data' => array_values($statusCounts),
            'colors' => ['#4CAF50', '#FF9800', '#F44336'],
        ];

        $this->emit('refreshmonitoringStatusChart', $this->chartData);
    }

    public function render()
    {
        return view('livewire.monitoring-status-chart', [
            'chartData' => $this->chartData,
        ]);
    }
}
