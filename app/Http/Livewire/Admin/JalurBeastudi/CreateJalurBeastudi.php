<?php

namespace App\Http\Livewire\Admin\JalurBeastudi;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\JalurPrestasi;
use Illuminate\Validation\Rule;

class CreateJalurBeastudi extends Component
{
    public $nama;

    public function rules()
    {
        return [
            'nama' => [
                'required',
                'max:255',
                Rule::unique('jalur_prestasi', 'nama')
            ],
        ];
    }

    protected $messages = [
        'nama.required' => 'jalur beastudi harus diisi',
        'nama.unique' => 'jalur beastudi sudah digunakan'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();

        JalurPrestasi::create([
            'nama' => $this->nama,
            'slug' => Str::slug($this->nama)
        ]);

        $this->emit('alert', 'Berhasil', 'Jalur beastudi berhasil ditambahkan', 'success');

        $this->emitTo(ListJalurBeastudi::class, 'refreshPage');

        $this->emit('closeModalJalurBeastudi');

        $this->reset('nama');
    }

    public function render()
    {
        return view('livewire.admin.jalur-beastudi.create-jalur-beastudi');
    }
}
