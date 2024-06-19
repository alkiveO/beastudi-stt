<div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Form SPB MOU</h5>
        </div>
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="card-body">
                <div class="mb-3 custom-form">
                    <label for="nim" class="form-label text-dark">
                        NIM
                    </label>
                   <input type="number" class="form-control" id="nim" autocomplete="off" wire:model.debounce='nim'>
                    <span class="required">@error('nim') {{ $message }} @enderror</span>
                </div>
                <div class="mb-3 custom-form">
                    <label for="mahasiswa" class="form-label text-dark">
                        Nama Mahasiswa
                    </label>
                    <input type="text" class="form-control" id="mahasiswa" autocomplete="off" wire:model.debounce='mahasiswa'>
                    <span class="required">@error('mahasiswa') {{ $message }} @enderror</span>
                </div>
                <div class="mb-3 custom-form">
                    <label class="form-label text-dark">Program Studi</label>
                    <div class="dropdown bootstrap-select default-select form-control wide mb-3" wire:ignore>
                        <select id="prodi" class="default-select form-control wide mb-3" wire:model.debounce='program_studi_id'>
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
                <div class="mb-3 custom-form">
                    <label for="angkatan" class="form-label text-dark">Angkatan Tahun Masuk</label>
                    <input type="number" class="form-control" id="angkatan" autocomplete="off" wire:model.debounce='angkatan'>
                    <span class="required">@error('angkatan') {{ $message }} @enderror</span>
                </div>
                <div class="mb-3 custom-form">
                    <label for="file" class="form-label text-dark">Upload File MOU</label>
                    <input class="form-control" type="file" id="file" wire:model='file'>
                    <div class="text-danger">@error('file') {{ $message }} @enderror</div>
                </div>
                <div class="">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
