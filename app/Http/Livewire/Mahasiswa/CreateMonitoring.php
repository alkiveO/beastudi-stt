<?php

namespace App\Http\Livewire\Mahasiswa;

use App\Models\Periode;
use Livewire\Component;
use App\Models\Prestasi;
use App\Models\Monitoring;
use App\Models\ProgramStudi;
use Livewire\WithFileUploads;
use App\Models\KontribusiKhusus;
use App\Models\PembimbingAkademik;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CreateMonitoring extends Component
{
    use WithFileUploads;

    public $semester_select;
    public $periode_select;

    public $monitoring;
    public $arrPrestasi;

    public $tanggal_isi;
    public $nim;
    public $program_studi_nama;
    public $semester;
    public $ipk;
    public $ips;
    public $pembimbing_akademik_id;
    public $periode_id;
    public $kontribusi_khusus_id;
    public $deskripsi_capaian;
    public $deskripsi_kendala;
    public $deskripsi_rencana;
    public $file_spb;
    public $prestasi = [];

    protected $rules = [
        'tanggal_isi' => 'required',
        'semester' => 'required',
        'ipk' => 'required|min:4',
        'ips' => 'required|min:4',
        'pembimbing_akademik_id' => 'required|exists:pembimbing_akademik,id',
        'periode_id' => 'required|exists:periode,id',
        'kontribusi_khusus_id' => 'required|exists:kontribusi_khusus,id',
        'deskripsi_capaian' => 'nullable|max:500',
        'deskripsi_kendala' => 'nullable|max:500',
        'deskripsi_rencana' => 'nullable|max:500',
        'file_spb' => 'nullable|mimes:pdf|max:1024',
    ];

    protected $messages = [
        'tanggal_isi.required' => 'tanggal harus diisi',
        'semester.required' => 'semester harus diisi',
        'ipk.required' => 'IPK harus diisi',
        'ipk.min' => 'IPK min / max 4 karakter',
        'ips.required' => 'IPS harus diisi',
        'ips.min' => 'IPS min / max 4 karakter',
        'pembimbing_akademik_id.required' => 'pembimbing akademik harus diisi',
        'pembimbing_akademik_id.exists' => 'pembimbing akademik tidak valid',
        'periode_id.required' => 'periode harus diisi',
        'periode_id.exists' => 'periode tidak valid',
        'kontribusi_khusus_id.required' => 'kontribusi khusus harus diisi',
        'kontribusi_khusus_id.exists' => 'kontribusi khusus tidak valid',
        'deskripsi_capaian.max' => 'deskripsi capaian maksimal 500 kata',
        'deskripsi_kendala.max' => 'deskripsi kendala maksimal 500 kata',
        'deskripsi_rencana.max' => 'deskripsi rencana maksimal 500 kata',
        'file_spb.mimes' => 'dokumen spb harus berupa .pdf',
        'file_spb.max' => 'dokumen spb maksimal 1 MB',
        'prestasi.*.file.mimes' => 'dokumen harus berupa .pdf',
        'prestasi.*.file.max' => 'dokumen maksimal 1 MB',
    ];

    public function mount()
    {
        $mahasiswa = auth()->guard('mahasiswa')->user();
        $program_studi = ProgramStudi::query()
            ->where('nama', 'like', '%' . $mahasiswa->program_studi . '%')
            ->first();

        $this->nim = $mahasiswa->nim;
        $this->program_studi_nama = $program_studi->nama;
    }

    public function tambahPrestasi()
    {
         $this->validate([
            'prestasi.*.nama' => 'required',
            'prestasi.*.file' => 'required|mimes:pdf|max:1024',
        ], [
            'prestasi.*.nama.required' => 'lomba atau prestasi harus diisi',
            'prestasi.*.file.required' => 'dokumen harus harus diisi',
            'prestasi.*.file.mimes' => 'dokumen harus berupa .pdf',
            'prestasi.*.file.max' => 'dokumen maksimal 1 MB.',
        ]);

        $this->prestasi[] = ['nama' => '', 'file' => ''];
    }

    public function hapusPrestasi($index)
    {
        unset($this->prestasi[$index]);

        $this->prestasi = array_values($this->prestasi); // Reset indeks array
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if (preg_match('/prestasi\.\d+\.file/', $propertyName)) {
            $this->validateOnly($propertyName, [
                'prestasi.*.file' => 'nullable|mimes:pdf|max:1024',
            ]);
        }
    }

    public function updatedFileSpb()
    {
        $this->validate([
            'file_spb' => 'mimes:pdf|max:1024'
        ]);
    }

    public function updatedSemesterSelect($value)
    {
        $this->semester = $value;

        if ($this->semester && $this->periode_id) {
            $this->setMonitoring();
        }

        $this->emit('resetFileUpload');
    }

    public function updatedPeriodeSelect($value)
    {
        $this->periode_id = $value;

        if ($this->semester && $this->periode_id) {
            $this->setMonitoring();
        }

        $this->emit('resetFileUpload');
    }

    public function setMonitoring()
    {
        $this->monitoring = Monitoring::query()
            ->where('nim', $this->nim)
            ->where('semester', $this->semester)
            ->where('periode_id', $this->periode_id)
            ->first();

        if (! $this->monitoring) {
            $this->reset([
                'tanggal_isi',
                'ips',
                'ipk',
                'pembimbing_akademik_id',
                'kontribusi_khusus_id',
                'deskripsi_capaian',
                'deskripsi_kendala',
                'deskripsi_rencana',
                'file_spb',
                'prestasi',
            ]);

            $this->arrPrestasi = [];

            $this->emit('clearSelect');
        }

        if ($this->monitoring) {
            $this->tanggal_isi = $this->monitoring->tanggal_isi;
            $this->ips = $this->monitoring->ips;
            $this->ipk = $this->monitoring->ipk;
            $this->semester = $this->monitoring->semester;
            $this->pembimbing_akademik_id = $this->monitoring->pembimbing_akademik_id;
            $this->periode_id = $this->monitoring->periode_id;
            $this->kontribusi_khusus_id = $this->monitoring->kontribusi_khusus_id;
            $this->deskripsi_capaian = $this->monitoring->deskripsi_capaian;
            $this->deskripsi_kendala = $this->monitoring->deskripsi_kendala;
            $this->deskripsi_rencana = $this->monitoring->deskripsi_rencana;

            $this->arrPrestasi = Prestasi::query()
                ->where('nim', $this->nim)
                ->where('semester', $this->semester)
                ->where('periode_id', $this->periode_id)
                ->where('monitoring_id', $this->monitoring->id)
                ->get();

            $this->emit('kontribusiSelect', $this->monitoring->kontribusi_khusus_id);
            $this->emit('paSelect', $this->monitoring->pembimbing_akademik_id);
        }
    }

    public function store()
    {
        try {
            if ($this->monitoring && $this->monitoring->file_spb) {
                $this->rules['file_spb'] = 'nullable|mimes:pdf|max:1024';
            } else {
                $this->rules['file_spb'] = 'required|mimes:pdf|max:1024';
                $this->messages['file_spb.required'] = 'dokumen SPK harus diisi';
            }

            $this->validate();
        } catch (ValidationException $e) {
            $this->emit('alert', 'Ooppss', $e->validator->errors()->all(), 'error');
            return;
        }

        if ($this->file_spb) {
            $file_spb_path = $this->file_spb->store('monitoring/file-spb', 'public');

            if ($this->monitoring && $this->monitoring->file_spb) {
                Storage::disk('public')->delete('monitoring/file-spb/' . $this->monitoring->file_spb);
            }
        }

        $this->monitoring = Monitoring::updateOrCreate(
            ['nim' => $this->nim, 'semester' => $this->semester, 'periode_id' => $this->periode_id],
            [
                'nim' => $this->nim,
                'semester' => $this->semester,
                'tanggal_isi' => $this->tanggal_isi,
                'ipk' => $this->ipk,
                'ips' => $this->ips,
                'pembimbing_akademik_id' => $this->pembimbing_akademik_id,
                'periode_id' => $this->periode_id,
                'kontribusi_khusus_id' => $this->kontribusi_khusus_id,
                'deskripsi_capaian' => $this->deskripsi_capaian,
                'deskripsi_kendala' => $this->deskripsi_kendala,
                'deskripsi_rencana' => $this->deskripsi_rencana,
                'file_spb' => $this->file_spb ? basename($file_spb_path) : $this->monitoring->file_spb
            ]
        );

        foreach ($this->prestasi as $item) {
            if ($item['nama'] && $item['file']) {
                $existingPrestasi = Prestasi::query()
                    ->where('nim', $this->nim)
                    ->where('nama', $item['nama'])
                    ->where('semester', $this->semester)
                    ->where('periode_id', $this->periode_id)
                    ->first();

                $file_prestasi_path = $item['file']->store('monitoring/file-prestasi', 'public');

                if ($existingPrestasi && $existingPrestasi->file) {
                    Storage::disk('public')->delete($existingPrestasi->file);
                }

                Prestasi::updateOrCreate(
                    [
                        'nim' => $this->nim,
                        'nama' => $item['nama'],
                        'semester' => $this->semester,
                        'periode_id' => $this->periode_id,
                    ],
                    [
                        'file' => $file_prestasi_path,
                        'monitoring_id' => $this->monitoring->id,
                    ]
                );
            }
        }

        $this->arrPrestasi = $this->monitoring->prestasi;

        $this->emit('alert', 'Berhasil', 'Laporan semester berhasil ditambahkan', 'success');

        $this->emit('resetFileUpload');

        $this->reset(['file_spb', 'prestasi']);
    }

    public function render()
    {
        return view('livewire.mahasiswa.create-monitoring',[
            'list_periode' => Periode::all(),
            'program_studi' => ProgramStudi::all(),
            'kontribusi_khusus' => KontribusiKhusus::all(),
            'pembimbing_akademik' => PembimbingAkademik::query()
                // ->where('program_studi', $this->program_studi_nama)
                ->orderBy('nama', 'asc')
                ->get(),
        ]);
    }
}
