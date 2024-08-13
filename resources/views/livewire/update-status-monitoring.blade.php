<div>
    <form wire:submit.prevent='store'>
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="updateStatusMonitoringModalLabel">Form Monitoring Beastudi / Update Status</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        @if($monitoring)
            <h3>{{ $monitoring->mahasiswa->nama }}</h3>
            <div class="d-flex">
                <p>{{ $monitoring->nim }}</p> &nbsp;&nbsp;
                <p>{{ ucwords($monitoring->mahasiswa->program_studi) }}</p>
            </div>

            <br>

            <select class="form-control" wire:model.lazy='status_beastudi'>
                <option>Pilih</option>
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
