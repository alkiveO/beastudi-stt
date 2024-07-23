<?php

namespace App\Http\Livewire\Mahasiswa;

use Livewire\Component;
use App\Models\ProgramStudi;
use App\Models\JalurPrestasi;
use Illuminate\Validation\Rule;

class EditMaba extends Component
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

    protected $listeners = ['setEditMaba'];

    public function rules()
    {
        return [
            'nim' => [
                'required',
                'max:20',
                Rule::unique('maba', 'nim')
                    ->ignore($this->nim, 'nim')
            ],
            'mahasiswa' => 'required|max:255',
            'angkatan' => 'required|min:4|max:4',
            'program_studi_id' => 'required|exists:program_studi,id',
            'jalur_prestasi_id' => 'required|exists:jalur_prestasi,id',
            'handphone' => 'required|min:9|max:13',
            'handphone_ortu' => 'required|min:9|max:13',
            'alamat_domisili' => 'required|max:255',
            'alamat_kota' => 'required|max:255'
        ];
    }

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

    public function setEditMaba($maba)
    {
        $this->nim = $maba['nim'];
        $this->mahasiswa = $maba['mahasiswa'];
        $this->angkatan = $maba['angkatan'];
        $this->program_studi_id = $maba['program_studi_id'];
        $this->jalur_prestasi_id = $maba['jalur_prestasi_id'];
        $this->handphone = $maba['handphone'];
        $this->handphone_ortu = $maba['handphone_ortu'];
        $this->alamat_domisili = $maba['alamat_domisili'];
        $this->alamat_kota = $maba['alamat_kota'];

        $this->emit('setProdi', $maba['program_studi_id']);
        $this->emit('setJalurPrestasi', $maba['jalur_prestasi_id']);
    }

    public function update()
    {
        $this->validate();

        dd('update');
    }

    public function render()
    {
        return view('livewire.mahasiswa.edit-maba', [
            'program_studi' => ProgramStudi::all(),
            'list_prestasi' => JalurPrestasi::all(),
        ]);
    }
}
