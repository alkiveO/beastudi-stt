<div>
    <form wire:submit.prevent="update">
        <div class="modal-body">
            <div class="mb-3">
                <label for="nim" class="form-label text-dark">
                    NIM
                </label>
                <input type="number" class="form-control" id="nim" autocomplete="off" wire:model.debounce='nim'>
                <span class="required">@error('nim') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
                <label for="mahasiswa" class="form-label text-dark">
                    Nama Mahasiswa
                </label>
                <input type="text" class="form-control" id="mahasiswa" autocomplete="off" wire:model.debounce='mahasiswa'>
                <span class="required">@error('mahasiswa') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
                <label for="angkatan" class="form-label text-dark">Angkatan Tahun Masuk</label>
                <input type="number" class="form-control" id="angkatan" autocomplete="off" wire:model.debounce='angkatan'>
                <span class="required">@error('angkatan') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
                <label class="form-label text-dark">Program Studi</label>
                <div class="dropdown bootstrap-select default-select form-control wide mb-3" wire:ignore>
                    <select id="edit-prodi" class="default-select form-control wide mb-3" wire:model.debounce='program_studi_id'>
                        <option>Pilih</option>
                        @foreach($program_studi as $program)
                        <option value="{{ $program->id }}">{{ ucwords($program->nama) }}</option>
                        @endforeach
                    </select>
                    <div class="dropdown-menu">
                        <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                            <ul class="dropdown-menu inner show" role="presentation"></ul>
                        </div>
                    </div>
                </div>
                <span class="required">@error('program_studi_id') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
                <label class="form-label text-dark">Jalur Prestasi</label>
                <div class="dropdown bootstrap-select default-select form-control wide mb-3" wire:ignore>
                    <select id="edit-jalur-prestasi" class="default-select form-control wide mb-3" wire:model.debounce='jalur_prestasi_id'>
                        <option>Pilih</option>
                        @foreach($list_prestasi as $jalur_prestasi)
                        <option value="{{ $jalur_prestasi->id }}">{{ ucwords($jalur_prestasi->nama) }}</option>
                        @endforeach
                    </select>
                    <div class="dropdown-menu">
                        <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                            <ul class="dropdown-menu inner show" role="presentation"></ul>
                        </div>
                    </div>
                </div>
                <span class="required">@error('jalur_prestasi_id') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
                <label for="handphone" class="form-label text-dark">Nomor Handhone Aktif</label>
                <input type="number" class="form-control" id="handphone" autocomplete="off" wire:model.debounce='handphone'>
                <span class="required">@error('handphone') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
                <label for="handphone_ortu" class="form-label text-dark">Nomor Handhone Aktif Ortu</label>
                <input type="number" class="form-control" id="handphone_ortu" autocomplete="off" wire:model.debounce='handphone_ortu'>
                <span class="required">@error('handphone_ortu') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
                <label for="alamat_domisili" class="form-label text-dark">Alamat Domisili</label>
                <input type="text" class="form-control" id="alamat_domisili" autocomplete="off" wire:model.debounce='alamat_domisili'>
                <span class="required">@error('alamat_domisili') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
                <label for="alamat_kota" class="form-label text-dark">Alamat Kota (sesuai KTP)</label>
                <input type="text" class="form-control" id="alamat_kota" autocomplete="off" wire:model.debounce='alamat_kota'>
                <span class="required">@error('alamat_kota') {{ $message }} @enderror</span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
</div>
