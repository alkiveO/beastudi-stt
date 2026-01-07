<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Monitoring;
use App\Models\Krs;
use App\Models\Presensi;
class PresensiController extends Controller
{
    //
     public $monitoringId;
    public $monitoring;
    public $krsList = [];

    /**
     * total_hadir per KRS
     * key = krs_id
     */
    public $hadir = [];

    /**
     * LOAD DATA SAAT MODAL DIBUKA
     */
    public function mount($monitoringId)
    {
        $this->monitoringId = $monitoringId;

        $this->monitoring = Monitoring::with('mahasiswa')->findOrFail($monitoringId);

        // Ambil KRS mahasiswa sesuai periode monitoring
        $this->krsList = Krs::with('matakuliah')
            ->where('mahasiswa_id', $this->monitoring->mahasiswa->id)
            ->where('periode_id', $this->monitoring->periode_id)
            ->get();

        // preload presensi
        foreach ($this->krsList as $krs) {
            $presensi = Presensi::where('krs_id', $krs->id)->first();
            $this->hadir[$krs->id] = $presensi?->total_hadir ?? 0;
        }
    }

    /**
     * SIMPAN PRESENSI
     */
    public function save()
    {
        foreach ($this->krsList as $krs) {
            Presensi::updateOrCreate(
                ['krs_id' => $krs->id],
                [
                    'total_pertemuan' => 16,
                    'total_hadir'     => $this->hadir[$krs->id] ?? 0,
                ]
            );
        }

        $this->dispatchBrowserEvent('swal', [
            'icon'  => 'success',
            'title' => 'Berhasil',
            'text'  => 'Presensi mahasiswa berhasil disimpan',
        ]);

        // optional: refresh parent
        $this->emitUp('monitoringUpdated');
    }

    public function render()
    {
        return view('livewire.admin.presensi-mahasiswa');
    }
}
