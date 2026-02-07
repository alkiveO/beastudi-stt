<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Monitoring;

class UpdateStatusMonitoring extends Component
{
    // Simpan ID atau parameter pencarian, jangan simpan object Model secara utuh
    public $monitoringId; 
    public $nama_mahasiswa;
    public $nim_mahasiswa;
    public $prodi_mahasiswa;

    public $status_beastudi;

    protected $listeners = ['setMonitoring'];

    protected $rules = [
        'status_beastudi' => 'required|in:aman,evaluasi,keluar'
    ];

    public function setMonitoring($nim, $semester, $periode_id)
    {
        $monitoring = Monitoring::query()
            ->with(['mahasiswa'])
            ->where('nim', $nim)
            ->where('semester', $semester)
            ->where('periode_id', $periode_id)
            ->first();

        if ($monitoring) {
            $this->monitoringId = $monitoring->id; // Pastikan tabel monitoring punya primary key 'id'
            $this->nama_mahasiswa = $monitoring->mahasiswa->nama;
            $this->nim_mahasiswa = $monitoring->nim;
            $this->prodi_mahasiswa = $monitoring->mahasiswa->program_studi;
            $this->status_beastudi = $monitoring->status_beastudi;
        }
    }

    public function store()
    {
        $this->validate();

        // Cari ulang datanya berdasarkan ID saat akan menyimpan
        $monitoring = Monitoring::find($this->monitoringId);
        
        if ($monitoring) {
            $monitoring->update([
                'status_beastudi' => $this->status_beastudi
            ]);

            $this->emit('alert', 'Berhasil', 'Status monitoring berhasil diubah', 'success');
            $this->emit('closeUpdateStatusMonitoringModal');
            // Opsional: refresh data di tabel utama
            $this->emit('refreshMonitoringTable'); 
        }
    }

    public function render()
    {
        return view('livewire.admin.update-status-monitoring');
    }
}