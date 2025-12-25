<div>
    <form wire:submit.prevent='store'>
        <div class="card-body">
            <div class="form-group">
                <label for="nama" class="form-label text-dark">
                    Kontribusi Khusus
                </label>
                <input type="text" class="form-control" id="nama" autocomplete="off" wire:model.debounce='nama'>
                <div class="text-danger">@error('nama') {{ $message }} @enderror</div>
            </div>

            <div class="form-group mt-2">
                <label for="list" class="form-label text-dark">
                    List Task Kontribusi Khusus
                </label>
                <textarea
                  id="list"
                  style="resize:none;height: 150px !important;"
                  class="form-control list_kontribusi"
                  wire:model.debounce='list_kontribusi'
                  oninput="auto_grow(this)"></textarea>
                  <span>tekan enter jika list task kontribusi lebih dari satu</span>
            </div>

            <div class="form-group mt-2">
                <label for="pic" class="form-label text-dark">
                    Nama PIC
                </label>
                <input type="text" class="form-control" id="pic" autocomplete="off" wire:model.debounce='pic'>
                <div class="text-danger">@error('pic') {{ $message }} @enderror</div>
            </div>

            <div class="form-group mt-2">
                <label for="telp_pic" class="form-label text-dark">
                    Nomor Handphone /ID Telegram PIC
                </label>
                <input type="text" class="form-control" id="telp_pic" autocomplete="off" wire:model.debounce='telp_pic'>
                <div class="text-danger">@error('telp_pic') {{ $message }} @enderror</div>
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
