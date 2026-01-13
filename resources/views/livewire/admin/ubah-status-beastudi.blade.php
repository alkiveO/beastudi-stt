<div>
    @if(!$monitoring)
    <div class="modal-body text-center text-muted p-4">
        Pilih mahasiswa untuk mengubah status
    </div>
@else
<div>

    {{-- HEADER --}}
    <div class="modal-header">
        <h5 class="modal-title">
            Ubah Status Beastudi
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    {{-- BODY --}}
    <div class="modal-body">

        <div class="mb-3">
            <strong>NIM:</strong> {{ $monitoring->mahasiswa->nim }} <br>
            <strong>Nama:</strong> {{ $monitoring->mahasiswa->nama }} <br>
            <strong>Periode:</strong> {{ $monitoring->periode->nama }}
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Status Beastudi</label>

            <select class="form-control"
                    wire:model="status_beastudi">
                <option value="evaluasi">Evaluasi</option>
                <option value="aman">Aman</option>
                <option value="keluar">Keluar</option>
            </select>
        </div>

    </div>

    {{-- FOOTER --}}
    <div class="modal-footer">
        <button class="btn btn-secondary"
                data-bs-dismiss="modal">
            Batal
        </button>

        <button class="btn btn-primary"
                wire:click="simpan"
                wire:loading.attr="disabled">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>

</div>
@endif

</div>
