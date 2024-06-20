<?php

namespace App\Http\Livewire\Mahasiswa;

use App\Models\Mou;
use Livewire\Component;
use App\Models\ProgramStudi;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class EditMou extends Component
{
    use WithFileUploads;

    public $nim;
    public $mahasiswa;
    public $program_studi_id;
    public $angkatan;
    public $file;

    public function rules()
    {
        return [
            'nim' => [
                'required',
                'max:20',
                Rule::unique('mou', 'nim')
                ->ignore($this->nim, 'nim')
            ],
            'mahasiswa' => 'required|max:255',
            'program_studi_id' => 'required|exists:program_studi,id',
            'angkatan' => 'required|min:4|max:4',
            'file' => 'nullable|mimes:docx,pdf|max:10240'
         ];
    }

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
        'file.mimes' => 'file mou harus berupa .docx atau .pdf',
        'file.max' => 'file mou maksimal 10 MB',
    ];

    protected $listeners = [
        'setEditMou'
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

    public function setEditMou($mou)
    {
        $this->nim = $mou['nim'];
        $this->mahasiswa = $mou['mahasiswa'];
        $this->angkatan = $mou['angkatan'];
        $this->program_studi_id = $mou['program_studi_id'];

        $this->emit('setProdi', $mou['program_studi_id']);
    }

    public function update()
    {
        $this->validate();

        $mou = Mou::where('nim', $this->nim)->first();

        if ($this->file) {
            Storage::delete('public/mou/'. $mou->file);

            $file_path = $this->file->store('mou', 'public');

            $mou->update([
                'nim' => $this->nim,
                'mahasiswa' => $this->mahasiswa,
                'program_studi_id' => $this->program_studi_id,
                'angkatan' => $this->angkatan,
                'file' => basename($file_path)
            ]);
        } else {
            $mou->update([
                'nim' => $this->nim,
                'mahasiswa' => $this->mahasiswa,
                'program_studi_id' => $this->program_studi_id,
                'angkatan' => $this->angkatan
            ]);
        }

        $this->emitTo(ListMou::class, 'refreshPage');

        $this->emit('closeModalMou');
    }

    public function render()
    {
        return view('livewire.mahasiswa.edit-mou', [
            'program_studi' => ProgramStudi::all()
        ]);
    }
}
