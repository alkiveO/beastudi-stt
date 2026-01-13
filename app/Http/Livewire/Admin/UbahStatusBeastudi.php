<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Monitoring;

class UbahStatusBeastudi extends Component
{
    protected $listeners = ['openUbahStatus'];

    public $monitoring;
    public $status_beastudi;

    /**
     * Dipanggil saat klik tombol
     */
    public function openUbahStatus($monitoringId)
    {
        $this->monitoring = Monitoring::with('mahasiswa', 'periode')
            ->findOrFail($monitoringId);

        $this->status_beastudi = $this->monitoring->status_beastudi;
    }

    /**
     * Simpan perubahan
     */
    public function simpan()
    {
        $this->validate([
            'status_beastudi' => 'required|in:evaluasi,aman,keluar',
        ]);

        $this->monitoring->update([
            'status_beastudi' => $this->status_beastudi,
        ]);

        // 🔥 trigger reload parent
        $this->emitUp('monitoringUpdated');

        // 🔥 tutup modal
        $this->dispatchBrowserEvent('close-modal');

        // 🔥 notifikasi
        $this->dispatchBrowserEvent('swal', [
            'icon'  => 'success',
            'title' => 'Berhasil',
            'text'  => 'Status Beastudi berhasil diperbarui',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.ubah-status-beastudi');
    }

}
