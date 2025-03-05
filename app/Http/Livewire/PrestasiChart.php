<?php

namespace App\Http\Livewire;

use App\Models\Periode;
use Livewire\Component;
use App\Models\Prestasi;
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
        $this->tahunAjaran = Periode::latest()->first()->id;

        $this->loadChartData();
    }

    public function loadChartData($nim = null, $tahunAngkatan = null, $tahunAjaran = null)
    {
        // Update nilai properti jika ada parameter baru
        $this->nim = $nim ?? $this->nim;
        $this->tahunAngkatan = $tahunAngkatan ?? $this->tahunAngkatan;
        $this->tahunAjaran = $tahunAjaran ?? $this->tahunAjaran;

        $prestasiData = Prestasi::query()
            ->when($this->nim, function ($query) {
                return $query->where('nim', $this->nim);
            })
            ->when($this->tahunAngkatan, function ($query) {
                return $query->whereHas('mahasiswa', function ($q) {
                    $q->where('tahun_masuk', $this->tahunAngkatan);
                });
            })
            ->when($this->tahunAjaran, function ($query) {
                return $query->where('periode_id', $this->tahunAjaran);
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

