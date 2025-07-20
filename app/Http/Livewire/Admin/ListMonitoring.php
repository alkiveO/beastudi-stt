<?php

namespace App\Http\Livewire\Admin;

use App\Models\Periode;
use Livewire\Component;
use App\Models\Monitoring;
use Livewire\WithPagination;

class ListMonitoring extends Component
{
    use WithPagination;

    public $nim;
    public $nama;
    public $semester;
    public $periode;
    public $status_beastudi;

    protected $queryString = [
        'nim' => ['except' => ''],
        'nama' => ['except' => ''],
        'semester' => ['except' => ''],
        'periode' => ['except' => ''],
        'status_beastudi' => ['except' => ''],
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
            'list_periode' => Periode::latest()->get(),
            'monitoring' => Monitoring::query()
                ->with('mahasiswa')
                ->when($this->nim, function ($query) {
                    $query->whereHas('mahasiswa', function ($query) {
                        $query->where('nim', 'like', '%' . $this->nim . '%');
                    });
                })
                ->when($this->nama, function ($query) {
                    $query->whereHas('mahasiswa', function ($query) {
                        $query->whereRaw('lower(nama) like ?', ['%' . strtolower($this->nama) . '%']);
                    });
                })
                ->when($this->status_beastudi, function ($query) {
                    $query->where('status_beastudi', $this->status_beastudi);
                })
                ->where('semester', $this->semester)
                ->where('periode_id', $this->periode)
                ->paginate(10),
        ]);
    }
}
