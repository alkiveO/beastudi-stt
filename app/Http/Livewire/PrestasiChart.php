<?php

namespace App\Http\Livewire;

use App\Models\Periode;
use Livewire\Component;
use App\Models\Prestasi;
use App\Models\Mahasiswa;
use App\Models\KategoriPrestasi;

class PrestasiChart extends Component
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

        $prestasiData = Prestasi::query()
            ->when($nim, function ($query) use ($nim) {
                return $query->where('nim', $nim);
            })
            ->when($tahunAngkatan, function ($query) use ($tahunAngkatan) {
                return $query->whereHas('mahasiswa', function ($q) use ($tahunAngkatan) {
                    $q->where('tahun_masuk', $tahunAngkatan);
                });
            })
            ->when($tahunAjaran, function ($query) use ($tahunAjaran) {
                return $query->where('periode_id', $tahunAjaran);
            })
            ->get();

        $semesters = range(1, 8);
        $kategoriPrestasi = KategoriPrestasi::pluck('nama', 'id');
        $kategoriPrestasi["null"] = "Tanpa Kategori";

        $data = [];
        foreach ($semesters as $semester) {
            $data[$semester] = [];
            foreach ($kategoriPrestasi as $id => $kategori) {
                $data[$semester][$id] = $prestasiData
                    ->where('semester', $semester)
                    ->where('kategori_prestasi_id', $id === "null" ? null : $id)
                    ->count();
            }
        }

        $this->chartData = [
            'semesters' => $semesters,
            'categories' => $kategoriPrestasi,
            'data' => $data,
        ];

        $this->emit('refreshPrestasiChart', $this->chartData);
    }

    public function render()
    {
        return view('livewire.prestasi-chart', [
            'chartData' => $this->chartData,
        ]);
    }
}

