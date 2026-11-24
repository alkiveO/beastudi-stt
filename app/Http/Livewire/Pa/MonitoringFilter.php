<?php

namespace App\Http\Livewire\Pa;

use Livewire\Component;
use App\Models\Mahasiswa;
use App\Models\Periode;

class MonitoringFilter extends Component
{
    public $nim = '';
    public $tahunAngkatan = '';
    public $tahunAjaran = '';

    protected $queryString = [
        'nim' => ['except' => ''],
        'tahunAngkatan' => ['except' => '', 'as' => 'angkatan'],
        'tahunAjaran' => ['except' => '', 'as' => 'periode_id'],
    ];

    public function mount()
    {
        $paId = auth()->user()->pembimbing_akademik_id;

        if (!$paId) {
            return;
        }

        $tahunMasuk = Mahasiswa::query()
            ->where('pembimbing_akademik_id', $paId)
            ->whereNotNull('tahun_masuk')
            ->distinct()
            ->orderByDesc('tahun_masuk')
            ->pluck('tahun_masuk');

        $this->nim = request()->query('nim', '');

        $this->tahunAngkatan = request()->query(
            'angkatan',
            $tahunMasuk->first() ?? ''
        );

        $this->tahunAjaran = request()->query(
            'periode_id',
            Periode::latest()->value('id') ?? ''
        );

        $this->emitFilters();
    }

    public function updated($property)
    {
        $this->emitFilters();
    }

    private function emitFilters()
    {
        $this->emitTo(
            MonitoringStatusChart::class,
            'updateChart',
            $this->nim,
            $this->tahunAngkatan,
            $this->tahunAjaran
        );

        $this->emitTo(
            MonitoringChart::class,
            'updateChart',
            $this->nim,
            $this->tahunAngkatan,
            $this->tahunAjaran
        );

        $this->emitTo(
            PrestasiChart::class,
            'updateChart',
            $this->nim,
            $this->tahunAngkatan,
            $this->tahunAjaran
        );
    }

    public function render()
    {
        $paId = auth()->user()->pembimbing_akademik_id;

        $daftarTahunAngkatan = collect();

        if ($paId) {
            $daftarTahunAngkatan = Mahasiswa::query()
                ->where('pembimbing_akademik_id', $paId)
                ->whereNotNull('tahun_masuk')
                ->distinct()
                ->orderByDesc('tahun_masuk')
                ->pluck('tahun_masuk');
        }

        return view('livewire.monitoring-filter', [
            'daftarTahunAngkatan' => $daftarTahunAngkatan,
            'daftarTahunAjaran' => Periode::latest()->get(),
        ]);
    }
}