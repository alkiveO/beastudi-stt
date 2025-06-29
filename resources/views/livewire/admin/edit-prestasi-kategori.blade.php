<div>
    <a href="#" wire:click.prevent="openModal" class="text-white btn btn-sm btn-info">Edit</a>

    @if($showModal)
        <div class="modal fade show" style="display: block;" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kategori Prestasi</h5>
                        <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select wire:model="selectedKategori" class="form-control">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoriOptions as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Batal</button>
                        <button type="button" class="btn btn-primary" wire:click="saveKategori">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
