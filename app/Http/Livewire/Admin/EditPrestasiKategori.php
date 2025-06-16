<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Prestasi;
use App\Models\KategoriPrestasi;

class EditPrestasiKategori extends Component
{
    public $prestasiId;
    public $showModal = false;
    public $selectedKategori;
    public $kategoriOptions;

    public function mount($prestasiId)
    {
        $this->prestasiId = $prestasiId;
        $this->kategoriOptions = KategoriPrestasi::all();
        $this->selectedKategori = Prestasi::with('kategori_prestasi')->find($prestasiId)->kategori_prestasi_id;
    }

    public function getKategoriNama()
    {
        $prestasi = Prestasi::with('kategori_prestasi')->find($this->prestasiId);
        return $prestasi->kategori_prestasi->nama ?? 'Tidak ada kategori';
    }

    public function openModal()
    {
        $this->selectedKategori = Prestasi::find($this->prestasiId)->kategori_prestasi_id;
        $this->showModal = true;
    }

    public function saveKategori()
    {
        Prestasi::find($this->prestasiId)->update([
            'kategori_prestasi_id' => $this->selectedKategori
        ]);

        $this->emit('alert', 'Berhasil', 'Kategori prestasi berhasil diubah', 'success');

        $this->emit('kategoriUpdated', $this->prestasiId);

        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.admin.edit-prestasi-kategori', [
            'kategoriNama' => $this->getKategoriNama()
        ]);
    }
}
