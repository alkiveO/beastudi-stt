<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Evaluasi;
use App\Models\Mahasiswa;

class EvaluasiChart extends Component
{
    public $chartData = [];

    protected $listeners = ['refreshEvaluasiChart'];

    public function mount()
    {
        $this->loadChart();
    }

    public function loadChart()
    {
        // 🔹 Urutan label SP (fix)
        $labels = ['SP1', 'SP2', 'SP3', 'SP Terakhir'];

        // 🔹 Ambil semua program studi
        $programStudis = Mahasiswa::select('program_studi')
            ->distinct()
            ->orderBy('program_studi')
            ->pluck('program_studi');

        $datasets = [];

        foreach ($programStudis as $prodi) {

            // 🔹 Hitung jumlah SP per jenis untuk setiap prodi
            $rawData = Evaluasi::query()
                ->join('mahasiswa', 'mahasiswa.id', '=', 'evaluasi.mahasiswa_id')
                ->where('mahasiswa.program_studi', $prodi)
                ->selectRaw('evaluasi.jenis_sp, COUNT(*) as total')
                ->groupBy('evaluasi.jenis_sp')
                ->get()
                ->pluck('total', 'jenis_sp')
                ->toArray();

            $datasets[] = [
                'label' => $prodi, // 🔥 ini yang tampil di legend
                'data'  => array_map(fn ($l) => $rawData[$l] ?? 0, $labels),
            ];
        }

        $this->chartData = [
            'labels'   => $labels,
            'datasets' => $datasets,
        ];

        // 🔄 trigger update chart
        $this->emit('updateEvaluasiChart', $this->chartData);
    }

    public function render()
    {
        return view('livewire.admin.evaluasi-chart');
    }
}
