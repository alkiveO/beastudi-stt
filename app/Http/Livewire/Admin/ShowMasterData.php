<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Mou;
use App\Models\Agama;
use App\Models\Regency;
use App\Models\Village;
use Livewire\Component;
use App\Models\District;
use App\Models\Province;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\JalurPrestasi;
use Illuminate\Validation\Rule;

class ShowMasterData extends Component
{
    public $mahasiswa;

    public $nim_mhs; // utk update nim
    public $nim;
    public $rombel;
    public $nama;
    public $email;
    public $tahun_masuk;
    public $program_studi_id;
    public $jalur_prestasi_id;
    public $nomor_hp;
    public $nomor_hp_ortu;
    public $alamat;
    // public $alamat_kota;
    public $no_kk;
    public $no_ktp;
    public $kode_pos;
    public $jenis_kelamin;
    public $tanggal_lahir;
    public $agama_id;

    public $province_id;
    public $regency_id;
    public $district_id;
    public $village_id;

    public function rules()
    {
        return [
            'nim_mhs' => [
                'required',
                'max:20',
                Rule::unique('mahasiswa', 'nim')
                    ->ignore($this->nim_mhs, 'nim')
            ],
            'email' => [
                'required',
                Rule::unique('mahasiswa', 'email')
                    ->ignore($this->email, 'email')
            ],
            'rombel' => 'required',
            'nama' => 'required|max:255',
            'tahun_masuk' => 'required|min:4|max:4',
            'program_studi_id' => 'required|exists:program_studi,id',
            'jalur_prestasi_id' => 'required|exists:jalur_prestasi,id',
            'nomor_hp' => 'required|min:9|max:13',
            'nomor_hp_ortu' => 'required|min:9|max:13',
            'alamat' => 'required|max:255',
            // 'alamat_kota' => 'required|max:255',
            'kode_pos' => 'required|min:5|max:5',
            'no_kk' => 'required|max:255',
            'no_ktp' => 'required|max:255',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'agama_id' => 'required|exists:agama,id',
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
        ];
    }

    protected $messages = [
        'nim_mhs.required' => 'nomor induk mahasiswa harus diisi',
        'nim_mhs.max' => 'nomor induk mahasiswa maksimal 20 karakter',
        'nim_mhs.unique' => 'nomor induk mahasiswa sudah digunakan',
        'email.required' => 'email harus diisi',
        'email.unique' => 'email sudah digunakan',
        'rombel.required' => 'rombel harus diisi',
        'nama.required' => 'nama mahasiswa harus diisi',
        'nama.max' => 'nama mahasiswa maksimal 255 karakter',
        'tahun_masuk.required' => 'tahun angkatan harus diisi',
        'tahun_masuk.min' => 'tahun angkatan minimal 4 karakter',
        'tahun_masuk.max' => 'tahun angkatan maksimal 4 karakter',
        'program_studi_id.required' => 'program studi harus diisi',
        'program_studi_id.exists' => 'program studi tidak valid',
        'jalur_prestasi_id.required' => 'jalur beastudi harus diisi',
        'jalur_prestasi_id.exists' => 'jalur beastudi tidak valid',
        'nomor_hp.required' => 'nomor handphone harus diisi',
        'nomor_hp.min' => 'nomor handhone minimal 9 karakter',
        'nomor_hp.max' => 'nomor handphone maksimal 13 karakter',
        'nomor_hp_ortu.required' => 'nomor handphone ortu harus diisi',
        'nomor_hp_ortu.min' => 'nomor handhone ortu minimal 9 karakter',
        'nomor_hp_ortu.max' => 'nomor handphone ortu maksimal 13 karakter',
        'alamat.required' => 'alamat harus diisi',
        'alamat.max' => 'alamat maksimal 255 karakter',
        'alamat_kota.required' => 'alamat kota harus diisi',
        'alamat_kota.max' => 'alamat kota maksimal 255 karakter',
        'kode_pos.required' => 'kode pos harus diisi',
        'kode_pos.min' => 'kode pos minimal 5 karakter',
        'kode_pos.max' => 'kode pos maksimal 5 karakter',
        'jenis_kelamin.required' => 'jenis kelamin harus diisi',
        'no_kk.required' => 'nomor kk harus diisi',
        'no_kk.max' => 'nomor kk maksimal 255 karakter',
        'no_ktp.required' => 'nomor ktp harus diisi',
        'no_ktp.max' => 'nomor ktp maksimal 255 karakter',
        'tanggal_lahir.required' => 'tanggal lahir harus diisi',
        'agama_id.required' => 'agama harus diisi',
        'agama_id.exists' => 'agama tidak valid',
        'province_id' => 'provinsi harus diisi',
        'regency_id' => 'kabupaten harus diisi',
        'district_id' => 'kecamatan harus diisi',
        'village_id' => 'kelurahan harus diisi',
    ];

