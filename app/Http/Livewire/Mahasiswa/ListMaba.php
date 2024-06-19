<?php

namespace App\Http\Livewire\Mahasiswa;

use App\Models\Maba;
use Livewire\Component;

class ListMaba extends Component
{
    public $q;

    protected $listeners = [
        'refreshPage' => '$refresh'
    ];

    public function render()
    {
        $maba = Maba::query()
            ->when(! empty($this->q), function($query) {
                $query
                    ->where('nim', 'like', '%' . $this->q . '%')
                    ->orWhere('mahasiswa', 'like', '%' . $this->q .'%');
            })
            ->latest()
            ->get();

        return view('livewire.mahasiswa.list-maba', [
            'list_maba' => $maba
        ]);
    }
}
