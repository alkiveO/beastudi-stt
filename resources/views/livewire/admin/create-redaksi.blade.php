<div>
    <form wire:submit.prevent='store'>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">
                                Pilih Publish Redaksi
                            </label>
                            <div wire:ignore>
                                <select id="bootstrap-select" class="form-control" wire:model.debounce='jenis'>
                                    <option value="">Pilih</option>
                                    <option value="login page mahasiswa">Login Page Mahasiswa</option>
                                    <option value="login spb mahasiswa">Login SPB Mahasiswa</option>
                                </select>
                            </div>
                            <span class="required">@error('jenis') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">
                                Judul Redaksi
                            </label>
                            <input type="text" class="form-control" autocomplete="off" wire:model.debounce='judul'>
                            <span class="required">@error('judul') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">
                                Deskripsi Redaksi
                            </label>
                            <textarea class="form-control monitoring" autocomplete="off" wire:model.debounce='deskripsi' style="resize:none;" maxLength='1500' placeholder="Masukan redaksi maksimum 1500 kata"></textarea>
                            <span class="required">@error('deskripsi') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="border: none;">
                <div>
                    <button class="btn btn-primary">Publish</button>
                </div>
            </div>
        </div>
    </form>
</div>
