@if(!$monitoring)
    <div class="modal-body text-center text-muted p-4">
        Pilih mahasiswa untuk evaluasi
    </div>
@else
<div>

    {{-- HEADER --}}
    <div class="modal-header">
        <h5 class="modal-title">Evaluasi Mahasiswa</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    {{-- BODY --}}
    <div class="modal-body">

        {{-- INFO MAHASISWA --}}
        <div class="mb-3">
            <strong>NIM:</strong> {{ $monitoring->mahasiswa->nim }} <br>
            <strong>Nama:</strong> {{ $monitoring->mahasiswa->nama }} <br>
            <strong>Periode Aktif:</strong> {{ $monitoring->periode->nama }} <br>
            <strong>Semester:</strong> {{ $monitoring->semester }}
        </div>

        {{-- RIWAYAT EVALUASI --}}
        <div class="mb-4">
            <h6 class="fw-bold">Riwayat Evaluasi (SP)</h6>

            <table class="table table-sm table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Periode</th>
                        <th>Semester</th>
                        <th>SP</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($historyEvaluasi as $item)
                        <tr>
                            <td>{{ $item->monitoring->periode->nama }}</td>
                            <td>{{ $item->monitoring->semester }}</td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    {{ $item->jenis_sp }}
                                </span>
                            </td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                             <td class="text-center">
                            <button
                                class="btn btn-sm btn-danger"
                                wire:click="deleteEvaluasi({{ $item->id }})"
                                onclick="return confirm('Yakin ingin menghapus history SP ini?')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Belum ada evaluasi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- FORM INPUT EVALUASI BARU --}}
        <div class="border-top pt-3">
            <h6 class="fw-bold">Tambah Evaluasi</h6>

            <div class="mb-3">
                <label>Jenis SP</label>
                <select class="form-control" wire:model="jenis_sp">
                    <option value="">-- Pilih --</option>
                    <option value="SP1">SP 1</option>
                    <option value="SP2">SP 2</option>
                    <option value="SP3">SP 3</option>
                    <option value="SP Terakhir">SP Terakhir</option>

                </select>
                @error('jenis_sp') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label>Keterangan</label>
                <textarea class="form-control" wire:model.defer="keterangan"></textarea>
                @error('keterangan') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" class="form-control" wire:model="tanggal">
            </div>

            <div class="text-end">
                <button class="btn btn-primary" wire:click="save">
                    Simpan Evaluasi
                </button>
            </div>
        </div>

    </div>
</div>
@endif
