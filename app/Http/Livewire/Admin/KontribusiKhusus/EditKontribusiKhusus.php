<?php

namespace App\Http\Livewire\Admin\KontribusiKhusus;

use Livewire\Component;
use App\Models\KontribusiKhusus;
use App\Models\ItemKontribusiKhusus;

class EditKontribusiKhusus extends Component
{
    public $kontribusi_khusus_id;
    public $nama;
    public $pic;
    public $telp_pic;
    public $list_kontribusi;

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
        'telp_pic.max' => 'nomor handphone / ID Telegram pic maksimal 20 karakter',
    ];

    protected $listeners = [
        'setEditKontribusiKhusus'
    ];

    public function setEditKontribusiKhusus($kontribusi_khusus)
    {
        $this->kontribusi_khusus_id = $kontribusi_khusus['id'];
        $this->nama = $kontribusi_khusus['nama'];
        $this->pic = $kontribusi_khusus['pic'];
        $this->telp_pic = $kontribusi_khusus['telp_pic'];
        $this->list_kontribusi = count($kontribusi_khusus['item_kontribusi_khusus']) > 0
             ? implode("\n", array_column($kontribusi_khusus['item_kontribusi_khusus'], 'nama'))
             : '';
    }

    public function update()
    {
        $this->validate();

        KontribusiKhusus::updateOrCreate(
            ['id' => $this->kontribusi_khusus_id],
            [
                'nama' => $this->nama,
                'pic' => $this->pic,
                'telp_pic' => $this->telp_pic,
            ]
        );

        $this->updateItems();

        $this->emit('alert', 'Berhasil', 'Kontribusi khusus berhasil diubah', 'success');

        $this->emitTo(ListKontribusiKhusus::class, 'refreshPage');

        $this->emit('closeModalKontribusiKhusus');
    }

    public function updateItems()
    {
        // Dapatkan semua ID dari item yang ada untuk kontribusi khusus ini
        $existingItems = ItemKontribusiKhusus::query()
            ->where('kontribusi_khusus_id', $this->kontribusi_khusus_id)
            ->pluck('id')
            ->toArray();

        // Cek apakah list_kontribusi mengandung \n
        if (!str_contains($this->list_kontribusi, "\n")) {
            // Jika tidak mengandung \n, update item pertama saja
            if (!empty($existingItems)) {
                // Update item pertama
                ItemKontribusiKhusus::query()
                    ->where('id', $existingItems[0])
                    ->update(['nama' => $this->list_kontribusi]);

                // Hapus item lain jika ada lebih dari satu
                if (count($existingItems) > 1) {
                    $unusedItems = array_slice($existingItems, 1);
                    ItemKontribusiKhusus::whereIn('id', $unusedItems)->delete();
                }
            } else {
                // Jika tidak ada item yang sudah ada, buat baru
                ItemKontribusiKhusus::create([
                    'kontribusi_khusus_id' => $this->kontribusi_khusus_id,
                    'nama' => $this->list_kontribusi,
                ]);
            }
        } else {
            // Jika mengandung \n, lakukan pemisahan dan update seperti biasa
            $item_kontribusi = explode("\n", $this->list_kontribusi);

            foreach ($item_kontribusi as $index => $item) {
                if (isset($existingItems[$index])) {
                    // Update existing item
                    ItemKontribusiKhusus::query()
                        ->where('id', $existingItems[$index])
                        ->update(['nama' => $item]);
                } else {
                    // Create new item
                    ItemKontribusiKhusus::create([
                        'kontribusi_khusus_id' => $this->kontribusi_khusus_id,
                        'nama' => $item,
                    ]);
                }
            }

            // Hapus item yang tidak terpakai lagi
            $unusedItems = array_slice($existingItems, count($item_kontribusi));
            if (!empty($unusedItems)) {
                ItemKontribusiKhusus::whereIn('id', $unusedItems)->delete();
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.kontribusi-khusus.edit-kontribusi-khusus');
    }
}
