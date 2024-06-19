<?php

namespace App\Http\Livewire\Mahasiswa;

use Livewire\Component;

class DetailKontribusi extends Component
{
    public $kontribusi;

    protected $listeners = ['setDetailKontribusi'];

    public function setDetailKontribusi($monitoring)
    {
        $this->kontribusi = $monitoring['kontribusi'];
    }

    public function render()
    {
        return view('livewire.mahasiswa.detail-kontribusi');
    }
}
