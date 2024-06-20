<?php

namespace App\Http\Livewire\Mahasiswa;

use Livewire\Component;
use App\Models\Monitoring;
use App\Models\ProgramStudi;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class EditMonitoring extends Component
{
    use WithFileUploads;

    public $nim;
    public $mahasiswa;
    public $program_studi_id;
    public $angkatan;
    public $kontribusi;
    public $file;

    public function rules()
    {
        return [
            'nim' => [
                'required',
                'max:20',
                Rule::unique('monitoring', 'nim')
                ->ignore($this->nim, 'nim')
            ],
            'mahasiswa' => 'required|max:255',
            'program_studi_id' => 'required|exists:program_studi,id',
            'angkatan' => 'required|min:4|max:4',
            'kontribusi' => 'required|max:1000',
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
        'kontribusi.required' => 'kontribusi harus diisi',
        'kontribusi.max' => 'kontribusi maksimal 1000 karakter',
        'file.mimes' => 'file mou harus berupa .docx atau .pdf',
        'file.max' => 'file mou maksimal 10 MB',
    ];

    protected $listeners = [
        'setEditMonitoring'
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

    public function setEditMonitoring($monitoring)
    {
        $this->nim = $monitoring['nim'];
        $this->mahasiswa = $monitoring['mahasiswa'];
        $this->angkatan = $monitoring['angkatan'];
        $this->kontribusi = $monitoring['kontribusi'];
        $this->program_studi_id = $monitoring['program_studi_id'];

        $this->emit('setProdi', $monitoring['program_studi_id']);
    }

    public function update()
    {
        $this->validate();

        $monitoring = Monitoring::where('nim', $this->nim)->first();

        if ($this->file) {
            Storage::delete('public/monitoring/'. $monitoring->file);

            $file_path = $this->file->store('monitoring', 'public');

            $monitoring->update([
                'nim' => $this->nim,
                'mahasiswa' => $this->mahasiswa,
                'program_studi_id' => $this->program_studi_id,
                'angkatan' => $this->angkatan,
                'kontribusi' => $this->kontribusi,
                'file' => basename($file_path)
            ]);
        } else {
            $monitoring->update([
                'nim' => $this->nim,
                'mahasiswa' => $this->mahasiswa,
                'program_studi_id' => $this->program_studi_id,
                'angkatan' => $this->angkatan,
                'kontribusi' => $this->kontribusi,
            ]);
        }

        $this->emitTo(ListMonitoring::class, 'refreshPage');

        $this->emit('closeModalMonitoring');
    }

    public function render()
    {
        return view('livewire.mahasiswa.edit-monitoring', [
            'program_studi' => ProgramStudi::all()
        ]);
    }
}
