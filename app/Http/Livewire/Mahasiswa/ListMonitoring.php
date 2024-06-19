<?php

namespace App\Http\Livewire\Mahasiswa;

use App\Models\Monitoring;
use Livewire\Component;

class ListMonitoring extends Component
{
    protected $listeners = [
        'refreshPage' => '$refresh'
    ];

    public function render()
    {
        $monitoring = Monitoring::query()
            ->latest()
            ->get();

        return view('livewire.mahasiswa.list-monitoring', [
            'monitoring' => $monitoring
        ]);
    }
}
