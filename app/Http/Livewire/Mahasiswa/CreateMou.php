<?php

namespace App\Http\Livewire\Mahasiswa;

use App\Models\Mou;
use Livewire\Component;
use App\Models\ProgramStudi;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class CreateMou extends Component
{
    use WithFileUploads;

    public $nim;
    public $mahasiswa;
    public $program_studi_id;
    public $angkatan;
    public $file;

    protected $rules = [
        'nim' => 'required|max:20|unique:mou,nim',
        'mahasiswa' => 'required|max:255',
        'program_studi_id' => 'required|exists:program_studi,id',
        'angkatan' => 'required|min:4|max:4',
        'file' => 'required|mimes:docx,pdf|max:10240'
    ];

    protected $messages = [
        'nim.required' => 'nim harus diisi',
        'nim.max' => 'nim maksimal 20 karakter',
        'nim.unique' => 'nim sudah digunakan',
        'mahasiswa.required' => 'nama mahasiswa harus diisi',
        'mahasiswa.max' => 'nama mahasiswa maksimal 255 karakter',
        'program_studi_id.required' => 'program studi harus diisi',
        'program_studi_id.exists' => 'program studi tidak valid',
        'angkatan.required' => 'angkatan harus diisi',
        'angkatan.min' => 'angkatan minimal 4 karakter',
        'angkatan.max' => 'angkatan maksimal 4 karakter',
        'file.required' => 'file mou harus diisi',
        'file.mimes' => 'file mou harus berupa .docx atau .pdf',
        'file.max' => 'file mou maksimal 10 MB',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedFile()
    {
        $this->validate([
            'file' => 'mimes:docx,pdf|max:10240'
        ]);
    }

    public function store()
    {
        $this->validate();

        $file_path = $this->file->store('mou', 'public');

        Mou::create([
            'nim' => $this->nim,
            'mahasiswa' => $this->mahasiswa,
            'program_studi_id' => $this->program_studi_id,
            'angkatan' => $this->angkatan,
            'file' => basename($file_path)
        ]);

        $this->emitTo(ListMou::class, 'refreshPage');

        $this->reset();
        $this->emit('resetProdi');
        $this->emit('resetFileUpload');
    }

    public function render()
    {
        return view('livewire.mahasiswa.create-mou', [
            'program_studi' => ProgramStudi::all()
        ]);
    }
}
