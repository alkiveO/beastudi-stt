<?php

namespace App\Http\Livewire\Mahasiswa;

use Carbon\Carbon;
use App\Models\Agama;
use App\Models\Regency;
use App\Models\Village;
use Livewire\Component;
use App\Models\District;
use App\Models\Province;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\JalurPrestasi;
use App\Models\PembimbingAkademik;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CreateDataDiri extends Component
{
    public $mhs_id;
    public $nama;
    public $tahun_masuk;
    public $rombel;
    public $program_studi_id;
    public $jalur_prestasi_id;
    public $pembimbing_akademik_id;

    public $nomor_hp;
    public $nomor_hp_ortu;
    public $alamat;
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

    public $isEditing = false;
    public $originalData = [];

    public function rules()
    {
        return [
            'mhs_id' => 'string',
            'nama' => 'required|max:255',
            'tahun_masuk' => 'required|min:4|max:4',
            'rombel' => 'nullable|string|max:255',

            'program_studi_id' => 'required|exists:program_studi,id',
            'jalur_prestasi_id' => 'required|exists:jalur_prestasi,id',

            'pembimbing_akademik_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    $programStudi = ProgramStudi::find(
                        $this->program_studi_id
                    );

                    $valid = $programStudi
                        && PembimbingAkademik::query()
                            ->where('id', $value)
                            ->where('program_studi', $programStudi->nama)
                            ->exists();

                    if (! $valid) {
                        $fail('Pembimbing Akademik tidak valid atau tidak sesuai dengan Program Studi.');
                    }
                },
            ],

            'nomor_hp' => 'required|min:9|max:13',
            'nomor_hp_ortu' => 'required|min:9|max:13',
            'alamat' => 'required|max:255',
            'kode_pos' => 'required|min:5|max:5',
            'no_kk' => 'required|max:255',
            'no_ktp' => 'required|max:255',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'agama_id' => 'required|exists:agama,id',

            'province_id' => [
                'required',
                'exists:provinces,id',
            ],

            'regency_id' => [
                'required',
                Rule::exists('regencies', 'id')
                    ->where('province_id', $this->province_id),
            ],

            'district_id' => [
                'required',
                Rule::exists('districts', 'id')
                    ->where('regency_id', $this->regency_id),
            ],

            'village_id' => [
                'required',
                Rule::exists('villages', 'id')
                    ->where('district_id', $this->district_id),
            ],
        ];
    }

    protected $messages = [
        'nama.required' => 'nama mahasiswa harus diisi',
        'nama.max' => 'nama mahasiswa maksimal 255 karakter',

        'tahun_masuk.required' => 'tahun angkatan masuk harus diisi',
        'tahun_masuk.min' => 'tahun angkatan masuk minimal 4 karakter',
        'tahun_masuk.max' => 'tahun angkatan masuk maksimal 4 karakter',

        'rombel.max' => 'rombel maksimal 255 karakter',

        'program_studi_id.required' => 'program studi harus diisi',
        'program_studi_id.exists' => 'program studi tidak valid',

        'jalur_prestasi_id.required' => 'jalur beastudi harus diisi',
        'jalur_prestasi_id.exists' => 'jalur beastudi tidak valid',

        'pembimbing_akademik_id.required' => 'Pembimbing Akademik harus dipilih',

        'nomor_hp.required' => 'nomor handphone harus diisi',
        'nomor_hp.min' => 'nomor handphone minimal 9 karakter',
        'nomor_hp.max' => 'nomor handphone maksimal 13 karakter',

        'nomor_hp_ortu.required' => 'nomor handphone ortu harus diisi',
        'nomor_hp_ortu.min' => 'nomor handphone ortu minimal 9 karakter',
        'nomor_hp_ortu.max' => 'nomor handphone ortu maksimal 13 karakter',

        'alamat.required' => 'alamat harus diisi',
        'alamat.max' => 'alamat maksimal 255 karakter',

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

        'province_id.required' => 'provinsi harus diisi',
        'province_id.exists' => 'provinsi tidak valid',

        'regency_id.required' => 'kabupaten harus diisi',
        'regency_id.exists' => 'kabupaten tidak valid atau tidak sesuai dengan provinsi',

        'district_id.required' => 'kecamatan harus diisi',
        'district_id.exists' => 'kecamatan tidak valid atau tidak sesuai dengan kabupaten',

        'village_id.required' => 'kelurahan harus diisi',
        'village_id.exists' => 'kelurahan tidak valid atau tidak sesuai dengan kecamatan',
    ];

    protected $listeners = [
        'provinsiChanged',
        'regencyChanged',
        'districtChanged',
        'villageChanged',
    ];

    private function editableFields(): array
    {
        return [
            'nama',
            'tahun_masuk',
            'rombel',
            'program_studi_id',
            'jalur_prestasi_id',
            'pembimbing_akademik_id',
            'nomor_hp',
            'nomor_hp_ortu',
            'alamat',
            'no_kk',
            'no_ktp',
            'kode_pos',
            'jenis_kelamin',
            'tanggal_lahir',
            'agama_id',
            'province_id',
            'regency_id',
            'district_id',
            'village_id',
        ];
    }

    public function edit()
    {
        if ($this->isEditing) {
            return;
        }

        $this->originalData = [];

        foreach ($this->editableFields() as $field) {
            $this->originalData[$field] = $this->$field;
        }

        $this->isEditing = true;

        $this->dispatchBrowserEvent('data-diri-mode-changed', [
            'editing' => true,
        ]);
    }

    public function cancelEdit()
    {
        if (! $this->isEditing) {
            return;
        }

        foreach ($this->originalData as $field => $value) {
            $this->$field = $value;
        }

        $this->originalData = [];
        $this->isEditing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('data-diri-mode-changed', [
            'editing' => false,
        ]);
    }

    public function updatedProgramStudiId($value)
    {
        $programStudi = ProgramStudi::find($value);

        if (! $programStudi) {
            $this->pembimbing_akademik_id = null;
            return;
        }

        $paMasihSesuai = PembimbingAkademik::query()
            ->where('id', $this->pembimbing_akademik_id)
            ->where('program_studi', $programStudi->nama)
            ->exists();

        if (! $paMasihSesuai) {
            $this->pembimbing_akademik_id = null;
        }

        $this->resetValidation('pembimbing_akademik_id');
    }

    public function updated($propertyName)
    {
        if ($this->isEditing) {
            $this->validateOnly($propertyName);
        }
    }

    public function mount()
    {
        $mahasiswa = auth()->guard('mahasiswa')->user();

        abort_if(! $mahasiswa, 403);

        $agama = Agama::query()
            ->where('nama', $mahasiswa->agama)
            ->first();

        $program_studi = ProgramStudi::query()
            ->where('nama', $mahasiswa->program_studi)
            ->first();

        $jalur_beastudi = JalurPrestasi::query()
            ->where('nama', $mahasiswa->jalur_beastudi)
            ->first();

        $province = Province::query()
            ->where('name', $mahasiswa->provinsi)
            ->first();

        $regency = Regency::query()
            ->where('name', 'like', '%' . $mahasiswa->kota . '%')
            ->where('province_id', $province?->id)
            ->first();

        $district = District::query()
            ->where('name', 'like', '%' . $mahasiswa->kecamatan . '%')
            ->where('regency_id', $regency?->id)
            ->first();

        $village = Village::query()
            ->where('name', 'like', '%' . $mahasiswa->kelurahan . '%')
            ->where('district_id', $district?->id)
            ->first();

        $this->agama_id = $agama?->id;
        $this->program_studi_id = $program_studi?->id;
        $this->jalur_prestasi_id = $jalur_beastudi?->id;
        $this->pembimbing_akademik_id = $mahasiswa->pembimbing_akademik_id;

        $this->mhs_id = $mahasiswa->mhs_id;
        $this->nama = $mahasiswa->nama;
        $this->alamat = $mahasiswa->alamat;
        $this->no_kk = $mahasiswa->no_kk;
        $this->no_ktp = $mahasiswa->no_ktp;
        $this->tahun_masuk = $mahasiswa->tahun_masuk;
        $this->rombel = $mahasiswa->rombel;
        $this->jenis_kelamin = $mahasiswa->jenis_kelamin;
        $this->kode_pos = $mahasiswa->kode_pos;
        $this->nomor_hp = $mahasiswa->nomor_hp;
        $this->nomor_hp_ortu = $mahasiswa->nomor_hp_ortu;

        $this->tanggal_lahir = $this->formatDateToYMD(
            $mahasiswa->tanggal_lahir
        );

        $this->province_id = $province?->id;
        $this->regency_id = $regency?->id;
        $this->district_id = $district?->id;
        $this->village_id = $village?->id;
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

    public function store()
    {
        if (! $this->isEditing) {
            return;
        }

        $mahasiswa = auth()->guard('mahasiswa')->user();

        abort_if(! $mahasiswa, 403);

        try {
            $validate = collect($this->validate())
                ->except([
                    'mhs_id',
                    'agama_id',
                    'program_studi_id',
                    'jalur_prestasi_id',
                    'province_id',
                    'regency_id',
                    'district_id',
                    'village_id',
                ])
                ->toArray();
        } catch (ValidationException $e) {
            $this->emit(
                'alert',
                'Ooppss',
                $e->validator->errors()->all(),
                'error'
            );

            return;
        }

        $agama = Agama::findOrFail($this->agama_id);
        $program_studi = ProgramStudi::findOrFail($this->program_studi_id);
        $jalur_prestasi = JalurPrestasi::findOrFail($this->jalur_prestasi_id);
        $provinsi = Province::findOrFail($this->province_id);
        $kabupaten = Regency::findOrFail($this->regency_id);
        $kecamatan = District::findOrFail($this->district_id);
        $kelurahan = Village::findOrFail($this->village_id);

        $mahasiswa->forceFill(array_merge(
            $validate,
            [
                'agama' => $agama->nama,
                'program_studi' => $program_studi->nama,
                'jalur_beastudi' => $jalur_prestasi->nama,
                'provinsi' => $provinsi->name,
                'kota' => $kabupaten->name,
                'kecamatan' => $kecamatan->name,
                'kelurahan' => $kelurahan->name,
            ]
        ))->save();

        $this->originalData = [];
        $this->isEditing = false;

        $this->dispatchBrowserEvent('data-diri-mode-changed', [
            'editing' => false,
        ]);

        $this->emit(
            'alert',
            'Berhasil',
            'Data diri berhasil diperbarui',
            'success'
        );
    }

    public function render()
    {
        $programStudi = ProgramStudi::find($this->program_studi_id);

        $listPembimbingAkademik = $programStudi
            ? PembimbingAkademik::query()
                ->where('program_studi', $programStudi->nama)
                ->orderBy('nama')
                ->get()
            : collect();

        return view('livewire.mahasiswa.create-data-diri', [
            'program_studi' => ProgramStudi::all(),
            'list_prestasi' => JalurPrestasi::all(),
            'list_agama' => Agama::all(),
            'list_provinsi' => Province::all(),
            'list_pembimbing_akademik' => $listPembimbingAkademik,

            'list_kabupaten' => Regency::where(
                'province_id',
                $this->province_id
            )->get(),

            'list_kecamatan' => District::where(
                'regency_id',
                $this->regency_id
            )->get(),

            'list_kelurahan' => Village::where(
                'district_id',
                $this->district_id
            )->get(),
        ]);
    }
}
