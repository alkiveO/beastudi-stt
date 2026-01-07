@if(!$monitoring)
    <div class="modal-body text-center text-muted p-4">
        Pilih mahasiswa untuk presensi
    </div>
@else
<div>
    <!-- HEADER -->
    <div class="modal-header">
        <h5 class="modal-title">Presensi Mahasiswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    <!-- BODY -->
    <div class="modal-body">

        <div class="mb-3">
            <strong>NIM:</strong> {{ $monitoring->mahasiswa->nim }} <br>
            <strong>Nama:</strong> {{ $monitoring->mahasiswa->nama }} <br>
            <strong>Periode:</strong> {{ $monitoring->periode->nama }}
        </div>

        <table class="table table-bordered table-sm">
            <thead class="table-light">
                <tr>
                    <th>Mata Kuliah</th>
                    <th width="160">Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @forelse($listKrs as $krs)
                    <tr wire:key="krs-{{ $krs->id }}">
                        <td>{{ $krs->matakuliah->nama_mk }}</td>
                        <td>
                            <input type="number"
                                   min="0"
                                   max="16"
                                   class="form-control form-control-sm"
                                   wire:model.defer="presensi.{{ $krs->id }}">
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted">
                            Tidak ada matakuliah
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <!-- FOOTER -->
    <div class="modal-footer">
        <button
            class="btn btn-primary"
            wire:click="saveAllPresensi"
            wire:loading.attr="disabled">
            <i class="fa fa-save"></i> Simpan Presensi
        </button>
    </div>
</div>
@endif
