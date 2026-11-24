<?php

namespace App\Http\Livewire\Pa;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\JalurPrestasi;

class ListMasterData extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

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

    protected $listeners = [
        'refreshPage' => '$refresh',
    ];

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
        if (array_key_exists($propertyName, $this->filters)) {
            $this->filters[$propertyName] = $this->{$propertyName};
            $this->resetPage();
        }
    }

    public function render()
    {
        $paId = auth()->user()->pembimbing_akademik_id;

        abort_unless($paId, 403);

        $dataMahasiswa = Mahasiswa::query()
            ->where('pembimbing_akademik_id', $paId)
            ->when($this->filters['nama'] ?? '', function ($query) {
                $query->where('nama', 'like', '%' . $this->filters['nama'] . '%');
            })
            ->when($this->filters['tahun_masuk'] ?? '', function ($query) {
                $query->where('tahun_masuk', 'like', '%' . $this->filters['tahun_masuk'] . '%');
            })
            ->when($this->filters['program_studi'] ?? '', function ($query) {
                $query->where('program_studi', 'like', '%' . $this->filters['program_studi'] . '%');
            })
            ->when($this->filters['jalur_beastudi'] ?? '', function ($query) {
                $query->where('jalur_beastudi', 'like', '%' . $this->filters['jalur_beastudi'] . '%');
            })
            ->orderBy('nama')
            ->paginate(10);

        return view('livewire.pa.list-master-data', [
            'data_mahasiswa' => $dataMahasiswa,
            'list_prodi' => ProgramStudi::all(),
            'list_beastudi' => JalurPrestasi::all(),
        ]);
    }
}
