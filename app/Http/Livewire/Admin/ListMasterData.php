<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Livewire\WithPagination;
use App\Models\JalurPrestasi;
use App\Models\Periode;

class ListMasterData extends Component
{
    use WithPagination;

    public $nama = '';
    public $program_studi = '';
    public $jalur_beastudi = '';
    public $tahun_masuk = '';
    public $filters = [];

    protected $queryString = [
        'nama' => ['except' => ''],
        'program_studi' => ['except' => ''],
        'jalur_beastudi' => ['except' => ''],
        'tahun_masuk' => ['except' => ''],
    ];

    protected $listeners = ['refreshPage' => '$refresh'];

    public function mount()
    {
        $this->filters = [
            'nama' => $this->nama,
            'tahun_masuk' => $this->tahun_masuk,
            'program_studi' => $this->program_studi,
            'jalur_beastudi' => $this->jalur_beastudi,
        ];
    }

    public function updated($propertyName)
    {
        $this->filters[$propertyName] = $this->{$propertyName};
    }

    public function render()
    {
        $data_mahasiswa = Mahasiswa::query()
            ->when($this->filters && $this->filters['nama'], function($query) {
                $query->where('nama', 'like', '%' . $this->filters['nama'] . '%');
            })
            ->when($this->filters && $this->filters['tahun_masuk'], function($query) {
                $query->where('tahun_masuk', 'like', '%' . $this->filters['tahun_masuk'] . '%');
            })
            ->when($this->filters && $this->filters['program_studi'], function($query) {
                $query->where('program_studi', 'like', '%' . $this->filters['program_studi'] . '%');
            })
            ->when($this->filters && $this->filters['jalur_beastudi'], function($query) {
                $query->where('jalur_beastudi', 'like', '%' . $this->filters['jalur_beastudi'] . '%');
            })
            ->where(function($query) {
                $query
                    ->where('status', false)
                    ->orWhere('status', true);
            })
            ->paginate(10);

        return view('livewire.admin.list-master-data', [
            'data_mahasiswa' => $data_mahasiswa,
            'list_prodi' => ProgramStudi::all(),
            'list_beastudi' => JalurPrestasi::all(),
            'list_periode' => Periode::all(),
        ]);
    }

}
