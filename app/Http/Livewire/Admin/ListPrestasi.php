<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Prestasi;
use Livewire\WithPagination;
use App\Exports\PrestasiExport;
use App\Models\KategoriPrestasi;
use Maatwebsite\Excel\Facades\Excel;

class ListPrestasi extends Component
{
    use WithPagination;

    public $kategori_prestasi;

    protected $queryString = [
        'kategori_prestasi' => ['except' => ''],
    ];

    public function updatedKategoriPrestasi($value)
    {
        $this->kategori_prestasi = $value;
    }

    public function exportExcel()
    {
        return Excel::download(new PrestasiExport($this->kategori_prestasi), 'Data Prestasi.xlsx');
    }

    public function render()
    {
        return view('livewire.admin.list-prestasi', [
            'list_kategori_prestasi' => KategoriPrestasi::query()
                ->get()
                ->prepend((object)[
                    'id' => -1,
                    'nama' => 'Semua',
                ])
                ->push((object) [
                    'id' => 0,
                    'nama' => "Lainnya"
                ]),
            'prestasi' => Prestasi::query()
                ->with(['periode', 'kategori_prestasi'])
                ->when($this->kategori_prestasi !== null && $this->kategori_prestasi != -1, function ($query) {
                    if ($this->kategori_prestasi == 0) {
                        $query->whereNull('kategori_prestasi_id');
                    } else {
                        $query->where('kategori_prestasi_id', $this->kategori_prestasi);
                    }
                })
                ->paginate(10)
        ]);
    }
}
