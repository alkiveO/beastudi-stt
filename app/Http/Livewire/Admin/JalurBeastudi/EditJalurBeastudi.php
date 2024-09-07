<?php

namespace App\Http\Livewire\Admin\JalurBeastudi;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\JalurPrestasi;
use Illuminate\Validation\Rule;

class EditJalurBeastudi extends Component
{
    public $jalur_beastudi_id;
    public $nama;

    public function rules()
    {
        return [
            'nama' => [
                'required',
                'max:255',
                Rule::unique('jalur_prestasi', 'nama')
                    ->ignore($this->jalur_beastudi_id)
            ],
        ];
    }

    protected $messages = [
        'nama.required' => 'jalur beastudi harus diisi',
        'nama.unique' => 'jaluar beastudi sudah digunakan'
    ];

    protected $listeners = [
        'setEditJalurBeastudi'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function setEditJalurBeastudi($jalur_beastudi)
    {
        $this->jalur_beastudi_id = $jalur_beastudi['id'];
        $this->nama = $jalur_beastudi['nama'];
    }

    public function update()
    {
        $this->validate();

        JalurPrestasi::query()
            ->where('id', $this->jalur_beastudi_id)
            ->update([
                'nama' => $this->nama,
                'slug' => Str::slug($this->nama)
            ]);

        $this->emit('alert', 'Berhasil', 'Jalur beastudi berhasil diubah', 'success');

        $this->emitTo(ListJalurBeastudi::class, 'refreshPage');

        $this->emit('closeModalJalurBeastudi');
    }

    public function render()
    {
        return view('livewire.admin.jalur-beastudi.edit-jalur-beastudi');
    }
}
