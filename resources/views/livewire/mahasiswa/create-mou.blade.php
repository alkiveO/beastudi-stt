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
                   <input type="number" class="form-control" id="nim" autocomplete="off" wire:model.debounce='nim' disabled>
                </div>
                <div class="mb-3 custom-form">
                    <label for="mahasiswa" class="form-label text-dark">
                        Nama Mahasiswa
                    </label>
                    <input type="text" class="form-control" id="mahasiswa" autocomplete="off" wire:model.debounce='mahasiswa' disabled>
                </div>
                <div class="mb-3 custom-form">
                    <label for="program_studi" class="form-label text-dark">
                        Program Studi
                    </label>
                    <input type="text" class="form-control" id="program_studi" autocomplete="off" wire:model.debounce='program_studi' disabled>
                </div>
                <div class="mb-3 custom-form">
                    <label for="angkatan" class="form-label text-dark">Angkatan Tahun Masuk</label>
                    <input type="number" class="form-control" id="angkatan" autocomplete="off" wire:model.debounce='angkatan' disabled>
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
