<?php

namespace App\Http\Livewire\Admin;

use App\Models\Redaksi;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateRedaksi extends Component
{
//     public $jenis;
//     public $judul;
//     public $deskripsi;

//     protected $rules = [
//         'jenis' => 'required',
//         'judul' => 'required',
// 'deskripsi' => 'required|string',

//     ];

//     public function updated($propertyName)
//     {
//         $this->validateOnly($propertyName);
//     }

//     public function store()
//     {
//         $this->validate();

//         $redaksi_login_page = Redaksi::query()
//             ->where('jenis', 'login page mahasiswa')
//             ->first();

//         $redaksi_login_spb = Redaksi::query()
//             ->where('jenis', 'login spb mahasiswa')
//             ->first();

//         if ($this->jenis == 'login page mahasiswa' && $redaksi_login_page) {
//             $redaksi_login_page->update([
//                 'judul' => $this->judul,
//                 'deskripsi' => $this->deskripsi,
//             ]);

//             $this->emit('alert', 'Berhasil', 'Redaksi berhasil diupdate', 'success');
//         }

//         if ($this->jenis == 'login page mahasiswa' && ! $redaksi_login_page) {
//             Redaksi::create([
//                 'jenis' => $this->jenis,
//                 'slug' => Str::slug($this->jenis),
//                 'judul' => $this->judul,
//                 'deskripsi' => $this->deskripsi
//             ]);

//             $this->emit('alert', 'Berhasil', 'Redaksi berhasil ditambahkan', 'success');
//         }

//         if ($this->jenis == 'login spb mahasiswa' && $redaksi_login_spb) {
//             $redaksi_login_spb->update([
//                 'judul' => $this->judul,
//                 'deskripsi' => $this->deskripsi,
//             ]);

//             $this->emit('alert', 'Berhasil', 'Redaksi berhasil diupdate', 'success');
//         }

//         if ($this->jenis == 'login spb mahasiswa' && ! $redaksi_login_spb) {
//             Redaksi::create([
//                 'jenis' => $this->jenis,
//                 'slug' => Str::slug($this->jenis),
//                 'judul' => $this->judul,
//                 'deskripsi' => $this->deskripsi
//             ]);

//             $this->emit('alert', 'Berhasil', 'Redaksi berhasil ditambahkan', 'success');
//         }

//         $this->reset(['judul', 'deskripsi']);
//         $this->emit('resetBootstrapSelect');
//     }

//     public function render()
//     {
//         return view('livewire.admin.create-redaksi');
//     }

public $jenis;
    public $judul;
    public $deskripsi;

    protected $rules = [
        'jenis' => 'required',
        'judul' => 'required',
        'deskripsi' => 'required|string',
    ];

    // 🔥 LOAD DATA SAAT JENIS DIPILIH
    public function updatedJenis($value)
    {
        $redaksi = Redaksi::where('jenis', $value)->first();

        if ($redaksi) {
            $this->judul = $redaksi->judul;
            $this->deskripsi = $redaksi->deskripsi;

            // kirim ke JS (Summernote)
            $this->dispatchBrowserEvent('set-summernote', [
                'deskripsi' => $this->deskripsi
            ]);
        } else {
            $this->reset(['judul', 'deskripsi']);

            $this->dispatchBrowserEvent('set-summernote', [
                'deskripsi' => ''
            ]);
        }
    }

    public function store()
    {
        $this->validate();

        $redaksi = Redaksi::where('jenis', $this->jenis)->first();

        if ($redaksi) {
            $redaksi->update([
                'judul' => $this->judul,
                'deskripsi' => $this->deskripsi,
            ]);
            $this->emit('alert', 'Berhasil', 'Redaksi berhasil diupdate', 'success');
        } else {
            Redaksi::create([
                'jenis' => $this->jenis,
                'slug' => Str::slug($this->jenis),
                'judul' => $this->judul,
                'deskripsi' => $this->deskripsi,
            ]);
            $this->emit('alert', 'Berhasil', 'Redaksi berhasil ditambahkan', 'success');
        }
    }

    public function render()
    {
        return view('livewire.admin.create-redaksi');
    }
}
