<?php

namespace App\Http\Livewire\Admin\KontribusiKhusus;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\KontribusiKhusus;
use App\Models\ItemKontribusiKhusus;

class CreateKontribusiKhusus extends Component
{
    public $nama;
    public $pic;
    public $telp_pic;
    public $list_kontribusi = [];

    protected $rules = [
        'nama' => 'required',
        'pic' => 'required',
        'telp_pic' => 'required|min:3|max:20'
    ];

    protected $messages = [
        'nama.required' => 'kontribusi khusus harus diisi',
        'pic.required' => 'pic harus diisi',
        'telp_pic.required' => 'nomor handphone pic harus diisi',
        'telp_pic.min' => 'nomor handphone / ID Telegram pic minimal 3 karakter',
        'telp_pic.max' => 'nomor handphone / ID Telegram  pic maksimal 20 karakter',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();

        $kontribusi = KontribusiKhusus::create([
            'nama' => $this->nama,
            'slug' => Str::slug($this->nama),
            'pic' => $this->pic,
            'telp_pic' => $this->telp_pic
        ]);

        if ($this->list_kontribusi && ! str_contains($this->list_kontribusi, "\n")) {
            ItemKontribusiKhusus::create([
                'nama' => $this->list_kontribusi,
                'kontribusi_khusus_id' => $kontribusi->id
            ]);
        }

        if ($this->list_kontribusi && str_contains($this->list_kontribusi, "\n")) {
            $item_kontribusi = explode("\n", $this->list_kontribusi);

            foreach ($item_kontribusi as $item) {
                ItemKontribusiKhusus::create([
                    'nama' => $item,
                    'kontribusi_khusus_id' => $kontribusi->id
                ]);
            }
        }

        $this->emit('alert', 'Berhasil', 'Kontribusi khusus berhasil ditambahkan', 'success');

        $this->emitTo(ListKontribusiKhusus::class, 'refreshPage');

        $this->emit('closeModalKontribusiKhusus');

        $this->reset(['nama', 'pic', 'telp_pic']);
    }

    public function render()
    {
        return view('livewire.admin.kontribusi-khusus.create-kontribusi-khusus');
    }
}
