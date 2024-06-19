<?php

namespace App\Http\Livewire\Mahasiswa;

use App\Models\Mou;
use Livewire\Component;

class ListMou extends Component
{
    protected $listeners = [
        'refreshPage' => '$refresh'
    ];

    public function render()
    {
        $mou = Mou::query()
            ->latest()
            ->get();

        return view('livewire.mahasiswa.list-mou', [
            'list_mou' => $mou
        ]);
    }
}
