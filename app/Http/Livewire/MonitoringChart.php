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
        $nim = $nim ?? $this->nim;
        $tahunAngkatan = $tahunAngkatan ?? $this->tahunAngkatan;
        $tahunAjaran = $tahunAjaran ?? $this->tahunAjaran;

        $query = Monitoring::query()
            ->when($nim, function ($query) use ($nim) {
                $query->where('nim', $nim);
            })
            ->when($tahunAjaran, function ($query) use ($tahunAjaran) {
                $query->whereHas('periode', function ($query) use ($tahunAjaran) {
                    $query->where('id', $tahunAjaran);
                });
            });

        $data = $query->select('semester', 'ipk', 'ips')
            ->orderBy('semester')
            ->get()
            ->groupBy('semester');

        // Daftar semester 1 - 8
        $semesters = range(1, 8);
        $ipkData = [];
        $ipsData = [];
        $jumlahMahasiswa = [];

        foreach ($semesters as $semester) {
            $semesterData = $data[$semester] ?? collect();

            $ipkData[] = $semesterData->avg('ipk') ?? null;
            $ipsData[] = $semesterData->avg('ips') ?? null;
            $jumlahMahasiswa[] = $semesterData->count(); // Hitung jumlah mahasiswa di semester ini
        }

        // Simpan data baru
        $this->chartData = [
            'semesters' => $semesters,
            'ipk' => $ipkData,
            'ips' => $ipsData,
            'jumlahMahasiswa' => $jumlahMahasiswa,
        ];

        $this->emit('refreshMonitoringChart', $this->chartData);
    }

    public function render()
    {
        return view('livewire.monitoring-chart', ['chartData' => $this->chartData]);
    }
}

