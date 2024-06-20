<div>
    <form wire:submit.prevent="update" enctype="multipart/form-data">
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
                <label for="angkatan" class="form-label text-dark">Angkatan Tahun Masuk</label>
                <input type="number" class="form-control" id="angkatan" autocomplete="off" wire:model.debounce='angkatan'>
                <span class="required">@error('angkatan') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
                    <label for="kontribusi" class="form-label text-dark">Kontribusi</label>
                    <textarea class="form-control" id="kontribusi" cols="30" rows="10" wire:model.debounce='kontribusi' style="resize:none;"></textarea>
                    <span class="required">@error('kontribusi') {{ $message }} @enderror</span>
                </div>
            <div class="mb-3">
                <label for="file" class="form-label text-dark">Upload File LPJ</label>
                <input class="form-control" type="file" id="file" wire:model='file'>
                <div class="text-danger">@error('file') {{ $message }} @enderror</div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
</div>
