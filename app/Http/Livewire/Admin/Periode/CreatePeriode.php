<?php

namespace App\Http\Livewire\Admin\Periode;

use App\Models\Periode;
use Livewire\Component;
use Illuminate\Validation\Rule;

class CreatePeriode extends Component
{
    public $nama;
     public $jenis_semester;

    public function rules()
    {
        return [
            'nama' => [
                'required',
                'max:255',
                'regex:/\//', // memastikan nama mengandung tanda "/"
                Rule::unique('periode', 'nama')
            ],
            'jenis_semester' => [
                'required',
                Rule::in(['ganjil', 'genap']) 
            ],
        ];
    }

    protected $messages = [
        'nama.required' => 'periode harus diisi',
        'nama.unique' => 'periode sudah digunakan',
        'nama.regex' => 'format periode tidak sesuai',
         'jenis_semester.required' => 'Jenis semester harus dipilih',
        'jenis_semester.in' => 'Jenis semester tidak valid',

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
            'slug' => str_replace('/', '-', $this->nama),
             'jenis_semester' => $this->jenis_semester,
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
