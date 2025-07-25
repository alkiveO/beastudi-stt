<?php

namespace App\Http\Livewire\Admin;

use App\Models\PembimbingAkademik;
use Livewire\Component;
use Livewire\WithPagination;

class ListPembimbingAkademik extends Component
{
    use WithPagination;

    public $program_studi;

    protected $listeners = [
        'refreshPage' => '$refresh'
    ];

    public function render()
    {
        $pembimbing_akademik = PembimbingAkademik::query()
            ->when($this->program_studi, function($query) {
                $query->where('program_studi', $this->program_studi);
            })
            ->orderBy('program_studi')
            ->orderBy('nama') // urutkan berdasarkan nama dosen
            ->paginate(10);

        return view('livewire.admin.list-pembimbing-akademik', [
            'pembimbing_akademik' => $pembimbing_akademik
        ])
            ->extends('layouts.app')
            ->section('content');
    }
}
