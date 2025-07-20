<?php

namespace App\Http\Livewire\Admin;

use App\Models\Periode;
use Livewire\Component;
use App\Models\Monitoring;
use Livewire\WithPagination;
use App\Exports\ExportMonitoring;
use App\Models\Mahasiswa;
use Maatwebsite\Excel\Facades\Excel;

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

    public function updatedSemester($value)
    {
        $this->semester = $value;
    }

    public function updatedPeriode($value)
    {
        $this->periode = $value;
    }

    public function download()
    {
        return Excel::download(new ExportMonitoring(), 'Monitoring Beastudi.xlsx');
    }

    public function render()
    {
        return view('livewire.admin.list-monitoring', [
            'list_periode' => Periode::latest()->get(),
            'mahasiswa' => Mahasiswa::query()
                ->with([
                    'monitorings' => function ($q) {
                        if ($this->semester) {
                            $q->where('semester', $this->semester);
                        }
                        if ($this->periode) {
                            $q->where('periode_id', $this->periode);
                        }
                        if ($this->status_beastudi) {
                            $q->where('status_beastudi', $this->status_beastudi);
                        }
                    },
                    'monitorings.periode'
                ])
                ->when($this->nim, function ($query) {
                    $query->where('nim', 'like', '%' . $this->nim . '%');
                })
                ->when($this->nama, function ($query) {
                    $query->whereRaw('lower(nama) like ?', ['%' . strtolower($this->nama) . '%']);
                })
                ->paginate(10),
        ]);
    }
}
