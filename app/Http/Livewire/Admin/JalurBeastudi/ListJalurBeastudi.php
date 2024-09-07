<?php

namespace App\Http\Livewire\Admin\JalurBeastudi;

use App\Models\JalurPrestasi;
use Livewire\Component;

class ListJalurBeastudi extends Component
{
    protected $listeners = [
        'refreshPage' => '$refresh'
    ];

    public function render()
    {
        $jalur_beastudi = JalurPrestasi::query()
            ->latest()
            ->get();

        return view('livewire.admin.jalur-beastudi.list-jalur-beastudi', [
            'data_jalur_beastudi' => $jalur_beastudi
        ]);
    }
}
