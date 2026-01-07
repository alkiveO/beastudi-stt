<?php
namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Monitoring;
use App\Models\Krs;
use App\Models\Presensi;

class PresensiMahasiswa extends Component
{
    protected $listeners = ['openPresensi'];

    public $monitoring;
    public $listKrs = [];
    public $presensi = [];


    /**
     * Dipanggil dari tombol Presensi
     */
   public function openPresensi($monitoringId)
{
    $this->monitoring = Monitoring::with('mahasiswa', 'periode')
        ->findOrFail($monitoringId);

    $krsList = Krs::with(['matakuliah', 'presensi'])
        ->where('mahasiswa_id', $this->monitoring->mahasiswa->id)
        ->where('periode_id', $this->monitoring->periode_id)
        ->get();

    $this->listKrs = $krsList;

    // 🔥 mapping presensi berbasis krs_id
    foreach ($krsList as $krs) {
        $this->presensi[$krs->id] = $krs->presensi->total_hadir ?? 0;
    }
}

public function saveAllPresensi()
{
    foreach ($this->presensi as $krsId => $hadir) {

        Presensi::updateOrCreate(
            ['krs_id' => $krsId],
            [
                'total_hadir' => $hadir ?? 0,
                'total_pertemuan' => 16,
            ]
        );
    }

    $this->dispatchBrowserEvent('swal', [
        'icon'  => 'success',
        'title' => 'Berhasil',
        'text'  => 'Presensi berhasil disimpan',
    ]);
}


    public function render()
    {
        return view('livewire.admin.presensi-mahasiswa');
    }
}
