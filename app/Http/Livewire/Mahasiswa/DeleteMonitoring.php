<?php

namespace App\Http\Livewire\Mahasiswa;

use Livewire\Component;
use App\Models\Monitoring;
use Illuminate\Support\Facades\Storage;

class DeleteMonitoring extends Component
{
    public $monitoring_id;

    protected $listeners = [
        'setDeleteMonitoring'
    ];

    public function setDeleteMonitoring($monitoring)
    {
       $this->monitoring_id = $monitoring['id'];
    }

    public function destroy()
    {
        $monitoring = Monitoring::find($this->monitoring_id);

        Storage::delete('public/monitoring/'. $monitoring->file);

        $monitoring->delete();

        $this->emitTo(ListMonitoring::class, 'refreshPage');

        $this->emit('closeModalMonitoring');
    }

    public function render()
    {
        return view('livewire.mahasiswa.delete-monitoring');
    }
}
