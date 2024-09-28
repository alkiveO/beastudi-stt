<?php

namespace App\Http\Livewire;

use App\Models\Mahasiswa;
use App\Models\Mou;
use App\Models\ProgramStudi;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCamaba extends Component
{
    use WithFileUploads;

    public $mahasiswa;
    public $program_studi;
    public $tahun_masuk;
    public $spb_rangkap_1;
    public $spb_rangkap_2;
    public $surat_komitmen_ortu;

    protected $rules = [
        'mahasiswa' => 'required',
        'program_studi' => 'required|exists:program_studi,nama',
        'tahun_masuk' => 'required|min:4|max:4',
        'spb_rangkap_1' => 'required|mimes:pdf,jpg,png|max:2024',
        'spb_rangkap_2' => 'required|mimes:pdf,jpg,png|max:2024',
        'surat_komitmen_ortu' => 'required|mimes:pdf,jpg,png|max:2024'
    ];

    protected $messages = [
        'mahasiswa.required' => 'nama mahasiswa harus diisi',
        'program_studi.required' => 'program studi harus diisi',
        'program_studi.exists' => 'program studi tidak valid',
        'tahun_masuk.required' => 'tahun angkatan masuk harus diisi',
        'tahun_masuk.min' => 'tahun angkatan masuk minimal 4 karakter',
        'tahun_masuk.max' => 'tahun angkatan maksimal 4 karakter',
        'spb_rangkap_1.required' => 'spb rangkap 1 harus diisi',
        'spb_rangkap_1.mimes' => 'spb rangkap 1 harus berupa .pdf,.jpg,atau .png',
        'spb_rangkap_1.max' => 'spb rangkap 1 maksimal 2 MB',
        'spb_rangkap_2.required' => 'spb rangkap 2 harus diisi',
        'spb_rangkap_2.mimes' => 'spb rangkap 2 harus berupa .pdf,.jpg,atau .png',
        'spb_rangkap_2.max' => 'spb rangkap 2 maksimal 2 MB',
        'surat_komitmen_ortu.required' => 'surat komitmen orang tua harus diisi',
        'surat_komitmen_ortu.mimes' => 'surat komitmen orang tua harus berupa .pdf,.jpg,atau .png',
        'surat_komitmen_ortu.max' => 'surat komitmen orang tua maksimal 2 MB'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedSpbRangkap1()
    {
        $this->validate([
            'spb_rangkap_1' => 'mimes:pdf,jpg,png|max:2024'
        ]);
    }

    public function updatedSpbRangkap2()
    {
        $this->validate([
            'spb_rangkap_2' => 'mimes:pdf,jpg,png|max:2024'
        ]);
    }

    public function updatedSuratKomitmenOrtu()
    {
        $this->validate([
            'surat_komitmen_ortu' => 'mimes:pdf,jpg,png|max:2024'
        ]);
    }

    public function store()
    {
        $this->validate();

        // TODO: cek camaba
        // Mahasiswa::query()
        //     ->whereRaw('BINARY nama = ?', [$this->mahasiswa])
        //     ->where('tahun_masuk', $this->tahun_masuk)
        //     ->where('program_studi', $this->program_studi)
        //     ->where('status', false)
        //     ->first();

        $spb_1_path = $this->spb_rangkap_1->store('camaba/spb-rangkap-1', 'public');
        $spb_2_path = $this->spb_rangkap_2->store('camaba/spb-rangkap-2', 'public');
        $surat_ortu_path = $this->surat_komitmen_ortu->store('camaba/surat-komitmen-ortu', 'public');

        $mahasiswa = Mahasiswa::create([
            'mhs_id' => $this->tahun_masuk . now()->format('his'),
            'nama' => $this->mahasiswa,
            'tahun_masuk' => $this->tahun_masuk,
            'program_studi' => $this->program_studi,
        ]);

        Mou::create([
            'mhs_id' => $mahasiswa->mhs_id,
            'spb_rangkap_1' => basename($spb_1_path),
            'spb_rangkap_2' => basename($spb_2_path),
            'surat_komitmen_ortu' => basename($surat_ortu_path),
        ]);

        $this->emit('alert', 'Berhasil', 'Data calon mahasiswa berhasil ditambahkan', 'success');

        $this->reset(['mahasiswa', 'tahun_masuk', 'spb_rangkap_1', 'spb_rangkap_2', 'surat_komitmen_ortu']);
        $this->emit('resetProdi');
        $this->emit('resetFileUpload');
    }

    public function render()
    {
        return view('livewire.create-camaba', [
            'list_prodi' => ProgramStudi::all()
        ]);
    }
}
