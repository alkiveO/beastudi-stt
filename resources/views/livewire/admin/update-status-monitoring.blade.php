<div>
    <form wire:submit.prevent='store'>
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="updateStatusMonitoringModalLabel">Form Monitoring Beastudi / Update Status</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
     <div class="modal-body">
    @if($monitoringId) {{-- Cek berdasarkan ID --}}
        <h3>{{ $nama_mahasiswa }}</h3>
        <div class="d-flex">
            <p>{{ $nim_mahasiswa }}</p> &nbsp;&nbsp;
            <p>{{ ucwords($prodi_mahasiswa) }}</p>
        </div>

            <br>

            <select class="form-control" wire:model.lazy='status_beastudi'>
                <option hidden>Nothing Selected</option>
                <option value="aman">Aman</option>
                <option value="evaluasi">Evaluasi</option>
                <option value="keluar">Keluar</option>
            </select>
            <div class="text-danger">@error('status_beastudi') {{ $message }} @enderror</div>
        @endif
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan dan kirim</button>
        </div>
    </form>
</div>
