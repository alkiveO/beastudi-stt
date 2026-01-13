<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Periode;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PresensiImport;
class ImportPresensi extends Component
{
    use WithFileUploads;

    public $program_studi;
    public $periode_id;
    public $file;

    protected $rules = [
        'program_studi' => 'required',
        'periode_id'    => 'required',
        'file'          => 'required|file|mimes:xlsx,xls',
    ];

   public function import()
{
    $this->validate();

    try {

        Excel::import(
            new PresensiImport($this->program_studi, $this->periode_id),
            $this->file
        );

        // 🔥 Tutup modal + refresh monitoring
        $this->dispatchBrowserEvent('import-success');

        $this->emitTo('admin.list-monitoring', 'refreshMonitoring');

        $this->reset();

    } catch (\Throwable $e) {

        logger()->error('[IMPORT] Gagal import presensi', [
            'message' => $e->getMessage(),
        ]);

        $this->dispatchBrowserEvent('swal', [
            'icon'  => 'error',
            'title' => 'Gagal',
            'text'  => 'Terjadi kesalahan saat import. Cek log.',
        ]);
    }
}



    public function render()
    {
        return view('livewire.admin.import-presensi', [
            'periodes' => Periode::latest()->get(),
           'listProdi' => [
    'TI' => 'teknik informatika',
    'SI' => 'sistem informasi',
    'BD' => 'bisnis digital',
],

        ]);
    }
}
