<?php

namespace App\Http\Livewire\Mahasiswa;

use App\Models\Mou;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class DeleteMou extends Component
{
    public $mou_id;

    protected $listeners = [
        'setDeleteMou'
    ];

    public function setDeleteMou($mou)
    {
       $this->mou_id = $mou['id'];
    }

    public function destroy()
    {
        $mou = Mou::find($this->mou_id);

        Storage::delete('public/mou/'. $mou->file);

        $mou->delete();

        $this->emitTo(ListMou::class, 'refreshPage');

        $this->emit('closeModalMou');
    }

    public function render()
    {
        return view('livewire.mahasiswa.delete-mou');
    }
}
