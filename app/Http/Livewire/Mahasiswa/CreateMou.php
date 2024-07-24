<?php

namespace App\Http\Livewire\Mahasiswa;

use App\Models\Mou;
use Livewire\Component;
use App\Models\ProgramStudi;
use Hamcrest\Core\HasToString;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CreateMou extends Component
{
    use WithFileUploads;

    public $nim;
    public $mahasiswa;
    public $program_studi;
    public $program_studi_id;
    public $angkatan;
    public $file;

    protected $rules = [
        'program_studi' => 'required',
        'file' => 'required|mimes:docx,pdf|max:10240'
    ];

    protected $messages = [
        'program_studi.required' => 'program studi harus diisi',
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

    public function mount()
    {
        $mahasiswa = auth()->guard('mahasiswa')->user();
        $program_studi = ProgramStudi::query()
            ->where('nama', 'like', '%' . $mahasiswa->program_studi . '%')
            ->first();

        $this->nim = $mahasiswa->nim;
        $this->mahasiswa = $mahasiswa->nama;
        $this->angkatan = $mahasiswa->angkatan;
        $this->program_studi = ucwords($program_studi->nama);
        $this->program_studi_id = $program_studi->id;
        $this->angkatan = $mahasiswa->tahun_masuk;
    }

    public function store()
    {
        $this->validate();

        $mou = Mou::where('nim', $this->nim)->first();

        if ($mou) {
            Storage::disk('public')->delete('mou/' . $mou->file);
        }

        $file_path = $this->file->store('mou', 'public');

        Mou::updateOrCreate(
            ['nim' => $this->nim],
            [
                'nim' => $this->nim,
                'mahasiswa' => $this->mahasiswa,
                'program_studi_id' => $this->program_studi_id,
                'angkatan' => $this->angkatan,
                'file' => basename($file_path)
            ]
        );

        toastr()->success('Mou berhasil ditambahkan');

        $this->emit('resetFileUpload');
    }

    public function render()
    {
        return view('livewire.mahasiswa.create-mou', [
            'program_studi' => ProgramStudi::all()
        ]);
    }
}
