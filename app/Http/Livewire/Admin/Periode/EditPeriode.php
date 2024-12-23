<?php

namespace App\Http\Livewire\Admin\Periode;

use App\Models\Periode;
use Livewire\Component;
use Illuminate\Validation\Rule;

class EditPeriode extends Component
{
    public $periode_id;
    public $nama;

    public function rules()
    {
        return [
            'nama' => [
                'required',
                'max:255',
                'regex:/\//', // memastikan nama mengandung tanda "/"
                Rule::unique('periode', 'nama')
                    ->ignore($this->periode_id)
            ],
        ];
    }

    protected $messages = [
        'nama.required' => 'periode harus diisi',
        'nama.unique' => 'periode sudah digunakan',
        'nama.regex' => 'format periode tidak sesuai',
    ];

    protected $listeners = [
        'setEditPeriode'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function setEditPeriode($periode)
    {
        $this->periode_id = $periode['id'];
        $this->nama = $periode['nama'];
    }

    public function update()
    {
        $this->validate();

        Periode::query()
            ->where('id', $this->periode_id)
            ->update([
                'nama' => $this->nama,
                'slug' => str_replace('/', '-', $this->nama)
            ]);

        $this->emit('alert', 'Berhasil', 'Periode berhasil diubah', 'success');

        $this->emitTo(ListPeriode::class, 'refreshPage');

        $this->emit('closeModalPeriode');
    }

    public function render()
    {
        return view('livewire.admin.periode.edit-periode');
    }
}
