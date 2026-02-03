<?php

namespace App\Http\Livewire\Admin;

use App\Models\Redaksi;
use Livewire\Component;
use Illuminate\Support\Str;
use DOMDocument;
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




private function normalizeListHtml($html)
{
    if (!$html) {
        return $html;
    }

    libxml_use_internal_errors(true);

    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->loadHTML('<meta charset="UTF-8">'.$html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    foreach ($dom->getElementsByTagName('ul') as $ul) {
        $lis = $ul->getElementsByTagName('li');

        // jika hanya ada 1 <li> tapi isinya banyak <br>
        if ($lis->length === 1) {
            $li = $lis->item(0);
            $innerHTML = '';

            foreach ($li->childNodes as $child) {
                $innerHTML .= $dom->saveHTML($child);
            }

            if (stripos($innerHTML, '<br') !== false) {
                $lines = preg_split('/<br\s*\/?>/i', $innerHTML);

                // hapus li lama
                while ($ul->firstChild) {
                    $ul->removeChild($ul->firstChild);
                }

                foreach ($lines as $line) {
                    $text = trim(strip_tags($line));
                    if ($text !== '') {
                        $newLi = $dom->createElement('li');
                        $newLi->appendChild($dom->createTextNode($text));
                        $ul->appendChild($newLi);
                    }
                }
            }
        }
    }

    return $dom->saveHTML();
}

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

    // 🔥 AUTO FIX LIST HTML DI SINI
    $this->deskripsi = $this->normalizeListHtml($this->deskripsi);

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
