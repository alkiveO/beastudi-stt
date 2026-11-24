<?php

namespace App\Http\Livewire\Pa;

use Livewire\Component;
use App\Models\Mahasiswa;

class JalurBeastudiChart extends Component
{
    public $chartData = [];

    protected $listeners = [
        'refreshChart' => 'loadChartData',
    ];

    public function mount()
    {
        $this->loadChartData();
    }

    public function loadChartData()
    {
        $paId = auth()->user()->pembimbing_akademik_id;

        $data = Mahasiswa::query()
            ->where('pembimbing_akademik_id', $paId)
            ->selectRaw("
                CASE
                    WHEN jalur_beastudi IS NULL OR jalur_beastudi = ''
                        THEN 'Tidak Diketahui'
                    ELSE LOWER(jalur_beastudi)
                END AS jalur,
                CASE
                    WHEN program_studi IS NULL OR program_studi = ''
                        THEN 'Tidak Diketahui'
                    ELSE program_studi
                END AS program_studi,
                COUNT(*) AS total
            ")
            ->groupBy('jalur', 'program_studi')
            ->orderBy('jalur')
            ->get();

        $jalurList = $data->pluck('jalur')->unique()->values();
        $prodiList = $data->pluck('program_studi')->unique()->values();

        $labels = $jalurList->map(fn ($jalur) => ucwords($jalur));

        $datasets = [];

        foreach ($prodiList as $prodi) {
            $datasets[] = [
                'label' => $prodi,
                'data' => $jalurList->map(function ($jalur) use ($data, $prodi) {
                    return $data
                        ->where('jalur', $jalur)
                        ->where('program_studi', $prodi)
                        ->first()
                        ->total ?? 0;
                })->values(),
            ];
        }

        $this->chartData = [
            'labels' => $labels,
            'datasets' => $datasets,
        ];

        $this->emit(
            'updateJalurBeastudiChart',
            $this->chartData
        );
    }

    public function render()
    {
        return view('livewire.jalur-beastudi-chart', [
            'chartData' => $this->chartData,
        ]);
    }
}