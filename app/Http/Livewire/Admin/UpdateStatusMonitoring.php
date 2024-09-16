<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Monitoring;

class UpdateStatusMonitoring extends Component
{
    public $monitoring;

    public $status_beastudi;

    protected $listeners = ['setMonitoring'];

    protected $rules = [
        'status_beastudi' => 'required|in:aman,evaluasi,keluar'
    ];

    protected $messages = [
        'status_beastudi.required' => 'Status beastudi harus diisi',
        'status_beastudi.in' => 'Status beastudi tidak valid'
    ];

    public function setMonitoring($nim, $semester, $periode_id)
    {
        $this->monitoring = Monitoring::query()
            ->with(['mahasiswa'])
            ->where('nim', $nim)
            ->where('semester', $semester)
            ->where('periode_id', $periode_id)
            ->first();

        $this->status_beastudi = $this->monitoring->status_beastudi;
    }

    public function store()
    {
        $this->validate();

        $this->monitoring->update(['status_beastudi' => $this->status_beastudi]);

        $this->emit('alert', 'Berhasil', 'Status monitoring berhasil diubah', 'success');

        $this->emit('closeUpdateStatusMonitoringModal');
    }

    public function render()
    {
        return view('livewire.admin.update-status-monitoring');
    }
}
