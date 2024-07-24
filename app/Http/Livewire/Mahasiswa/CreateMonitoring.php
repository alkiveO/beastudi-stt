<?php

namespace App\Http\Livewire\Mahasiswa;

use App\Models\Mahasiswa;
use Livewire\Component;
use App\Models\Monitoring;
use App\Models\ProgramStudi;
use Livewire\WithFileUploads;
use App\Models\PembimbingAkademik;
use Illuminate\Support\Facades\Storage;

class CreateMonitoring extends Component
{
    use WithFileUploads;

    public $tanggal_isi;
    public $nim;
    public $mahasiswa;
    public $semester;
    public $ipk;
    public $ips;
    public $program_studi_id;
    public $pembimbing_akademik_id;
    public $deskripsi_capaian;
    public $deskripsi_kendala;
    public $deskripsi_rencana;
    public $file_kegiatan;
    public $file_internal_kampus;
    public $file_prestasi;

    protected $rules = [
        'tanggal_isi' => 'required',
        'semester' => 'required',
        'ipk' => 'required|min:4',
        'ips' => 'required|min:4',
        'program_studi_id' => 'required|exists:program_studi,id',
        'pembimbing_akademik_id' => 'required|exists:pembimbing_akademik,id',
        'deskripsi_capaian' => 'nullable',
        'deskripsi_kendala' => 'nullable',
        'deskripsi_rencana' => 'nullable',
        'file_kegiatan' => 'nullable|mimes:pdf|max:1024',
        'file_internal_kampus' => 'nullable|mimes:pdf|max:1024',
        'file_prestasi' => 'nullable|mimes:pdf|max:1024',
    ];

    protected $messages = [
        'semester.required' => 'semester harus diisi',
        'ipk.required' => 'IPK harus diisi',
        'ipk.min' => 'IPK min / max 4 karakter',
        'ips.required' => 'IPS harus diisi',
        'ips.min' => 'IPS min / max 4 karakter',
        'program_studi_id.required' => 'program studi harus diisi',
        'program_studi_id.exists' => 'program studi tidak valid',
        'pembimbing_akademik_id.required' => 'pembimbing akademik harus diisi',
        'pembimbing_akademik_id.exists' => 'pembimbing akademik tidak valid',
        'file_kegiatan.mimes' => 'dokumen keikutsertaan kegiatan harus berupa .pdf',
        'file_kegiatan.max' => 'dokumen keikutsertaan kegiatan maksimal 1 MB',
        'file_internal_kampus.mimes' => 'dokumen keikutsertaan internal kampus harus berupa .pdf',
        'file_internal_kampus.max' => 'dokumen keikutsertaan internal kampus maksimal 1 MB',
        'file_prestasi.mimes' => 'dokumen prestasi harus berupa .pdf',
        'file_prestasi.max' => 'dokumen prestasi maksimal 1 MB',
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

    public function mount()
    {
        $mahasiswa = auth()->guard('mahasiswa')->user();
        $program_studi = ProgramStudi::query()
            ->where('nama', 'like', '%' . $mahasiswa->program_studi . '%')
            ->first();

        $this->nim = $mahasiswa->nim;
        $this->mahasiswa = $mahasiswa->nama;
        $this->program_studi_id = $program_studi->id;
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

        if ($this->file_kegiatan) {
            $file_kegiatan_path = $this->file_kegiatan->store('monitoring/file-kegiatan', 'public');
        }

        if ($this->file_internal_kampus) {
            $file_internal_kampus_path = $this->file_internal_kampus->store('monitoring/file-internal-kampus', 'public');
        }

        if ($this->file_prestasi) {
            $file_prestasi_path = $this->file_prestasi->store('monitoring/file-prestasi', 'public');
        }

        $program_studi = ProgramStudi::find($this->program_studi_id);

        Mahasiswa::query()
            ->where('nim', $this->nim)
            ->update([
                'program_studi' => $program_studi->nama
            ]);

        Monitoring::updateOrCreate(
            ['nim' => $this->nim],
            [
                'nim' => $this->nim,
                'mahasiswa' => $this->mahasiswa,
                'semester' => $this->semester,
                'tanggal_isi' => $this->tanggal_isi,
                'ipk' => $this->ipk,
                'ips' => $this->ips,
                'program_studi_id' => $this->program_studi_id,
                'pembimbing_akademik_id' => $this->pembimbing_akademik_id,
                'deskripsi_capaian' => $this->deskripsi_capaian,
                'deskripsi_kendala' => $this->deskripsi_kendala,
                'deskripsi_rencana' => $this->deskripsi_rencana,
                'file_kegiatan' => $this->file_kegiatan ? basename($file_kegiatan_path) : null,
                'file_internal_kampus' => $this->file_internal_kampus ? basename($file_internal_kampus_path) : null,
                'file_prestasi' => $this->file_prestasi ? basename($file_prestasi_path) : null
            ]
        );

        toastr()->success('Monitoring berhasil ditambahkan');

        $this->reset(['tanggal_isi', 'semester', 'ipk', 'ips', 'deskripsi_capaian', 'deskripsi_kendala', 'deskripsi_rencana']);
        $this->emit('resetFileUpload');
        $this->emit('resetBootstrapSelect');
    }

    public function render()
    {
        return view('livewire.mahasiswa.create-monitoring',[
            'program_studi' => ProgramStudi::all(),
            'pembimbing_akademik' => PembimbingAkademik::all(),
        ]);
    }
}
