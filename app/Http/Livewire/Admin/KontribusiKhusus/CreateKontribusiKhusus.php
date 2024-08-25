<?php

namespace App\Http\Livewire\Admin\KontribusiKhusus;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\KontribusiKhusus;

class CreateKontribusiKhusus extends Component
{
    public $nama;

    protected $rules = [
        'nama' => 'required'
    ];

    protected $messages = [
        'nama.required' => 'kontribusi khusus harus diisi'
    ];

    public function store()
    {
        $this->validate();

        KontribusiKhusus::create([
            'nama' => $this->nama,
            'slug' => Str::slug($this->nama)
        ]);

        $this->emit('alert', 'Berhasil', 'Kontribusi khusus berhasil ditambahkan', 'success');

        $this->emit('closeModalKontribusiKhusus');

        $this->emitTo(ListKontribusiKhusus::class, 'refreshPage');
    }

    public function render()
    {
        return view('livewire.admin.kontribusi-khusus.create-kontribusi-khusus');
    }
}
