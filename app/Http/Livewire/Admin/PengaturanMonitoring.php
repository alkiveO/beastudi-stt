<?php

namespace App\Http\Livewire\Admin;

use App\Models\PengMonitoring;
use Livewire\Component;
use Carbon\Carbon;

class PengaturanMonitoring extends Component
{
    public $tanggal_buka;
    public $tanggal_tutup;

    /**
     * LOAD DATA KE FORM
     */
    public function mount()
    {
        $config = PengMonitoring::first();

        if ($config) {
            $this->tanggal_buka = $config->tanggal_buka
                ? Carbon::parse($config->tanggal_buka)->format('Y-m-d\TH:i')
                : null;

            $this->tanggal_tutup = $config->tanggal_tutup
                ? Carbon::parse($config->tanggal_tutup)->format('Y-m-d\TH:i')
                : null;
        }
    }

    /**
     * SIMPAN JADWAL
     */
    public function save()
    {
        $this->validate([
            'tanggal_buka'  => 'required|date',
            'tanggal_tutup' => 'nullable|date|after_or_equal:tanggal_buka',
        ]);

        PengMonitoring::updateOrCreate(
            ['id' => 1],
            [
                'tanggal_buka'  => Carbon::parse($this->tanggal_buka),
                'tanggal_tutup' => $this->tanggal_tutup
                    ? Carbon::parse($this->tanggal_tutup)
                    : null,
                'is_active'     => true,
            ]
        );

        // ✅ SWEET ALERT 2
        $this->dispatchBrowserEvent('swal', [
            'icon'  => 'success',
            'title' => 'Berhasil',
            'text'  => 'Jadwal pengumpulan berhasil disimpan',
        ]);

        // Optional: refresh komponen parent
        $this->emitUp('monitoringUpdated');
    }

    /**
     * STATUS REALTIME (AUTO)
     */
    public function getStatusProperty()
    {
        $config = PengMonitoring::first();

        if (!$config || !$config->is_active || !$config->tanggal_buka) {
            return false;
        }

        $now   = Carbon::now();
        $buka  = Carbon::parse($config->tanggal_buka);
        $tutup = $config->tanggal_tutup
            ? Carbon::parse($config->tanggal_tutup)
            : null;

        if ($now->lt($buka)) return false;
        if ($tutup && $now->gt($tutup)) return false;

        return true;
    }

    public function render()
    {
        return view('livewire.admin.pengaturan-monitoring');
    }
}
