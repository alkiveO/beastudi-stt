<?php

namespace App\Http\Livewire\Mahasiswa;

use App\Models\Mou;
use Livewire\Component;

class ShowMou extends Component
{
    public $mou;

    public function mount(Mou $mou)
    {
        $this->mou = $mou;
    }

    public function render()
    {
        return view('livewire.mahasiswa.show-mou')
            ->extends('layouts.app');
    }
}
