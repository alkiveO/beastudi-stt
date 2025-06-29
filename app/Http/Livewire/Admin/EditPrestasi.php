<?php

namespace App\Http\Livewire\Admin;

use App\Models\KategoriPrestasi;
use App\Models\Periode;
use App\Models\Prestasi;
use Livewire\Component;

class EditPrestasi extends Component
{
    public $prestasi;
    public $nim;
    // public $nama_mhs;
    public $semester;
    public $periode;
    public $nama; // lomba
    public $kategori_prestasi;

    protected $listeners = [
        'setEditPrestasi'
    ];

    public function setEditPrestasi($prestasi)
    {
        $this->prestasi = $prestasi;
        $this->nim = $prestasi['nim'];
        // $this->nama_mhs = $prestasi['mahasiswa']['nama'];
        $this->semester = $prestasi['semester'];
        $this->periode = $prestasi['periode_id'];
        $this->nama = $prestasi['nama'];
        $this->kategori_prestasi = $prestasi['kategori_prestasi_id'];

        $this->dispatchBrowserEvent('semester-updated', [
            'value' => $this->semester,
        ]);
        $this->dispatchBrowserEvent('periode-updated', [
            'value' => $this->periode,
        ]);
        $this->dispatchBrowserEvent('kategori-prestasi-updated', [
            'value' => $this->kategori_prestasi,
        ]);
    }

    public function updated($key, $value)
    {
        if ($key === 'semester') {
            $this->semester = $value;
        }
        if ($key === 'periode') {
            $this->periode = $value;
        }
        if ($key === 'kategori_prestasi') {
            $this->kategori_prestasi = $value;
        }
    }

    public function update()
    {
        Prestasi::find($this->prestasi['id'])
            ->update([
                'nim' => $this->nim,
                'semester' => $this->semester,
                'periode_id' => $this->periode,
                'nama' => $this->nama,
                'kategori_prestasi_id' => $this->kategori_prestasi,
            ]);

        $this->emit('alert', 'Berhasil', 'Prestasi berhasil diubah', 'success');

        $this->emitTo(ListPrestasi::class, 'refreshPage');

        $this->emit('closeModalPrestasi');
    }

    public function render()
    {
        return view('livewire.admin.edit-prestasi', [
            'semester_arr' => [1,2,3,4,5,6,7,8],
            'list_periode' => Periode::all(),
            'list_kategori_prestasi' => KategoriPrestasi::all()
        ]);
    }
}
