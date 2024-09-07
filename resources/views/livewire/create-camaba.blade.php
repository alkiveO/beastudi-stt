<div>
    <form wire:submit.prevent='store'>
        <header class="d-flex flex-wrap justify-content-center border-2 mb-4">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img src="images/logo.png" width="90" alt="logo-nf">
            </a>
        </header>
        <div>
            <p class="fs-4 text-body">Data Diri Calon Mahasiswa</p>
        </div>
        <hr>
        <div class="mb-3">
            <label for="#" class="fw-semibold text-dark">Nama Mahasiswa</label>
            <input type="text" class="form-control" autocomplete="off" wire:model.lazy='mahasiswa'>
            <span class="required">@error('mahasiswa') {{ $message }} @enderror</span>
        </div>
        <div class="mb-3">
            <label class="form-label text-dark">Program Studi</label>
            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                <select id="prodi" class="default-select form-control wide" wire:model.lazy='program_studi'>
                    <option hidden>Nothing Selected</option>
                    @foreach($list_prodi as $prodi)
                        <option value="{{ $prodi->nama }}">{{ ucwords($prodi->nama) }}</option>
                    @endforeach
                </select>
                <div class="dropdown-menu ">
                    <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                    </div>
                </div>
            </div>
            <span class="required">@error('program_studi') {{ $message }} @enderror</span>
        </div>
        <div class="mb-3">
            <label for="#" class="fw-semibold text-dark">Tahun Angkatan Masuk</label>
            <input type="number" class="form-control" autocomplete="off" wire:model.debounce='tahun_masuk'>
            <span class="required">@error('tahun_masuk') {{ $message }} @enderror</span>
        </div>
        <div>
            <p class="fs-4 mt-4 text-body">Unggah Dokumen SPB</p>
        </div>
        <hr>
        <div class="mb-3">
            <label for="#" class="fw-semibold text-dark">Unggah dokumen SPB Rangkap 1</label>
            <input class="form-control" type="file" id="file" wire:model.lazy='spb_rangkap_1'>
            <span class="required">@error('spb_rangkap_1') {{ $message }} @enderror</span>
        </div>
        <div class="mb-3">
            <label for="#" class="fw-semibold text-dark">Unggah dokumen SPB Rangkap 2</label>
            <input class="form-control" type="file" id="file" wire:model.lazy='spb_rangkap_2'>
            <span class="required">@error('spb_rangkap_2') {{ $message }} @enderror</span>
        </div>
        <div class="mb-3">
            <label for="#" class="fw-semibold text-dark">Unggah dokumen Surat Komitmen Orang Tua</label>
            <input class="form-control" type="file" id="file" wire:model.lazy='surat_komitmen_ortu'>
            <span class="required">@error('surat_komitmen_ortu') {{ $message }} @enderror</span>
        </div>
        <button type="submit" class="btn btn-primary mt-4 px-3">Simpan</button>
    </form>
</div>
