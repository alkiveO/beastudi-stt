<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\MahasiswaImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportMahasiswa extends Component
{
    use WithFileUploads;

    public $file;

    protected $rules = [
        'file' => 'mimes:xlsx'
    ];

    protected $messages = [
        'file.mimes' => 'file harus berupa .xlsx'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedFile()
    {
        $this->validate([
            'file' => 'mimes:xlsx'
        ]);

        Excel::import(new MahasiswaImport, $this->file->path());

        $this->emitTo(ListMasterData::class, 'refreshPage');

        $this->emit('alert', 'Berhasil', 'Data mahasiswa berhasil di import', 'success');
        $this->emit('resetFileUpload');
    }

    public function render()
    {
        return view('livewire.admin.import-mahasiswa');
    }
}
