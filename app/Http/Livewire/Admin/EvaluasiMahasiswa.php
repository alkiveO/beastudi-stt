<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Evaluasi;
use App\Models\Monitoring;

class EvaluasiMahasiswa extends Component
{
    protected $listeners = ['openEvaluasi'];

    public $monitoring;

    // form input
    public $jenis_sp;
    public $keterangan;
    public $tanggal;

    // history evaluasi
    public $historyEvaluasi = [];

    /**
     * Dipanggil saat klik tombol Evaluasi
     */
    public function openEvaluasi($monitoringId)
    {
        $this->monitoring = Monitoring::with(['mahasiswa', 'periode'])
            ->findOrFail($monitoringId);

        // ambil seluruh history evaluasi mahasiswa ini
        $this->historyEvaluasi = Evaluasi::with('monitoring.periode')
            ->where('mahasiswa_id', $this->monitoring->mahasiswa->id)
            ->orderBy('tanggal', 'asc')
            ->get();

        // reset form
        $this->reset(['jenis_sp', 'keterangan']);
        $this->tanggal = now()->format('Y-m-d');
    }

    /**
     * Simpan evaluasi baru
     */
    public function save()
    {
        $this->validate([
            'jenis_sp'   => 'required',
            'keterangan' => 'required',
            'tanggal'    => 'required|date',
        ]);

        Evaluasi::create([
            'mahasiswa_id'  => $this->monitoring->mahasiswa->id,
            'monitoring_id' => $this->monitoring->id,
            'jenis_sp'      => $this->jenis_sp,
            'keterangan'    => $this->keterangan,
            'tanggal'       => $this->tanggal,
        ]);

        // refresh history setelah simpan
        $this->historyEvaluasi = Evaluasi::with('monitoring.periode')
            ->where('mahasiswa_id', $this->monitoring->mahasiswa->id)
            ->orderBy('tanggal', 'asc')
            ->get();

        $this->reset(['jenis_sp', 'keterangan']);
        $this->tanggal = now()->format('Y-m-d');

        $this->dispatchBrowserEvent('swal', [
            'icon'  => 'success',
            'title' => 'Berhasil',
            'text'  => 'Evaluasi berhasil disimpan',
        ]);
    }
public function deleteEvaluasi($evaluasiId)
{
    $evaluasi = Evaluasi::findOrFail($evaluasiId);

    $evaluasi->delete();

    // refresh history setelah hapus
    $this->historyEvaluasi = Evaluasi::with('monitoring.periode')
        ->where('mahasiswa_id', $this->monitoring->mahasiswa->id)
        ->orderBy('tanggal', 'asc')
        ->get();

    $this->dispatchBrowserEvent('swal', [
        'icon'  => 'success',
        'title' => 'Dihapus',
        'text'  => 'History evaluasi berhasil dihapus',
    ]);
}

    public function render()
    {
        return view('livewire.admin.evaluasi-mahasiswa');
    }
}
