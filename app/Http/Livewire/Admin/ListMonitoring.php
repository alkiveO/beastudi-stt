<?php

namespace App\Http\Livewire\Admin;

use App\Models\Periode;
use Livewire\Component;
use App\Models\Monitoring;

class ListMonitoring extends Component
{
    public $semester;
    public $periode;

    protected $queryString = [
        'semester' => ['except' => ''],
        'periode' => ['except' => ''],
    ];

    public function mount()
    {
        $this->semester = 1;
        $this->periode = Periode::latest()->first()->id;
    }

    public function updatedSemester($value)
    {
        $this->semester = $value;
    }

    public function updatedPeriode($value)
    {
        $this->periode = $value;
    }

    public function render()
    {
        return view('livewire.admin.list-monitoring', [
            'list_periode' => Periode::all(),
            'monitoring' => Monitoring::query()
                ->with('mahasiswa')
                ->where('semester', $this->semester)
                ->where('periode_id', $this->periode)
                ->paginate(10),
        ]);
    }
}
