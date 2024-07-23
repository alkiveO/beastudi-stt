<?php

namespace App\Http\Livewire\Mahasiswa;

use Carbon\Carbon;
use App\Models\Agama;
use App\Models\District;
use Livewire\Component;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\JalurPrestasi;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;

class CreateMaba extends Component
{
    public $nim;
    public $nama;
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

    protected $rules = [
        'nim' => 'required|max:20|unique:maba,nim',
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
        // 'province_id' => 'required',
        // 'regency_id' => 'required',
        // 'district_id' => 'required',
        // 'village_id' => 'required',
    ];

    protected $messages = [
        'nim.required' => 'nim harus diisi',
        'nim.max' => 'nim maksimal 20 karakter',
        'nim.unique' => 'nim sudah digunakan',
        'nama.required' => 'nama mahasiswa harus diisi',
        'nama.max' => 'nama mahasiswa maksimal 255 karakter',
        'tahun_masuk.required' => 'tahun angkatan masuk harus diisi',
        'tahun_masuk.min' => 'tahun angkatan masuk minimal 4 karakter',
        'tahun_masuk.max' => 'tahun angkatan maksimal 4 karakter',
        'program_studi_id.required' => 'program studi harus diisi',
        'program_studi_id.exists' => 'program studi tidak valid',
        'jalur_prestasi_id.required' => 'jalur prestasi harus diisi',
        'jalur_prestasi_id.exists' => 'jalur prestasi tidak valid',
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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $mahasiswa = auth()->guard('mahasiswa')->user();

        $agama = Agama::query()
            ->where('nama', 'like', '%' . $mahasiswa->agama . '%')
            ->first();
        $program_studi = ProgramStudi::query()
            ->where('nama', 'like', '%' . $mahasiswa->program_studi . '%')
            ->first();
        $jalur_beastudi = JalurPrestasi::query()
            ->where('nama', 'like', '%' . $mahasiswa->jalur_beastudi . '%')
            ->first();

        $province = Province::query()
            ->where('name', 'like', '%' . $mahasiswa->provinsi . '%')
            ->first();
        $regency = Regency::query()
            ->where('name', 'like', '%' . $mahasiswa->kota . '%')
            ->where('province_id', $province->id)
            ->first();
        $district = District::query()
            ->where('name', 'like', '%' . $mahasiswa->kecamatan . '%')
            ->where('regency_id', $regency->id)
            ->first();
        $village = Village::query()
            ->where('name', 'like', '%' . $mahasiswa->kelurahan . '%')
            ->where('district_id', $district->id)
            ->first();

        $this->agama_id = $agama->id;
        $this->program_studi_id = $program_studi->id;
        $this->jalur_prestasi_id = $jalur_beastudi->id;

        $this->nama = $mahasiswa->nama;
        $this->nim = $mahasiswa->nim;
        $this->alamat = $mahasiswa->alamat;
        $this->no_kk = $mahasiswa->no_kk;
        $this->no_ktp = $mahasiswa->no_ktp;
        $this->tahun_masuk = $mahasiswa->tahun_masuk;
        $this->jenis_kelamin = $mahasiswa->jenis_kelamin;
        $this->kode_pos = $mahasiswa->kode_pos;
        $this->nomor_hp = $mahasiswa->nomor_hp;
        $this->nomor_hp_ortu = $mahasiswa->nomor_hp_ortu;
        $this->tanggal_lahir = $this->formatDateToYMD($mahasiswa->tanggal_lahir);

        $this->province_id = $province->id;
        $this->regency_id = $regency->id;
        $this->district_id = $district->id;
        $this->village_id = $village->id;
    }

    private function formatDateToYMD($date)
    {
        try {
            return Carbon::createFromFormat('d-m-y', $date)->format('Y-m-d');
        } catch (\Exception $e) {
            try {
                return Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
            } catch (\Exception $e) {
                return null;
            }
        }
    }

    public function store()
    {
        $agama = Agama::find($this->agama_id);
        $program_studi = ProgramStudi::find($this->program_studi_id);
        $jalur_prestasi = JalurPrestasi::find($this->jalur_prestasi_id);

        $validate = collect($this->validate())
            ->except(['agama_id', 'program_studi_id', 'jalur_prestasi_id'])
            ->toArray();

        Mahasiswa::updateOrCreate(
            ['nim' => $this->nim],
            array_merge(
                $validate,
                [
                    'agama' => $agama->nama,
                    'program_studi' => $program_studi->nama,
                    'jalur_beastudi' => $jalur_prestasi->nama,
                ]
            )
        );

        toastr()->success('Data diri berhasil ditambahkan');

        $this->emitTo(ListMaba::class, 'refreshPage');
    }

    public function render()
    {
        return view('livewire.mahasiswa.create-maba', [
            'program_studi' => ProgramStudi::all(),
            'list_prestasi' => JalurPrestasi::all(),
            'list_agama' => Agama::all(),
            'list_provinsi' => Province::all(),
            'list_kabupaten' => Regency::where('province_id', $this->province_id)->get(),
            'list_kecamatan' => District::where('regency_id', $this->regency_id)->get(),
            'list_kelurahan' => Village::where('district_id', $this->district_id)->get(),
        ]);
    }
}
