<?php

namespace App\Http\Livewire\Admin;

use App\Models\KontribusiKhusus;
use App\Models\Periode;
use Livewire\Component;
use App\Models\Mahasiswa;
use App\Models\Monitoring;
use App\Models\ProgramStudi;
use App\Models\PembimbingAkademik;

class ShowMonitoring extends Component
{
    public $semester_select;
    public $periode_select;

    public $list_periode;
    public $mahasiswa;
    public $monitoring;
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
    public $file_kegiatan;
    public $file_internal_kampus;
    public $file_prestasi;
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

    public function mount($nim)
    {
        $this->list_periode = Periode::all();
        $this->mahasiswa = Mahasiswa::query()
            ->where('nim', $nim)
            ->first();
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
            $this->file_kegiatan = $this->monitoring->file_kegiatan;
            $this->file_internal_kampus = $this->monitoring->file_internal_kampus;
            $this->file_prestasi = $this->monitoring->file_prestasi;
            $this->file_spb = $this->monitoring->file_spb;
        }

        if (!$this->monitoring) {
            $this->monitoring = 'Monitoring tidak ditemukan pada semester dan periode tersebut';
        }
    }

    public function render()
    {
        return view('livewire.admin.show-monitoring', [
            'list_periode' => Periode::all(),
            'kontribusi_khusus' => KontribusiKhusus::all(),
            'pembimbing_akademik' => PembimbingAkademik::query()
                ->where('program_studi', $this->program_studi_nama)
                ->get(),
        ])
            ->extends('layouts.app');
    }
}
