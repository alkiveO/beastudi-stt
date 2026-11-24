<div>
    <div wire:ignore.self class="modal fade" id="addPembimbingAkademik" tabindex="-1" aria-labelledby="addPembimbingAkademikLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="store" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPembimbingAkademikLabel">Tambah Pembimbing Akademik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="program_studi" class="form-label">Program Studi</label>
                        <select wire:model.lazy="program_studi" id="program_studi" class="form-control">
                            <option value="" hidden>Nothing selected</option>
                            <option value="bisnis digital">Bisnis Digital</option>
                            <option value="sistem informasi">Sistem Informasi</option>
                            <option value="teknik informatika">Teknik Informatika</option>
                        </select>
                        @error('program_studi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Dosen</label>
                        <input wire:model.lazy="nama" type="text" id="nama" class="form-control text-uppercase" autocomplete="off">
                        @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <hr>

                    <h6 class="mb-3">Informasi Akun PA</h6>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Login</label>
                        <input wire:model.lazy="email" type="email" id="email" class="form-control" placeholder="Masukkan email PA" autocomplete="off">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password Login</label>
                        <input wire:model.lazy="password" type="password" id="password" class="form-control" placeholder="Minimal 8 karakter" autocomplete="new-password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    @push('script')
        <script>
            Livewire.on('closeModal', () => {
                $('#addPembimbingAkademik').modal('hide')
            })
        </script>
    @endpush
</div>