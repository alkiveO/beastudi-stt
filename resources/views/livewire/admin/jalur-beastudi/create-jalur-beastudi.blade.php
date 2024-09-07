<div>
    <form wire:submit.prevent='store'>
        <div class="card-body">
            <div class="form-group">
                <label for="nama" class="form-label text-dark">
                   Jalur Beastudi
                </label>
                <input type="text" class="form-control" id="nama" autocomplete="off" wire:model.blur='nama'>
                <div class="text-danger">@error('nama') {{ $message }} @enderror</div>
            </div>
        </div>

        <div class="card-footer" style="border: none;">
            <div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
