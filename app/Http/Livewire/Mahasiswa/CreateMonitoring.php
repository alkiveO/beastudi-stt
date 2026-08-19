<?php

namespace App\Http\Livewire\Mahasiswa;

use App\Models\KategoriPrestasi;
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
use App\Models\PengMonitoring;
use App\Models\Documents;
use Carbon\Carbon;



class CreateMonitoring extends Component
{
    use WithFileUploads;

    public $semester_select;
    public $periode_select;
  public $isMonitoringActive = false;
public $statusMonitoringText = '';
public $sisaHariMonitoring = null;
public $tanggalTutupMonitoring = null;
    public $monitoring;
    public $arrPrestasi;
public $documents;

    public $isDataDiriLengkap = true;
    public $missingDataDiri = [];

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
    public $file_lpj;
    public $status_file_spb;
    public $keterangan_file_spb;
    public $status_file_lpj;
    public $keterangan_file_lpj;
    public $prestasi = [];

    protected $rules = [
        'tanggal_isi' => 'required|date',
        'semester' => 'required',
        'ipk' => 'required|numeric|between:0,4',
        'ips' => 'required|numeric|between:0,4',
        'pembimbing_akademik_id' => 'required|exists:pembimbing_akademik,id',
        'periode_id' => 'required|exists:periode,id',
        'kontribusi_khusus_id' => 'required|exists:kontribusi_khusus,id',
        'deskripsi_capaian' => 'nullable|max:500',
        'deskripsi_kendala' => 'nullable|max:500',
        'deskripsi_rencana' => 'nullable|max:500',
        'file_spb' => 'required|pdf_file|max:8192',
        'file_lpj' => 'required|pdf_file|max:8192',
        'prestasi.*.nama' => 'required',
        'prestasi.*.file' => 'required|pdf_file|max:8192',
    ];

    protected $messages = [
        'tanggal_isi.required' => 'tanggal harus diisi',
        'tanggal_isi.date' => 'format tanggal tidak valid',
        'semester.required' => 'semester harus diisi',
        'ipk.required' => 'IPK harus diisi',
        'ipk.numeric' => 'IPK harus berupa angka',
        'ipk.between' => 'IPK harus antara 0 dan 4',
        'ips.required' => 'IPS harus diisi',
        'ips.numeric' => 'IPS harus berupa angka',
        'ips.between' => 'IPS harus antara 0 dan 4',
        'pembimbing_akademik_id.required' => 'pembimbing akademik harus diisi',
        'pembimbing_akademik_id.exists' => 'pembimbing akademik tidak valid',
        'periode_id.required' => 'periode harus diisi',
        'periode_id.exists' => 'periode tidak valid',
        'kontribusi_khusus_id.required' => 'kontribusi khusus harus diisi',
        'kontribusi_khusus_id.exists' => 'kontribusi khusus tidak valid',
        'deskripsi_capaian.max' => 'deskripsi capaian maksimal 500 kata',
        'deskripsi_kendala.max' => 'deskripsi kendala maksimal 500 kata',
        'deskripsi_rencana.max' => 'deskripsi rencana maksimal 500 kata',
        'file_spb.required' => 'dokumen SPK harus diisi',
        'file_lpj.required' => 'dokumen LPJ harus diisi',
        'file_spb.pdf_file' => 'dokumen SPK harus berupa file .pdf',
        'file_lpj.pdf_file' => 'dokumen LPJ harus berupa file .pdf',
        'file_spb.max' => 'dokumen SPK maksimal 8 MB',
        'file_lpj.max' => 'dokumen LPJ maksimal 8 MB',
        'prestasi.*.nama.required' => 'lomba atau prestasi harus diisi',
        'prestasi.*.file.required' => 'dokumen harus diisi',
        'prestasi.*.file.pdf_file' => 'dokumen harus berupa file .pdf (hanya PDF yang diterima)',
        'prestasi.*.file.max' => 'dokumen maksimal 8 MB.',
    ];

