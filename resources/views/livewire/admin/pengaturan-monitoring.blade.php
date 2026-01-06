<div>
    {{-- STATUS + TOMBOL --}}
    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap mb-3">

        {{-- STATUS OTOMATIS --}}
        <div>
            @if($this->status)
                <span class="badge bg-success px-3 py-2">
                    <i class="fa fa-lock-open me-1"></i> Pengumpulan AKTIF
                </span>
            @else
                <span class="badge bg-danger px-3 py-2">
                    <i class="fa fa-lock me-1"></i> Pengumpulan DITUTUP
                </span>
            @endif
        </div>

      <button class="btn btn-outline-primary btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#modalPengaturanMonitoring">
            <i class="fa fa-cog me-1"></i> Pengaturan Jadwal
        </button>
    </div>

    {{-- ================= MODAL ================= --}}
    <div wire:ignore.self
         class="modal fade"
         id="modalPengaturanMonitoring"
         tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                {{-- HEADER --}}
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-calendar-alt me-2"></i>
                        Pengaturan Jadwal Pengumpulan
                    </h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                {{-- BODY --}}
                <div class="modal-body">

                    {{-- STATUS INFO --}}
                    <div class="text-center mb-3">
                         @if($this->status)
                            <span class="badge bg-success px-3 py-2">
                                Saat ini pengumpulan sedang AKTIF
                            </span>
                        @else
                            <span class="badge bg-danger px-3 py-2">
                                Saat ini pengumpulan DITUTUP
                            </span>
                        @endif
                    </div>

                    {{-- TANGGAL BUKA --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Tanggal & Jam Buka
                        </label>
                        <input type="datetime-local"
                               wire:model.defer="tanggal_buka"
                               class="form-control">
                    </div>

                    {{-- TANGGAL TUTUP --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Tanggal & Jam Tutup
                        </label>
                        <input type="datetime-local"
                               wire:model.defer="tanggal_tutup"
                               class="form-control">
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer">
                    <button class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button wire:click="save"
                            class="btn btn-primary"
                            data-bs-dismiss="modal">
                        Simpan Jadwal
                    </button>
                </div>

            </div>
        </div>
    </div>
@push('script')
    {{-- ================= SWEETALERT2 ================= --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        window.addEventListener('swal', function (event) {
            Swal.fire({
                icon: event.detail.icon ?? 'success',
                title: event.detail.title ?? 'Berhasil',
                text: event.detail.text ?? '',
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
</div>

@endpush