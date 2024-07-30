<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Mahasiswa;

class ListManajemenAkun extends Component
{
    public function render()
    {
        return view('livewire.admin.list-manajemen-akun', [
            'data_mahasiswa' =>  Mahasiswa::query()
                ->where(function($query) {
                    $query
                        ->where('status', false)
                        ->orWhere('status', true);
                })
                ->get()
        ]);
    }
}
