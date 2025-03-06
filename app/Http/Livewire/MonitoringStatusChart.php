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

        $this->nim = request()->query('nim', null);
        $this->tahunAngkatan = request()->query('angkatan', $tahunMasuk->first());
        $this->tahunAjaran = request()->query('periode_id', Periode::latest()->first()->id ?? null);

        $this->loadChartData();
    }

    public function loadChartData($nim = null, $tahunAngkatan = null, $tahunAjaran = null)
    {
        $nim = $nim ?? $this->nim;
        $tahunAngkatan = $tahunAngkatan ?? $this->tahunAngkatan;
        $tahunAjaran = $tahunAjaran ?? $this->tahunAjaran;

        // Ambil daftar semester dari tabel Monitoring berdasarkan tahun angkatan dan tahun ajaran
        $semesters = Monitoring::query()
            ->whereHas('mahasiswa', fn($q) => $q->where('tahun_masuk', $tahunAngkatan))
            ->whereHas('periode', fn($q) => $q->where('id', $tahunAjaran))
            ->groupBy('semester')
            ->orderBy('semester')
            ->pluck('semester');

        $statusCounts = [
            'Aman' => [],
            'Evaluasi' => [],
            'Keluar' => [],
        ];

        foreach ($semesters as $semester) {
            foreach (array_keys($statusCounts) as $status) {
                $count = Monitoring::query()
                    ->whereHas('mahasiswa', fn($q) => $q->where('tahun_masuk', $tahunAngkatan))
                    ->whereHas('periode', fn($q) => $q->where('id', $tahunAjaran))
                    ->where('semester', $semester)
                    ->where('status_beastudi', strtolower($status))
                    ->count();

                $statusCounts[$status][] = $count;
            }
        }

        $this->chartData = [
            'labels' => $semesters,
            'datasets' => [
                [
                    'label' => 'Aman',
                    'data' => $statusCounts['Aman'],
                    'borderColor' => '#4CAF50',
                    'backgroundColor' => 'rgba(76, 175, 80, 0.2)',
                    'fill' => true
                ],
                [
                    'label' => 'Evaluasi',
                    'data' => $statusCounts['Evaluasi'],
                    'borderColor' => '#FF9800',
                    'backgroundColor' => 'rgba(255, 152, 0, 0.2)',
                    'fill' => true
                ],
                [
                    'label' => 'Keluar',
                    'data' => $statusCounts['Keluar'],
                    'borderColor' => '#F44336',
                    'backgroundColor' => 'rgba(244, 67, 54, 0.2)',
                    'fill' => true
                ],
            ],
        ];

        $this->emit('refreshMonitoringStatusChart', $this->chartData);
    }

    public function render()
    {
        return view('livewire.monitoring-status-chart', [
            'chartData' => $this->chartData,
        ]);
    }
}