    public function mount()
    {
        
        $mahasiswa = auth()->guard('mahasiswa')->user();

        $this->isDataDiriLengkap = $mahasiswa->isDataDiriLengkap();
        $this->missingDataDiri = $mahasiswa->missingDataDiri();

        $program_studi = ProgramStudi::query()
            ->where('nama', 'like', '%' . $mahasiswa->program_studi . '%')
            ->first();
$config = PengMonitoring::first();

if (!$config || !$config->tanggal_buka) {
    // ⛔ BELUM DISET
    $this->isMonitoringActive = false;
    $this->statusMonitoringText = 'Pengumpulan belum dibuka';
    return;
}

$now   = Carbon::now();
$buka  = Carbon::parse($config->tanggal_buka);
$tutup = $config->tanggal_tutup
            ? Carbon::parse($config->tanggal_tutup)
            : null;

// ⏳ BELUM DIBUKA
if ($now->lt($buka)) {
    $this->isMonitoringActive = false;
    $this->statusMonitoringText =
        'Pengumpulan akan dibuka pada ' . $buka->translatedFormat('d F Y');
    return;
}

// 🔒 SUDAH DITUTUP
if ($tutup && $now->gt($tutup)) {
    $this->isMonitoringActive = false;
    $this->statusMonitoringText =
        'Pengumpulan sudah ditutup pada ' . $tutup->translatedFormat('d F Y');
    return;
}

// ✅ SEDANG AKTIF
$this->isMonitoringActive = true;

if ($tutup) {
    $this->tanggalTutupMonitoring = $tutup->translatedFormat('d F Y H:i');
    $this->sisaHariMonitoring = $now->diffInDays($tutup, false);

    $this->statusMonitoringText =
        $this->sisaHariMonitoring > 0
            ? "Pengumpulan ditutup {$this->sisaHariMonitoring} hari lagi"
            : "Hari terakhir pengumpulan (hingga {$this->tanggalTutupMonitoring})";
}
else {
    $this->statusMonitoringText = 'Pengumpulan sedang dibuka';
}




        $this->nim = $mahasiswa->nim;
        $this->program_studi_nama = $program_studi->nama;
        $this->documents = Documents::query()
        ->where('is_publish', 1)
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public function tambahPrestasi()
    {
         $this->validate([
            'prestasi.*.nama' => 'required',
            'prestasi.*.file' => 'required|pdf_file|max:8192',
        ], [
            'prestasi.*.nama.required' => 'lomba atau prestasi harus diisi',
            'prestasi.*.file.required' => 'dokumen harus diisi',
            'prestasi.*.file.pdf_file' => 'dokumen harus berupa file .pdf (hanya PDF yang diterima)',
            'prestasi.*.file.max' => 'dokumen maksimal 8 MB.',
        ]);

        $this->prestasi[] = ['nama' => '', 'kategori_prestasi_id' => null, 'file' => ''];
    }

    public function hapusPrestasi($index)
    {
        unset($this->prestasi[$index]);

        $this->prestasi = array_values($this->prestasi); // Reset indeks array
    }

    public function hapusPrestasiExisting($prestasiId)
    {
        $prestasi = Prestasi::findOrFail($prestasiId);

        if ($prestasi->file && Storage::disk('public')->exists($prestasi->file)) {
            Storage::disk('public')->delete($prestasi->file);
        }

        $prestasi->delete();

        if ($this->monitoring) {
            $this->arrPrestasi = $this->monitoring->prestasi()
                ->with('kategori_prestasi')
                ->where('nim', $this->nim)
                ->where('semester', $this->semester)
                ->where('periode_id', $this->periode_id)
                ->get();
        }

        $this->emit('alert', 'Berhasil', 'Prestasi dihapus', 'success');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if (preg_match('/prestasi\.\d+\.file/', $propertyName)) {
            $this->validateOnly($propertyName, [
                'prestasi.*.file' => 'nullable|pdf_file|max:8192',
            ]);
        }
    }

    public function updatedFileSpb()
    {
        $this->validate([
            'file_spb' => 'pdf_file|max:8192',
        ]);
    }

    public function updatedFileLpj()
    {
        if ($this->status_file_lpj === 'tolak') {
            $this->file_lpj = null;
            $this->emit('alert', 'Ditolak', 'Dokumen LPJ telah ditolak. Anda tidak dapat mengunggah kembali dokumen LPJ.', 'error');
            return;
        }

        $this->validate([
            'file_lpj' => 'pdf_file|max:8192',
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
                'file_lpj',
                'prestasi',
                'status_file_spb',
                'keterangan_file_spb',
                'status_file_lpj',
                'keterangan_file_lpj',
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

            $this->status_file_spb = $this->monitoring->status_file_spb;
            $this->keterangan_file_spb = $this->monitoring->keterangan_file_spb;
            $this->status_file_lpj = $this->monitoring->status_file_lpj;
            $this->keterangan_file_lpj = $this->monitoring->keterangan_file_lpj;

            $this->arrPrestasi = $this->monitoring->prestasi()
                ->with('kategori_prestasi')
                ->where('nim', $this->nim)
                ->where('semester', $this->semester)
                ->where('periode_id', $this->periode_id)
                ->get();

            $this->emit('kontribusiSelect', $this->monitoring->kontribusi_khusus_id);
            $this->emit('paSelect', $this->monitoring->pembimbing_akademik_id);
        }
    }

    public function store()
    {
        if (! $this->isMonitoringActive) {
    $this->emit('alert',
        'Pengumpulan Ditutup',
        'Anda tidak dapat mengirim laporan karena pengumpulan sudah ditutup.',
        'warning'
    );
    return;
}

        $mahasiswa = auth()->guard('mahasiswa')->user();

        if (! $mahasiswa->isDataDiriLengkap()) {
            $this->emit('alert',
                'Data Diri Belum Lengkap',
                'Lengkapi terlebih dahulu data diri anda sebelum mengisi Laporan Semester (LPJ/SPB).',
                'warning'
            );
            return;
        }

        try {
            if ($this->file_lpj && $this->status_file_lpj === 'tolak') {
                $this->emit('alert', 'Ditolak', 'Dokumen LPJ telah ditolak. Anda tidak dapat mengunggah kembali dokumen LPJ.', 'error');
                return;
            }

            if ($this->file_spb || ($this->monitoring && $this->monitoring->file_spb)) {
                $this->rules['file_spb'] = 'nullable|pdf_file|max:8192';
            } else {
                $this->rules['file_spb'] = 'required|pdf_file|max:8192';
            }

            // LPJ boleh dikirim belakangan (opsional saat submit pertama)
            $this->rules['file_lpj'] = 'nullable|pdf_file|max:8192';

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

        if ($this->file_lpj) {
            $file_lpj_path = $this->file_lpj->store('monitoring/file-lpj', 'public');

            if ($this->monitoring && $this->monitoring->file_lpj) {
                Storage::disk('public')->delete('monitoring/file-lpj/' . $this->monitoring->file_lpj);
            }
        }

        $monitoringLama = $this->monitoring;

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
                'file_spb' => $this->file_spb ? basename($file_spb_path) : ($monitoringLama ? $monitoringLama->file_spb : null),
                'file_lpj' => $this->file_lpj ? basename($file_lpj_path) : ($monitoringLama ? $monitoringLama->file_lpj : null),
                'status_file_spb' => $this->file_spb ? 'menunggu' : ($monitoringLama ? $monitoringLama->status_file_spb : null),
                'keterangan_file_spb' => $this->file_spb ? null : ($monitoringLama ? $monitoringLama->keterangan_file_spb : null),
                'status_file_lpj' => $this->file_lpj ? 'menunggu' : ($monitoringLama ? $monitoringLama->status_file_lpj : null),
                'keterangan_file_lpj' => $this->file_lpj ? null : ($monitoringLama ? $monitoringLama->keterangan_file_lpj : null),
            ]
        );

        $this->status_file_spb = $this->monitoring->status_file_spb;
        $this->keterangan_file_spb = $this->monitoring->keterangan_file_spb;
        $this->status_file_lpj = $this->monitoring->status_file_lpj;
        $this->keterangan_file_lpj = $this->monitoring->keterangan_file_lpj;

        foreach ($this->prestasi as $prestasi) {
            $file_prestasi_path = $prestasi['file']->store('monitoring/file-prestasi', 'public');

            Prestasi::create([
                'nim' => $this->nim,
                'semester' => $this->semester,
                'periode_id' => $this->periode_id,
                'monitoring_id' => $this->monitoring->id,
                'nama' => $prestasi['nama'],
                'file' => $file_prestasi_path,
                'kategori_prestasi_id' => $prestasi['kategori_prestasi_id'],
            ]);
        }

        $this->arrPrestasi = $this->monitoring->prestasi()
            ->with('kategori_prestasi')
            ->where('nim', $this->nim)
            ->where('semester', $this->semester)
            ->where('periode_id', $this->periode_id)
            ->get();

        $this->emit('alert', 'Berhasil', 'Laporan semester berhasil ditambahkan', 'success');

        $this->emit('resetFileUpload');

        $this->reset(['file_spb', 'file_lpj', 'prestasi']);
    }

    public function render()
    {
        return view('livewire.mahasiswa.create-monitoring',[
            'list_periode' => Periode::all(),
            'program_studi' => ProgramStudi::all(),
            'kontribusi_khusus' => KontribusiKhusus::all(),
            'pembimbing_akademik' => PembimbingAkademik::query()
                ->orderBy('nama', 'asc')
                ->get(),
            'kategori_prestasi' => KategoriPrestasi::all(),
                    'documents' => $this->documents,
        ]);
    }
}
