<?php

namespace App\Http\Livewire\Admin\Periode;

use App\Models\Periode;
use Livewire\Component;

class ListPeriode extends Component
{
    protected $listeners = [
        'refreshPage' => '$refresh'
    ];

    public function render()
    {
        $periode = Periode::query()
            ->latest()
            ->get();

        return view('livewire.admin.periode.list-periode', [
            'data_periode' => $periode
        ]);
    }
}
