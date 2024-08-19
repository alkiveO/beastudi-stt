<div>
    <form wire:submit.prevent='update'>
        <div class="card-body">
            <label for="nama" class="form-label text-dark">
                Kontribusi Khusus
            </label>
            <input type="text" class="form-control" id="nama" autocomplete="off" wire:model.debounce='nama'>
        </div>

        <div class="card-footer" style="border: none;">
            <div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
