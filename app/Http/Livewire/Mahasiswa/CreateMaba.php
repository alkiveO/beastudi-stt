<?php

namespace App\Http\Livewire\Mahasiswa;

use App\Models\JalurPrestasi;
use App\Models\Maba;
use App\Models\ProgramStudi;
use Livewire\Component;

class CreateMaba extends Component
{
    public $nim;
    public $mahasiswa;
    public $angkatan;
    public $program_studi_id;
    public $jalur_prestasi_id;
    public $handphone;
    public $handphone_ortu;
    public $alamat_domisili;
    public $alamat_kota;

    protected $rules = [
        'nim' => 'required|max:20|unique:maba,nim',
        'mahasiswa' => 'required|max:255',
        'angkatan' => 'required|min:4|max:4',
        'program_studi_id' => 'required|exists:program_studi,id',
        'jalur_prestasi_id' => 'required|exists:jalur_prestasi,id',
        'handphone' => 'required|min:9|max:13',
        'handphone_ortu' => 'required|min:9|max:13',
        'alamat_domisili' => 'required|max:255',
        'alamat_kota' => 'required|max:255'
    ];

    protected $messages = [
        'nim.required' => 'nim harus diisi',
        'nim.max' => 'nim maksimal 20 karakter',
        'nim.unique' => 'nim sudah digunakan',
        'mahasiswa.required' => 'nama mahasiswa harus diisi',
        'mahasiswa.max' => 'nama mahasiswa maksimal 255 karakter',
        'angkatan.required' => 'angkatan harus diisi',
        'angkatan.min' => 'angkatan minimal 4 karakter',
        'angkatan.max' => 'angkatan maksimal 4 karakter',
        'program_studi_id.required' => 'program studi harus diisi',
        'program_studi_id.exists' => 'program studi tidak valid',
        'jalur_prestasi_id.required' => 'jalur prestasi harus diisi',
        'jalur_prestasi_id.exists' => 'jalur prestasi tidak valid',
        'handphone.required' => 'nomor handphone harus diisi',
        'handphone.min' => 'nomor handhone minimal 9 karakter',
        'handphone.max' => 'nomor handphone maksimal 13 karakter',
        'handphone_ortu.required' => 'nomor handphone ortu harus diisi',
        'handphone_ortu.min' => 'nomor handhone ortu minimal 9 karakter',
        'handphone_ortu.max' => 'nomor handphone ortu maksimal 13 karakter',
        'alamat_domisili.required' => 'alamat domisili harus diisi',
        'alamat_domisili.max' => 'alamat domisili maksimal 255 karakter',
        'alamat_kota.required' => 'alamat kota harus diisi',
        'alamat_kota.max' => 'alamat kota maksimal 255 karakter',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        Maba::create($this->validate());

        $this->emitTo(ListMaba::class, 'refreshPage');

        $this->reset();
        $this->emit('resetProdi');
        $this->emit('resetJalurPrestasi');
    }

    public function render()
    {
        return view('livewire.mahasiswa.create-maba', [
            'program_studi' => ProgramStudi::all(),
            'list_prestasi' => JalurPrestasi::all(),
        ]);
    }
}
