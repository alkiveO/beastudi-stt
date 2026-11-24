<?php

namespace App\Http\Livewire\Pa;

use App\Models\Periode;
use App\Models\Mahasiswa;
use App\Models\Monitoring;
use App\Models\ProgramStudi;
use App\Models\KontribusiKhusus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ShowMonitoring extends Component
{
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

    protected $listeners = [
        'kategoriUpdated' => 'refreshPrestasi',
    ];

    protected $rules = [
        'tanggal_isi' => 'required|date',
        'semester' => 'required|integer|between:1,8',
        'ipk' => 'required|numeric|between:0,4.00',
        'ips' => 'required|numeric|between:0,4.00',
        'kontribusi_khusus_id' => 'required|exists:kontribusi_khusus,id',
        'deskripsi_capaian' => 'nullable|max:500',
        'deskripsi_kendala' => 'nullable|max:500',
        'deskripsi_rencana' => 'nullable|max:500',
    ];

    protected $messages = [
        'tanggal_isi.required' => 'Tanggal isi wajib diisi',
        'semester.required' => 'Semester wajib dipilih',
        'semester.between' => 'Semester harus antara 1 sampai 8',
        'ipk.required' => 'IPK wajib diisi',
        'ipk.numeric' => 'IPK harus berupa angka',
        'ipk.between' => 'IPK harus 0.00 - 4.00',
        'ips.required' => 'IPS wajib diisi',
        'ips.numeric' => 'IPS harus berupa angka',
        'ips.between' => 'IPS harus 0.00 - 4.00',
        'kontribusi_khusus_id.required' => 'Kontribusi Khusus wajib dipilih',
        'kontribusi_khusus_id.exists' => 'Kontribusi Khusus tidak valid',
        'deskripsi_capaian.max' => 'Deskripsi capaian maksimal 500 karakter',
        'deskripsi_kendala.max' => 'Deskripsi kendala maksimal 500 karakter',
        'deskripsi_rencana.max' => 'Deskripsi rencana maksimal 500 karakter',
    ];

    public function mount($nim)
    {
        $paId = Auth::user()->pembimbing_akademik_id;

        abort_unless($paId, 403);

        $this->mahasiswa = Mahasiswa::query()
            ->where('nim', $nim)
            ->where('pembimbing_akademik_id', $paId)
            ->firstOrFail();

        $this->nim = $this->mahasiswa->nim;

        $programStudi = ProgramStudi::query()
            ->where('nama', 'like', '%' . $this->mahasiswa->program_studi . '%')
            ->first();

        $this->program_studi_nama = $programStudi
            ? $programStudi->nama
            : null;

        $this->prestasi = collect([]);
    }

    /**
     * Memastikan PA hanya dapat mengakses mahasiswa bimbingannya sendiri.
     */
    private function pastikanAksesMahasiswa()
    {
        $paId = Auth::user()->pembimbing_akademik_id;

        abort_unless($paId, 403);

        return Mahasiswa::query()
            ->where('nim', $this->nim)
            ->where('pembimbing_akademik_id', $paId)
            ->firstOrFail();
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
        $this->pastikanAksesMahasiswa();

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
                'kontribusi_khusus_id',
                'deskripsi_capaian',
                'deskripsi_kendala',
                'deskripsi_rencana',
            ]);

            $this->pembimbing_akademik_id = Auth::user()->pembimbing_akademik_id;

            $this->prestasi = collect([]);

            $this->emit('clearSelect');

            return;
        }

        $this->tanggal_isi = $this->monitoring->tanggal_isi;
        $this->ips = $this->monitoring->ips;
        $this->ipk = $this->monitoring->ipk;

        // PA tidak dapat mengganti pembimbing akademik.
        $this->pembimbing_akademik_id = Auth::user()->pembimbing_akademik_id;

        $this->kontribusi_khusus_id = $this->monitoring->kontribusi_khusus_id;
        $this->deskripsi_capaian = $this->monitoring->deskripsi_capaian;
        $this->deskripsi_kendala = $this->monitoring->deskripsi_kendala;
        $this->deskripsi_rencana = $this->monitoring->deskripsi_rencana;

        $this->prestasi = $this->monitoring->prestasi()
            ->with('kategori_prestasi')
            ->where('nim', $this->nim)
            ->where('semester', $this->semester)
            ->where('periode_id', $this->periode_id)
            ->get();

        $this->emit('kontribusiSelect', $this->monitoring->kontribusi_khusus_id);
    }

    public function update()
    {
        $this->pastikanAksesMahasiswa();

        if (! $this->semester || ! $this->periode_id) {
            $this->emit(
                'alert',
                'Gagal',
                'Pilih semester dan periode terlebih dahulu',
                'error'
            );

            return;
        }

        try {
            $this->validate();
        } catch (ValidationException $e) {
            $allErrors = $e->validator->errors()->all();

            $errorMessage = "Mohon lengkapi data berikut:\n- "
                . implode("\n- ", $allErrors);

            $this->emit(
                'alert',
                'Validasi Gagal',
                $errorMessage,
                'error'
            );

            throw $e;
        }

        // ID PA selalu diambil dari akun yang sedang login.
        // Nilai dari browser tidak digunakan untuk menentukan PA.
        $paId = Auth::user()->pembimbing_akademik_id;

        Monitoring::updateOrCreate(
            [
                'nim' => $this->nim,
                'semester' => $this->semester,
                'periode_id' => $this->periode_id,
            ],
            [
                'tanggal_isi' => $this->tanggal_isi,
                'ipk' => $this->ipk,
                'ips' => $this->ips,
                'pembimbing_akademik_id' => $paId,
                'kontribusi_khusus_id' => $this->kontribusi_khusus_id,
                'deskripsi_capaian' => $this->deskripsi_capaian,
                'deskripsi_kendala' => $this->deskripsi_kendala,
                'deskripsi_rencana' => $this->deskripsi_rencana,
            ]
        );

        $this->monitoring = Monitoring::query()
            ->where('nim', $this->nim)
            ->where('semester', $this->semester)
            ->where('periode_id', $this->periode_id)
            ->first();

        $this->emit(
            'alert',
            'Berhasil',
            'Laporan semester berhasil diperbarui',
            'success'
        );
    }

    public function render()
    {
        $this->pastikanAksesMahasiswa();

        return view('livewire.pa.show-monitoring', [
            'list_periode' => Periode::all(),
            'kontribusi_khusus' => KontribusiKhusus::all(),
            'pembimbing_akademik' => Auth::user()->pembimbingAkademik,
        ]);
    }
}