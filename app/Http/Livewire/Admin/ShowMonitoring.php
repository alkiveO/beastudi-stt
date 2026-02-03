<?php

namespace App\Http\Livewire\Admin;

use App\Models\Periode;
use Livewire\Component;
use App\Models\Prestasi;
use App\Models\Mahasiswa;
use App\Models\Monitoring;
use App\Models\ProgramStudi;
use App\Models\KontribusiKhusus;
use App\Models\PembimbingAkademik;
use Illuminate\Validation\ValidationException;

class ShowMonitoring extends Component
{
    // ... (Property lainnya tetap sama) ...
    public $semester_select;
    public $periode_select;

    public $mahasiswa;
    public $monitoring;
    public $prestasi;
    public $program_studi_nama;

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
    public $file_spb;
    public $file_lpj;

    protected $listeners = ['kategoriUpdated' => 'refreshPrestasi'];

    protected $rules = [
        'tanggal_isi' => 'required',
        'semester' => 'required',
        'ipk' => 'required|numeric|between:0,4.00',
        'ips' => 'required|numeric|between:0,4.00',
        'pembimbing_akademik_id' => 'required|exists:pembimbing_akademik,id',
        'periode_id' => 'required|exists:periode,id',
        'kontribusi_khusus_id' => 'required|exists:kontribusi_khusus,id',
        'deskripsi_capaian' => 'nullable|max:500',
        'deskripsi_kendala' => 'nullable|max:500',
        'deskripsi_rencana' => 'nullable|max:500',
    ];

    protected $messages = [
        'tanggal_isi.required' => 'Tanggal isi wajib diisi',
        'semester.required' => 'Semester wajib dipilih',
        'ipk.required' => 'IPK wajib diisi',
        'ipk.numeric' => 'IPK harus berupa angka',
        'ipk.between' => 'IPK harus 0.00 - 4.00',
        'ips.required' => 'IPS wajib diisi',
        'ips.numeric' => 'IPS harus berupa angka',
        'ips.between' => 'IPS harus 0.00 - 4.00',
        'pembimbing_akademik_id.required' => 'Pembimbing Akademik wajib dipilih',
        'periode_id.required' => 'Periode wajib dipilih',
        'kontribusi_khusus_id.required' => 'Kontribusi Khusus wajib dipilih',
        'deskripsi_capaian.max' => 'Deskripsi capaian maksimal 500 karakter',
        'deskripsi_kendala.max' => 'Deskripsi kendala maksimal 500 karakter',
        'deskripsi_rencana.max' => 'Deskripsi rencana maksimal 500 karakter',
    ];

    public function mount($nim)
    {
        $this->nim = $nim;
        $this->mahasiswa = Mahasiswa::query()->where('nim', $nim)->firstOrFail();
        $program_studi = ProgramStudi::query()->where('nama', 'like', '%' . $this->mahasiswa->program_studi . '%')->first();
        $this->program_studi_nama = $program_studi ? $program_studi->nama : null;
    }

    public function refreshPrestasi($prestasiId)
    {
        if ($this->prestasi) {
            $this->prestasi = $this->prestasi->map(function ($item) use ($prestasiId) {
                if ($item->id == $prestasiId) {
                    return $item->fresh(['kategori_prestasi']);
                }
                return $item;
            });
        }
    }

    public function updatedSemesterSelect($value)
    {
        $this->semester = $value;
        $this->resetValidation();
        if ($this->semester && $this->periode_id) {
            $this->setMonitoring();
        }
    }

    public function updatedPeriodeSelect($value)
    {
        $this->periode_id = $value;
        $this->resetValidation();
        if ($this->semester && $this->periode_id) {
            $this->setMonitoring();
        }
    }

    public function setMonitoring()
    {
        $this->monitoring = Monitoring::query()
            ->where('nim', $this->nim)
            ->where('semester', $this->semester)
            ->where('periode_id', $this->periode_id)
            ->first();

        if (! $this->monitoring) {
            // PERBAIKAN 1: Tambahkan 'file_spb' dan 'file_lpj' ke reset agar hilang saat pindah semester kosong
            $this->reset([
                'tanggal_isi',
                'ips',
                'ipk',
                'pembimbing_akademik_id',
                'kontribusi_khusus_id',
                'deskripsi_capaian',
                'deskripsi_kendala',
                'deskripsi_rencana',
                'file_spb', // Reset file
                'file_lpj'  // Reset file
            ]);

            $this->prestasi = collect([]);
            $this->emit('clearSelect');
        }

        if ($this->monitoring) {
            $this->tanggal_isi = $this->monitoring->tanggal_isi;
            $this->ips = $this->monitoring->ips;
            $this->ipk = $this->monitoring->ipk;
            $this->pembimbing_akademik_id = $this->monitoring->pembimbing_akademik_id;
            $this->kontribusi_khusus_id = $this->monitoring->kontribusi_khusus_id;
            $this->deskripsi_capaian = $this->monitoring->deskripsi_capaian;
            $this->deskripsi_kendala = $this->monitoring->deskripsi_kendala;
            $this->deskripsi_rencana = $this->monitoring->deskripsi_rencana;
            
            // Isi variabel file dari database
            $this->file_spb = $this->monitoring->file_spb;
            $this->file_lpj = $this->monitoring->file_lpj;

            $this->prestasi = $this->monitoring->prestasi()
                ->with('kategori_prestasi')
                ->where('nim', $this->nim)
                ->where('semester', $this->semester)
                ->where('periode_id', $this->periode_id)
                ->get();

            $this->emit('kontribusiSelect', $this->monitoring->kontribusi_khusus_id);
            $this->emit('paSelect', $this->monitoring->pembimbing_akademik_id);
        }
    }

    public function updateStatus($nim, $semester, $periode_id)
    {
        $this->emit('showUpdateStatusMonitoringModal', $nim, $semester, $periode_id);
    }

    public function update()
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            // PERBAIKAN 2: Mengambil list error untuk ditampilkan di Popup
            $allErrors = $e->validator->errors()->all();
            
            // Format pesan menjadi list string (contoh: "- IPK wajib diisi")
            $errorMessageString = "Mohon lengkapi data berikut:\n" . implode("\n- ", $allErrors);
            
            $this->emit('alert', 'Validasi Gagal', $errorMessageString, 'error');
            
            // Lempar kembali error agar view tetap merah (field highlighting)
            throw $e;
        }

        $targetNim = $this->nim ?? $this->mahasiswa->nim;

        Monitoring::updateOrCreate(
            [
                'nim' => $targetNim,
                'semester' => $this->semester,
                'periode_id' => $this->periode_id,
            ],
            [
                'tanggal_isi' => $this->tanggal_isi,
                'ipk' => $this->ipk,
                'ips' => $this->ips,
                'pembimbing_akademik_id' => $this->pembimbing_akademik_id,
                'kontribusi_khusus_id' => $this->kontribusi_khusus_id,
                'deskripsi_capaian' => $this->deskripsi_capaian,
                'deskripsi_kendala' => $this->deskripsi_kendala,
                'deskripsi_rencana' => $this->deskripsi_rencana
            ]
        );

        $this->emit('alert', 'Berhasil', 'Laporan semester berhasil diperbarui', 'success');
        $this->emit('redirectToMasterData');
    }

    public function render()
    {
        return view('livewire.admin.show-monitoring', [
            'list_periode' => Periode::all(),
            'kontribusi_khusus' => KontribusiKhusus::all(),
            'pembimbing_akademik' => PembimbingAkademik::query()->orderBy('nama', 'asc')->get(),
        ])->extends('layouts.app');
    }
}