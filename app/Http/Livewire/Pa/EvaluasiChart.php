<?php

namespace App\Http\Livewire\Pa;

use Livewire\Component;
use App\Models\Evaluasi;
use App\Models\Mahasiswa;

class EvaluasiChart extends Component
{
    public $chartData = [];

    protected $listeners = [
        'refreshEvaluasiChart' => 'loadChart',
    ];

    public function mount()
    {
        $this->loadChart();
    }

    public function loadChart()
    {
        $paId = auth()->user()->pembimbing_akademik_id;

        $labels = [
            'SP1',
            'SP2',
            'SP3',
            'SP Terakhir',
        ];

        $programStudis = Mahasiswa::query()
            ->where('pembimbing_akademik_id', $paId)
            ->whereNotNull('program_studi')
            ->distinct()
            ->orderBy('program_studi')
            ->pluck('program_studi');

        $datasets = [];

        foreach ($programStudis as $prodi) {
            $rawData = Evaluasi::query()
                ->whereHas('mahasiswa', function ($query) use ($paId, $prodi) {
                    $query->where('pembimbing_akademik_id', $paId)
                        ->where('program_studi', $prodi);
                })
                ->selectRaw('jenis_sp, COUNT(*) as total')
                ->groupBy('jenis_sp')
                ->get()
                ->pluck('total', 'jenis_sp')
                ->toArray();

            $datasets[] = [
                'label' => $prodi,
                'data' => array_map(
                    fn ($label) => $rawData[$label] ?? 0,
                    $labels
                ),
            ];
        }

        $this->chartData = [
            'labels' => $labels,
            'datasets' => $datasets,
        ];

        $this->emit(
            'updateEvaluasiChart',
            $this->chartData
        );
    }

    public function render()
    {
        return view('livewire.admin.evaluasi-chart');
    }
}
