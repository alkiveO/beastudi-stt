<?php

namespace App\Http\Livewire\Pa;

use App\Models\Mahasiswa;
use App\Models\Monitoring;
use App\Models\Periode;
use Livewire\Component;

class MonitoringChart extends Component
{
    public $nim;
    public $tahunAngkatan;
    public $tahunAjaran;
    public $chartData = [];

    protected $listeners = [
        'updateChart' => 'loadChartData',
    ];

    public function mount()
    {
        $paId = auth()->user()->pembimbing_akademik_id;

        $tahunMasuk = Mahasiswa::query()
            ->where('pembimbing_akademik_id', $paId)
            ->whereNotNull('tahun_masuk')
            ->distinct()
            ->orderByDesc('tahun_masuk')
            ->pluck('tahun_masuk');

        $this->nim = request()->query('nim');

        $this->tahunAngkatan = request()->query(
            'angkatan',
            $tahunMasuk->first()
        );

        $this->tahunAjaran = request()->query(
            'periode_id',
            Periode::latest()->value('id')
        );

        $this->loadChartData();
    }

    public function loadChartData(
        $nim = null,
        $tahunAngkatan = null,
        $tahunAjaran = null
    ) {
        $this->nim = $nim ?? $this->nim;
        $this->tahunAngkatan = $tahunAngkatan ?? $this->tahunAngkatan;
        $this->tahunAjaran = $tahunAjaran ?? $this->tahunAjaran;

        $paId = auth()->user()->pembimbing_akademik_id;

        $query = Monitoring::query()
            ->whereHas('mahasiswa', function ($mahasiswa) use ($paId) {
                $mahasiswa->where(
                    'pembimbing_akademik_id',
                    $paId
                );
            })
            ->when($this->nim, function ($query) {
                $query->where('nim', $this->nim);
            })
            ->when($this->tahunAngkatan, function ($query) {
                $query->whereHas('mahasiswa', function ($mahasiswa) {
                    $mahasiswa->where(
                        'tahun_masuk',
                        $this->tahunAngkatan
                    );
                });
            })
            ->when($this->tahunAjaran, function ($query) {
                $query->where('periode_id', $this->tahunAjaran);
            });

        $data = $query
            ->select('semester', 'ipk', 'ips')
            ->orderBy('semester')
            ->get()
            ->groupBy('semester');

        $semesters = range(1, 8);
        $ipkData = [];
        $ipsData = [];
        $jumlahMahasiswa = [];

        foreach ($semesters as $semester) {
            $semesterData = $data[$semester] ?? collect();

            $ipkData[] = $semesterData->avg('ipk');
            $ipsData[] = $semesterData->avg('ips');
            $jumlahMahasiswa[] = $semesterData->count();
        }

        $this->chartData = [
            'semesters' => $semesters,
            'ipk' => $ipkData,
            'ips' => $ipsData,
            'jumlahMahasiswa' => $jumlahMahasiswa,
        ];

        $this->emit(
            'refreshMonitoringChart',
            $this->chartData
        );
    }

    public function render()
    {
        return view('livewire.monitoring-chart', [
            'chartData' => $this->chartData,
        ]);
    }
}