    protected $listeners = [
        'provinsiChanged',
        'regencyChanged',
        'districtChanged',
        'villageChanged'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($mhs_id)
    {
        $this->mahasiswa = Mahasiswa::query()
            ->with('mou')
            ->where('mhs_id', $mhs_id)
            ->firstOrFail();
        $agama = Agama::query()
            ->where('nama', 'like', '%' . $this->mahasiswa->agama . '%')
            ->first();
        $program_studi = ProgramStudi::query()
            ->where('nama', 'like', '%' . $this->mahasiswa->program_studi . '%')
            ->first();
        $jalur_beastudi = JalurPrestasi::query()
            ->where('nama', 'like', '%' . $this->mahasiswa->jalur_beastudi . '%')
            ->first();

        $province = Province::query()
            ->where('name', 'like', '%' . $this->mahasiswa->provinsi . '%')
            ->first();
        $regency = Regency::query()
            ->where('name', 'like', '%' . $this->mahasiswa->kota . '%')
            ->where('province_id', $province->id)
            ->first();
        $district = District::query()
            ->where('name', 'like', '%' . $this->mahasiswa->kecamatan . '%')
            ->where('regency_id', $regency->id)
            ->first();
        $village = Village::query()
            ->where('name', 'like', '%' . $this->mahasiswa->kelurahan . '%')
            ->where('district_id', $district->id)
            ->first();

        $this->agama_id = !is_null($this->mahasiswa->agama)
            && $agama
            ? $agama->id
            : null;
        $this->program_studi_id = $program_studi?->id;
        $this->jalur_prestasi_id = !is_null($this->mahasiswa->jalur_beastudi)
            && $jalur_beastudi
            ? $jalur_beastudi->id
            : null;

        $this->nama = $this->mahasiswa->nama;
        $this->nim_mhs = $this->mahasiswa->nim;
        $this->rombel = $this->mahasiswa->rombel;
        $this->email = $this->mahasiswa->email;
        $this->alamat = $this->mahasiswa->alamat;
        $this->no_kk = $this->mahasiswa->no_kk;
        $this->no_ktp = $this->mahasiswa->no_ktp;
        $this->tahun_masuk = $this->mahasiswa->tahun_masuk;
        $this->jenis_kelamin = $this->mahasiswa->jenis_kelamin;
        $this->kode_pos = $this->mahasiswa->kode_pos;
        $this->nomor_hp = $this->mahasiswa->nomor_hp;
        $this->nomor_hp_ortu = $this->mahasiswa->nomor_hp_ortu;
        $this->tanggal_lahir = $this->formatDateToYMD($this->mahasiswa->tanggal_lahir);

        $this->province_id = !is_null($this->mahasiswa->provinsi)
            && $province
            ? $province->id
            : null;
        $this->regency_id = !is_null($this->mahasiswa->kota)
            && $regency
            ? $regency->id
            : null;
        $this->district_id = !is_null($this->mahasiswa->kecamatan)
            && $district
            ? $district->id
            : null;
        $this->village_id = !is_null($this->mahasiswa->kelurahan)
            && $village
            ? $village->id
            : null;
    }

    public function provinsiChanged($province_id)
    {
        $this->province_id = $province_id;

        $this->regency_id = '';
        $this->district_id = '';
        $this->village_id = '';
    }

    public function regencyChanged($regency_id)
    {
        $this->regency_id = $regency_id;

        $this->district_id = '';
        $this->village_id = '';
    }

    public function districtChanged($district_id)
    {
        $this->district_id = $district_id;

        $this->village_id = '';
    }

    public function villageChanged($village_id)
    {
        $this->village_id = $village_id;
    }

    private function formatDateToYMD($date)
    {
        try {
            return Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
        } catch (\Exception $e) {
            try {
                return Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
            } catch (\Exception $e) {
                return null;
            }
        }
    }

    public function update()
    {
        $agama = Agama::find($this->agama_id);
        $program_studi = ProgramStudi::find($this->program_studi_id);
        $jalur_prestasi = JalurPrestasi::find($this->jalur_prestasi_id);
        $provinsi = Province::find($this->province_id);
        $kabupaten = Regency::find($this->regency_id);
        $kecamatan = District::find($this->district_id);
        $kelurahan = Village::find($this->village_id);

        $validate = collect($this->validate())
            ->except([
                'nim_mhs', 'agama_id', 'program_studi_id', 'jalur_prestasi_id',
                'province_id', 'regency_id', 'district_id', 'village_id'
            ])
            ->toArray();

        $this->mahasiswa->update(
            array_merge(
                $validate,
                [
                    'nim' => $this->nim_mhs,
                    'agama' => $agama->nama,
                    'program_studi' => $program_studi->nama,
                    'jalur_beastudi' => $jalur_prestasi->nama,
                    'provinsi' => $provinsi->name,
                    'kota' => $kabupaten->name,
                    'kecamatan' => $kecamatan->name,
                    'kelurahan' => $kelurahan->name
                ]
            )
        );

        $this->nim = $this->nim_mhs;

        $this->emit('alert', 'Berhasil', 'Data mahasiswa berhasil diubah', 'success');
    }

    public function render()
    {
        return view('livewire.admin.show-master-data', [
            'program_studi' => ProgramStudi::all(),
            'list_prestasi' => JalurPrestasi::all(),
            'list_agama' => Agama::all(),
            'list_provinsi' => Province::all(),
            'list_kabupaten' => Regency::where('province_id', $this->province_id)->get(),
            'list_kecamatan' => District::where('regency_id', $this->regency_id)->get(),
            'list_kelurahan' => Village::where('district_id', $this->district_id)->get(),
        ])
            ->extends('layouts.app');
    }

    
}
