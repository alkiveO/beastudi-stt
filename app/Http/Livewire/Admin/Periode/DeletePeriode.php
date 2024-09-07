<?php

namespace App\Http\Livewire\Admin\Periode;

use App\Models\Periode;
use Livewire\Component;

class DeletePeriode extends Component
{
    public $periode_id;

    protected $listeners = [
        'setDeletePeriode'
    ];

    public function setDeletePeriode($periode)
    {
        $this->periode_id = $periode['id'];
    }

    public function destroy()
    {
        Periode::find($this->periode_id)->delete();

        $this->emit('alert', 'Berhasil', 'Periode berhasil dihapus', 'success');

        $this->emitTo(ListPeriode::class, 'refreshPage');

        $this->emit('closeModalPeriode');
    }

    public function render()
    {
        return view('livewire.admin.periode.delete-periode');
    }
}
