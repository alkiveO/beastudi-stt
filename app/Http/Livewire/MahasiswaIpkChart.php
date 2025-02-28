<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Monitoring;

class MahasiswaIpkChart extends Component
{
    public $nim;
    public $chartData = [];

    public function mount()
    {
        $this->nim = auth()->user()->nim;

        $this->loadChartData();
    }

    public function loadChartData()
    {
        $data = Monitoring::query()
            ->where('nim', $this->nim)
            ->orderBy('semester', 'asc')
            ->get(['semester', 'ipk', 'ips']);

        $this->chartData = [
            'labels' => $data->pluck('semester')->toArray(),
            'ipk' => $data->pluck('ipk')->toArray(),
            'ips' => $data->pluck('ips')->toArray(),
        ];
    }

    public function render()
    {
        return view('livewire.mahasiswa-ipk-chart');
    }
}
