<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Admin\ListPembimbingAkademik;
use Livewire\Component;
use App\Models\PembimbingAkademik;

class CreatePembimbingAkademik extends Component
{
    public $program_studi;
    public $nama;

    public function rules()
    {
        return [
            'program_studi' => ['required'],
            'nama' => [
                'required',
                function ($attribute, $value, $fail) {
                    $exists = PembimbingAkademik::query()
                        ->where('program_studi', $this->program_studi)
                        ->where('nama', $this->nama)
                        ->exists();

                    if ($exists) {
                        $fail('Dosen ini sudah menjadi PA untuk program studi tersebut.');
                    }
                },
            ],
        ];
    }

    protected $messages = [
        'program_studi.required' => 'Program Studi harus diisi.',
        'nama.required' => 'Nama Dosen harus diisi.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        PembimbingAkademik::create($this->validate());

        $this->emit('alert', 'Berhasil', 'Pembimbing Akademik berhasil ditambahkan', 'success');
        $this->emitTo(ListPembimbingAkademik::class, 'refreshPage');
        $this->reset('program_studi', 'nama');
        $this->emit('closeModal');
    }

    public function render()
    {
        return view('livewire.create-pembimbing-akademik');
    }
}
