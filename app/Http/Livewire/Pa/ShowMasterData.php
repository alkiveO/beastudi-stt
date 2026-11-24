<?php

namespace App\Http\Livewire\Pa;

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowMasterData extends Component
{
    public $mahasiswa;

    public function mount($mhs_id)
    {
        $paId = Auth::user()->pembimbing_akademik_id;

        abort_unless($paId, 403);

        $this->mahasiswa = Mahasiswa::query()
            ->with('mou')
            ->where('mhs_id', $mhs_id)
            ->where('pembimbing_akademik_id', $paId)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.pa.show-master-data');
    }
}