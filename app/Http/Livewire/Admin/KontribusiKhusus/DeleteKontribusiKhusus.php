<?php

namespace App\Http\Livewire\Admin\KontribusiKhusus;

use App\Models\KontribusiKhusus;
use Livewire\Component;

class DeleteKontribusiKhusus extends Component
{
    public $kontribusi_khusus_id;

    protected $listeners = [
        'setDeleteKontribusiKhusus'
    ];

    public function setDeleteKontribusiKhusus($kontribusi_khusus)
    {
        $this->kontribusi_khusus_id = $kontribusi_khusus['id'];
    }

    public function destroy()
    {
        $kontribusi_khusus = KontribusiKhusus::find($this->kontribusi_khusus_id);

        $kontribusi_khusus->item_kontribusi_khusus()->delete();

        $kontribusi_khusus->delete();

        $this->emit('alert', 'Berhasil', 'Kontribusi khusus berhasil dihapus', 'success');

        $this->emitTo(ListKontribusiKhusus::class, 'refreshPage');

        $this->emit('closeModalKontribusiKhusus');
    }

    public function render()
    {
        return view('livewire.admin.kontribusi-khusus.delete-kontribusi-khusus');
    }
}
