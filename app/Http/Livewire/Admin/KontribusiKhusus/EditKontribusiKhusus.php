<?php

namespace App\Http\Livewire\Admin\KontribusiKhusus;

use App\Models\KontribusiKhusus;
use Livewire\Component;

class EditKontribusiKhusus extends Component
{
    public $kontribusi_khusus_id;
    public $nama;

    protected $rules = [
        'nama' => 'required'
    ];

    protected $messages = [
        'nama.required' => 'kontribusi khusus harus diisi'
    ];

    protected $listeners = [
        'setEditKontribusiKhusus'
    ];

    public function setEditKontribusiKhusus($kontribusi_khusus)
    {
        $this->kontribusi_khusus_id = $kontribusi_khusus['id'];
        $this->nama = $kontribusi_khusus['nama'];
    }

    public function update()
    {
        $this->validate();

        KontribusiKhusus::updateOrCreate(
            ['id' => $this->kontribusi_khusus_id],
            ['nama' => $this->nama]
        );

        $this->emit('alert', 'Berhasil', 'Kontribusi khusus berhasil diubah', 'success');

        $this->emit('closeModalKontribusiKhusus');

        $this->emitTo(ListKontribusiKhusus::class, 'refreshPage');
    }

    public function render()
    {
        return view('livewire.admin.kontribusi-khusus.edit-kontribusi-khusus');
    }
}
