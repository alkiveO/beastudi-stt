<?php

namespace App\Http\Livewire\Admin;

use App\Models\PengMonitoring;
use Livewire\Component;

class PengaturanMonitoring extends Component
{
    public $is_active = false;

    public function mount()
    {
        $config = PengMonitoring::first();
        $this->is_active = $config ? (bool) $config->is_active : false;
    }

    public function toggle()
    {
        $config = PengMonitoring::firstOrCreate([]);
        $config->update([
            'is_active' => ! $config->is_active
        ]);

        $this->is_active = $config->is_active;

        $this->emit('alert', 'Berhasil', 'Status pengumpulan laporan diperbarui', 'success');
    }

    public function render()
    {
        return view('livewire.admin.pengaturan-monitoring');
    }
}
