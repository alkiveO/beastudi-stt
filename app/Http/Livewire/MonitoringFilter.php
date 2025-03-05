<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Mahasiswa;
use App\Models\Periode;
use App\Models\Monitoring;

class MonitoringFilter extends Component
{
    public $nim;
    public $tahunAngkatan;
    public $tahunAjaran;

    protected $queryString = [
        'nim' => ['except' => ''],
        'tahunAngkatan' => ['except' => '', 'as' => 'angkatan'],
        'tahunAjaran' => ['except' => '', 'as' => 'periode_id'],
    ];

    public function updated($property)
    {
        $this->emitTo(MonitoringStatusChart::class, 'updateChart', $this->nim, $this->tahunAngkatan, $this->tahunAjaran);
        $this->emitTo(MonitoringChart::class, 'updateChart', $this->nim, $this->tahunAngkatan, $this->tahunAjaran);
        $this->emitTo(PrestasiChart::class, 'updateChart', $this->nim, $this->tahunAngkatan, $this->tahunAjaran);
    }

    public function render()
    {
        return view('livewire.monitoring-filter', [
            'daftarTahunAngkatan' => Mahasiswa::selectRaw('tahun_masuk')
                ->distinct()
                ->orderByDesc('tahun_masuk')
                ->pluck('tahun_masuk'),
            'daftarTahunAjaran' => Periode::latest()->get()
        ]);
    }
}
