<?php

namespace App\Http\Livewire\Admin\Periode;

use App\Models\Periode;
use Livewire\Component;
use Illuminate\Validation\Rule;

class CreatePeriode extends Component
{
    public $nama;

    public function rules()
    {
        return [
            'nama' => [
                'required',
                'max:255',
                'regex:/\//', // memastikan nama mengandung tanda "/"
                Rule::unique('periode', 'nama')
            ],
        ];
    }

    protected $messages = [
        'nama.required' => 'periode harus diisi',
        'nama.unique' => 'periode sudah digunakan',
        'nama.regex' => 'format periode tidak sesuai',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();

        Periode::create([
            'nama' => $this->nama,
            'slug' => str_replace('/', '-', $this->nama)
        ]);

        $this->emit('alert', 'Berhasil', 'Periode berhasil ditambahkan', 'success');

        $this->emitTo(ListPeriode::class, 'refreshPage');

        $this->emit('closeModalPeriode');

        $this->reset('nama');
    }

    public function render()
    {
        return view('livewire.admin.periode.create-periode');
    }
}
