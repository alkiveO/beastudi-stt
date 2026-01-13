<div>
    <div class="modal-header">
        <h5 class="modal-title">Import Presensi Mahasiswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">

        {{-- PROGRAM STUDI --}}
        <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <select class="form-control" wire:model.defer="program_studi">
                <option value="">-- Pilih --</option>
                @foreach($listProdi as $prodi)
                    <option value="{{ $prodi }}">{{ $prodi }}</option>
                @endforeach
            </select>
            @error('program_studi') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- PERIODE --}}
        <div class="mb-3">
            <label class="form-label">Periode</label>
            <select class="form-control" wire:model.defer="periode_id">
                <option value="">-- Pilih --</option>
                @foreach($periodes as $periode)
                    <option value="{{ $periode->id }}">{{ $periode->nama }}</option>
                @endforeach
            </select>
            @error('periode_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- FILE --}}
        <div class="mb-3">
            <label class="form-label">File Excel</label>
            <input type="file" class="form-control" wire:model.defer="file">
            @error('file') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div wire:loading wire:target="file" class="text-muted">
            Uploading...
        </div>

    </div>

    <div class="modal-footer">
        <button class="btn btn-primary"
                wire:click="import"
                wire:loading.attr="disabled"
                wire:target="import,file">
            <i class="fa fa-upload"></i> Proses Import
        </button>
    </div>
</div>
