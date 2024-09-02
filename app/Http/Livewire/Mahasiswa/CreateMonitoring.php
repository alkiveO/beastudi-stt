<?php

namespace App\Http\Livewire\Mahasiswa;

use App\Models\KontribusiKhusus;
use Livewire\Component;
use App\Models\Monitoring;
use App\Models\ProgramStudi;
use Livewire\WithFileUploads;
use App\Models\PembimbingAkademik;
use App\Models\Periode;
use Illuminate\Support\Facades\Storage;

class CreateMonitoring extends Component
{
    use WithFileUploads;

    public $semester_select;
    public $periode_select;
    public $monitoring;

    public $tanggal_isi;
    public $nim;
    public $semester;
    public $ipk;
    public $ips;
    public $pembimbing_akademik_id;
    public $periode_id;
    public $kontribusi_khusus_id;
    public $deskripsi_capaian;
    public $deskripsi_kendala;
    public $deskripsi_rencana;
    public $file_kegiatan;
    public $file_internal_kampus;
    public $file_prestasi;
    public $file_lpj;

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
        'file_kegiatan' => 'nullable|mimes:pdf|max:1024',
        'file_internal_kampus' => 'nullable|mimes:pdf|max:1024',
        'file_prestasi' => 'nullable|mimes:pdf|max:1024',
        'file_lpj' => 'required|mimes:pdf|max:1024',
    ];

    protected $messages = [
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
        'file_kegiatan.mimes' => 'dokumen keikutsertaan kegiatan harus berupa .pdf',
        'file_kegiatan.max' => 'dokumen keikutsertaan kegiatan maksimal 1 MB',
        'file_internal_kampus.mimes' => 'dokumen keikutsertaan internal kampus harus berupa .pdf',
        'file_internal_kampus.max' => 'dokumen keikutsertaan internal kampus maksimal 1 MB',
        'file_prestasi.mimes' => 'dokumen prestasi harus berupa .pdf',
        'file_prestasi.max' => 'dokumen prestasi maksimal 1 MB',
        'file_lpj.required' => 'dokumen lpj harus diisi',
        'file_lpj.mimes' => 'dokumen lpj harus berupa .pdf',
        'file_lpj.max' => 'dokumen lpj maksimal 1 MB',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedFileKegiatan()
    {
        $this->validate([
            'file_kegiatan' => 'mimes:pdf|max:1024'
        ]);
    }

    public function updatedFileInternalKampus()
    {
        $this->validate([
            'file_internal_kampus' => 'mimes:pdf|max:1024'
        ]);
    }

    public function updatedFilePrestasi()
    {
        $this->validate([
            'file_prestasi' => 'mimes:pdf|max:1024'
        ]);
    }

    public function updatedFileLpj()
    {
        $this->validate([
            'file_lpj' => 'mimes:pdf|max:1024'
        ]);
    }

    public function mount()
    {
        $mahasiswa = auth()->guard('mahasiswa')->user();
        $program_studi = ProgramStudi::query()
            ->where('nama', 'like', '%' . $mahasiswa->program_studi . '%')
            ->first();

        $this->nim = $mahasiswa->nim;
        $this->program_studi_nama = $program_studi->nama;
    }

    public function updatedSemesterSelect($value)
    {
        $this->semester = $value;

        if ($this->semester && $this->periode_id) {
            $this->setMonitoring();
        }

        $this->emit('semesterSelect', $value);
    }

    public function updatedPeriodeSelect($value)
    {
        $this->periode_id = $value;

        if ($this->semester && $this->periode_id) {
            $this->setMonitoring();
        }

        $this->emit('periodeSelect', $value);
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
                'deskripsi_rencana'
            ]);

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

            $this->emit('kontribusiSelect', $this->monitoring->kontribusi_khusus_id);
            $this->emit('paSelect', $this->monitoring->pembimbing_akademik_id);
        }
    }

    public function store()
    {
        $this->validate();

        $monitoring = Monitoring::where('nim', $this->nim)->first();

        if ($monitoring && $monitoring->file_kegiatan) {
            Storage::disk('public')->delete('monitoring/file-kegiatan/' . $monitoring->file_kegiatan);
        }

        if ($monitoring && $monitoring->file_internal_kampus) {
            Storage::disk('public')->delete('monitoring/file-internal-kampus/' . $monitoring->file_internal_kampus);
        }

        if ($monitoring && $monitoring->file_prestasi) {
            Storage::disk('public')->delete('monitoring/file-prestasi/' . $monitoring->file_prestasi);
        }

        if ($monitoring && $monitoring->file_lpj) {
            Storage::disk('public')->delete('monitoring/file-lpj/' . $monitoring->file_lpj);
        }

        if ($this->file_kegiatan) {
            $file_kegiatan_path = $this->file_kegiatan->store('monitoring/file-kegiatan', 'public');
        }

        if ($this->file_internal_kampus) {
            $file_internal_kampus_path = $this->file_internal_kampus->store('monitoring/file-internal-kampus', 'public');
        }

        if ($this->file_prestasi) {
            $file_prestasi_path = $this->file_prestasi->store('monitoring/file-prestasi', 'public');
        }

        if ($this->file_lpj) {
            $file_lpj_path = $this->file_lpj->store('monitoring/file-lpj', 'public');
        }

        Monitoring::updateOrCreate(
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
                'file_kegiatan' => $this->file_kegiatan ? basename($file_kegiatan_path) : null,
                'file_internal_kampus' => $this->file_internal_kampus ? basename($file_internal_kampus_path) : null,
                'file_prestasi' => $this->file_prestasi ? basename($file_prestasi_path) : null,
                'file_lpj' => basename($file_lpj_path)
            ]
        );

        $this->emit('alert', 'Berhasil', 'Laporan semester berhasil ditambahkan', 'success');

        $this->reset(['tanggal_isi', 'semester', 'ipk', 'ips', 'deskripsi_capaian', 'deskripsi_kendala', 'deskripsi_rencana']);
        $this->emit('resetBootstrapSelect');
        $this->emit('resetFileUpload');
    }

    public function render()
    {
        return view('livewire.mahasiswa.create-monitoring',[
            'list_periode' => Periode::all(),
            'program_studi' => ProgramStudi::all(),
            'kontribusi_khusus' => KontribusiKhusus::all(),
            'pembimbing_akademik' => PembimbingAkademik::query()
                ->where('program_studi', $this->program_studi_nama)
                ->get(),
        ]);
    }
}
