<?php

namespace App\Http\Livewire\Admin\KontribusiKhusus;

use App\Models\KontribusiKhusus;
use Livewire\Component;

class ListKontribusiKhusus extends Component
{
    protected $listeners = [
        'refreshPage' => '$refresh'
    ];

    public function render()
    {
        $kontribusi_khusus = KontribusiKhusus::query()
            ->latest()
            ->get();

        return view('livewire.admin.kontribusi-khusus.list-kontribusi-khusus', [
            'data_kontribusi_khusus' => $kontribusi_khusus
        ]);
    }
}
