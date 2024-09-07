<?php

namespace App\Http\Livewire\Admin\JalurBeastudi;

use App\Models\JalurPrestasi;
use Livewire\Component;

class DeleteJalurBeastudi extends Component
{
    public $jalur_beastudi_id;

    protected $listeners = [
        'setDeleteJalurBeastudi'
    ];

    public function setDeleteJalurBeastudi($jalur_beastudi)
    {
        $this->jalur_beastudi_id = $jalur_beastudi['id'];
    }

    public function destroy()
    {
        JalurPrestasi::find($this->jalur_beastudi_id)->delete();

        $this->emit('alert', 'Berhasil', 'Jalur beastudi berhasil dihapus', 'success');

        $this->emitTo(ListJalurBeastudi::class, 'refreshPage');

        $this->emit('closeModalJalurBeastudi');
    }

    public function render()
    {
        return view('livewire.admin.jalur-beastudi.delete-jalur-beastudi');
    }
}
