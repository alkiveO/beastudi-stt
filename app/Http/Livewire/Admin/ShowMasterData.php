<?php

namespace App\Http\Livewire\Admin;

use App\Models\Mahasiswa;
use App\Models\Mou;
use Livewire\Component;

class ShowMasterData extends Component
{
    public $mahasiswa;

    public function mount($nim)
    {
        $this->mahasiswa = Mahasiswa::query()
            ->with('mou')
            ->where('nim', $nim)
            ->first();
    }

    public function render()
    {
        return view('livewire.admin.show-master-data')
            ->extends('layouts.app');
    }
}
