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
    public $file_spb;

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
    ];

    public function mount($nim)
    {
        $this->mahasiswa = Mahasiswa::query()
            ->where('nim', $nim)
            ->firstOrFail();
        $program_studi = ProgramStudi::query()
            ->where('nama', 'like', '%' . $this->mahasiswa->program_studi . '%')
            ->first();

        $this->program_studi_nama = $program_studi->nama;
    }

    public function updatedSemesterSelect($value)
    {
        $this->semester = $value;

        if ($this->semester && $this->periode_id) {
            $this->setMonitoring();
        }
    }

    public function updatedPeriodeSelect($value)
    {
        $this->periode_id = $value;

        if ($this->semester && $this->periode_id) {
            $this->setMonitoring();
        }
    }

    public function setMonitoring()
    {
        $this->monitoring = Monitoring::query()
            ->where('nim', $this->mahasiswa->nim)
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
            ]);

            $this->prestasi = [];

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
            $this->file_spb = $this->monitoring->file_spb;

            $this->prestasi = $this->monitoring->prestasi;


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
        $this->validate();

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
                'pembimbing_akademik_id' => $this->pembimbing_akademik_id,
                'kontribusi_khusus_id' => $this->kontribusi_khusus_id,
                'deskripsi_capaian' => $this->deskripsi_capaian,
                'deskripsi_kendala' => $this->deskripsi_kendala,
                'deskripsi_rencana' => $this->deskripsi_rencana
            ]
        );

        $this->emit('alert', 'Berhasil', 'Laporan semester berhasil diubah', 'success');
    }

    public function render()
    {
        return view('livewire.admin.show-monitoring', [
            'list_periode' => Periode::all(),
            'kontribusi_khusus' => KontribusiKhusus::all(),
            'pembimbing_akademik' => PembimbingAkademik::query()
                // ->where('program_studi', $this->program_studi_nama)
                ->orderBy('nama', 'asc')
                ->get(),
        ])
            ->extends('layouts.app');
    }
}
