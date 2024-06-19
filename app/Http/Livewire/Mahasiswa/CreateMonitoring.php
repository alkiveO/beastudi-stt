<?php

namespace App\Http\Livewire\Mahasiswa;

use App\Models\Monitoring;
use Livewire\Component;
use App\Models\ProgramStudi;
use Livewire\WithFileUploads;

class CreateMonitoring extends Component
{
    use WithFileUploads;

    public $nim;
    public $mahasiswa;
    public $program_studi_id;
    public $angkatan;
    public $kontribusi;
    public $file;

    protected $rules = [
        'nim' => 'required|max:20|unique:monitoring,nim',
        'mahasiswa' => 'required|max:255',
        'program_studi_id' => 'required|exists:program_studi,id',
        'angkatan' => 'required|min:4|max:4',
        'kontribusi' => 'required|max:1000',
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
        'kontribusi.required' => 'kontribusi harus diisi',
        'kontribusi.max' => 'kontribusi maksimal 1000 karakter',
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

        $file_path = $this->file->store('monitoring', 'public');

        Monitoring::create([
            'nim' => $this->nim,
            'mahasiswa' => $this->mahasiswa,
            'program_studi_id' => $this->program_studi_id,
            'angkatan' => $this->angkatan,
            'kontribusi' => $this->kontribusi,
            'file' => basename($file_path)
        ]);

        $this->emitTo(ListMonitoring::class, 'refreshPage');

        $this->reset();
        $this->emit('resetProdi');
        $this->emit('resetFileUpload');
    }

    public function render()
    {
        return view('livewire.mahasiswa.create-monitoring',[
            'program_studi' => ProgramStudi::all()
        ]);
    }
}
