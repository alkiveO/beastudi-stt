<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Mahasiswa;

class DeleteMasterData extends Component
{
    public $mhs_id;
    public $nama;

    protected $listeners = ['showDeleteModal' => 'openModal'];

    public function openModal($id, $nama)
    {
        $this->mhs_id = $id;
        $this->nama = $nama;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function delete()
    {
        Mahasiswa::findOrFail($this->mhs_id)->delete();

        $this->dispatchBrowserEvent('hide-delete-modal');

        $this->emit('alert', 'Berhasil', 'Data mahasiswa berhasil dihapus', 'success');

        $this->emitTo(ListMasterData::class, 'refreshPage');
    }

    public function render()
    {
        return view('livewire.admin.delete-master-data');
    }
}
