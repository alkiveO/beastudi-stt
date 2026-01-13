<div>
    <div class="card">
        <div class="card-body">

            {{-- PENGATURAN PENGUMPULAN --}}
            <div class="mb-3">
                @livewire('admin.pengaturan-monitoring')
            </div>

            {{-- TAB STATUS --}}
            <div class="mb-3">
                <div class="d-flex justify-content-center">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#"
                               class="nav-link {{ $status_beastudi === 'evaluasi' ? 'active' : '' }}"
                               wire:click.prevent="$set('status_beastudi', 'evaluasi')">
                                <i class="fa fa-exclamation-circle text-warning"></i> Evaluasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#"
                               class="nav-link {{ $status_beastudi === 'aman' ? 'active' : '' }}"
                               wire:click.prevent="$set('status_beastudi', 'aman')">
                                <i class="fa fa-check-circle text-success"></i> Aman
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#"
                               class="nav-link {{ $status_beastudi === 'keluar' ? 'active' : '' }}"
                               wire:click.prevent="$set('status_beastudi', 'keluar')">
                                <i class="fa fa-times-circle text-danger"></i> Keluar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- FILTER --}}
            <div class="row g-3 mb-3">

                <div class="col-md-3">
                    <label class="form-label text-dark">NIM</label>
                   <input type="text"
       class="form-control"
       wire:model.lazy="nim">
                </div>

                <div class="col-md-3">
                    <label class="form-label text-dark">Nama Mahasiswa</label>
                   <input type="text"
       class="form-control"
       wire:model.lazy="nama">
                </div>

               <div class="col-md-3" wire:key="filter-semester">
    <label class="form-label text-dark">Semester</label>
    <div class="dropdown bootstrap-select default-select w-100" wire:ignore>
        <select id="semester-select" class="form-control">
            <option value="">Nothing Selected</option>
            @for ($i = 1; $i <= 8; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
</div>



                <div class="col-md-3" wire:key="filter-periode">
    <label class="form-label text-dark">Periode</label>
    <div class="dropdown bootstrap-select default-select w-100" wire:ignore>
        <select id="periode-select" class="form-control">
            <option value="">Nothing Selected</option>
            @foreach ($list_periode as $periode)
                <option value="{{ $periode->id }}">
                    {{ $periode->nama }}
                </option>
            @endforeach
        </select>
    </div>
</div>

{{-- FILTER --}}
<div class="row g-3 mb-2 align-items-end">

    <div class="col-md-9"></div>

    <div class="col-md-3 text-end">
        <button type="button"
                class="btn btn-outline-secondary btn-sm"
                wire:click="resetFilter">
            <i class="fa fa-refresh"></i> Reset Filter
        </button>
    </div>

</div>
            </div>

            {{-- TABLE --}}
            <div class="table-responsive mt-4">

                <div wire:loading wire:target="download">
                    <button class="btn btn-success btn-sm mb-2" disabled>
                        <span class="spinner-border spinner-border-sm"></span>
                        Proses download...
                    </button>

                  

                </div>

                <div wire:loading.remove wire:target="download">
                    <button class="btn btn-success btn-sm mb-2" wire:click="download">
                        Download
                    </button>
                </div>
                  <button
    class="btn btn-primary btn-sm"
    data-bs-toggle="modal"
    data-bs-target="#modalImportPresensi">
    <i class="fa fa-upload"></i> Import Excel
</button>

                <table class="table table-bordered">
                    <thead style="background:#FF4747;">
                        <tr>
                            <th class="text-white">NIM</th>
                            <th class="text-white">Nama Mahasiswa</th>
                            <th class="text-white">Jenis Kelamin</th>
                            <th class="text-white">Program Studi</th>
                            <th class="text-white">Jalur Beastudi</th>
                            <th class="text-white">Angkatan Masuk</th>
                            <th class="text-white">Semester</th>
                            <th class="text-white">Periode</th>
                            <th class="text-white">Status</th>
                            <th class="text-white text-center" width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-black">
                        @foreach ($monitorings as $monitoring)
                            <tr>
                                <td>{{ $monitoring->mahasiswa->nim }}</td>
                                <td>{{ $monitoring->mahasiswa->nama }}</td>
                                <td>{{ $monitoring->mahasiswa->jenis_kelamin }}</td>
                                <td>{{ ucwords($monitoring->mahasiswa->program_studi) }}</td>
                                <td>{{ ucwords($monitoring->mahasiswa->jalur_beastudi) }}</td>
                                <td>{{ $monitoring->mahasiswa->tahun_masuk }}</td>
                                <td>{{ $monitoring->semester ?? '-' }}</td>
                                <td>{{ $monitoring->periode->nama ?? '-' }}</td>
                                <td>{!! $monitoring->format_status_beastudi !!}</td>
             <td class="text-center">
                <button
    class="btn btn-sm btn-info mt-1"
    data-bs-toggle="modal"
    data-bs-target="#modalUbahStatus"
    wire:click="$emit('openUbahStatus', {{ $monitoring->id }})">
    <i class="fa fa-edit"></i> Status
</button>

                
    <button
        class="btn btn-sm btn-success"
        data-bs-toggle="modal"
        data-bs-target="#modalPresensi"
        wire:click="$emit('openPresensi', {{ $monitoring->id }})">
        <i class="fa fa-check"></i> Presensi
    </button>

   @if($monitoring->status_beastudi !== 'aman')
        <button
            class="btn btn-sm btn-warning mt-1"
            data-bs-toggle="modal"
            data-bs-target="#modalEvaluasi"
            wire:click="$emit('openEvaluasi', {{ $monitoring->id }})">
            <i class="fa fa-clipboard"></i> Evaluasi
        </button>
    @endif


</td>


                            </tr>
                        

                        @endforeach
                    </tbody>
                </table>
<div wire:ignore.self class="modal fade" id="modalPresensi" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <livewire:admin.presensi-mahasiswa
                :key="'presensi-modal'"
            />
        </div>
    </div>
</div>
<div wire:ignore.self class="modal fade" id="modalUbahStatus" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            @livewire('admin.ubah-status-beastudi')
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="modalImportPresensi" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            @livewire('admin.import-presensi')
        </div>
    </div>
</div>


<div wire:ignore.self class="modal fade" id="modalEvaluasi" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            @livewire('admin.evaluasi-mahasiswa')
        </div>
    </div>
</div>





                <div class="mt-4">
                    {{ $monitorings->links('vendor.livewire.bootstrap') }}
                </div>

            </div>
        </div>
    </div>
@push('script')
<script>
document.addEventListener('livewire:load', function () {

    $('#semester-select').selectpicker();
    $('#periode-select').selectpicker();

    // set awal dari Livewire
    $('#semester-select').selectpicker('val', @this.get('semester'));
    $('#periode-select').selectpicker('val', @this.get('periode'));

    $('#semester-select').on('changed.bs.select', function () {
        let val = $(this).val();
        @this.set('semester', val === "" ? null : String(val));
    });

    $('#periode-select').on('changed.bs.select', function () {
        let val = $(this).val();
        @this.set('periode', val === "" ? null : String(val));
    });

    // =========================
    // 🔥 RESET UI DARI LIVEWIRE
    // =========================
    window.addEventListener('reset-filter-ui', function () {

        // reset input biasa
        document.querySelectorAll('input[type="text"]').forEach(i => i.value = '');

        // reset selectpicker
        $('#semester-select').selectpicker('val', '');
        $('#periode-select').selectpicker('val', '');

    });

});
</script>
@endpush

@push('script')

<script>
window.addEventListener('download-excel', event => {
    window.location.href = event.detail.url;
});
</script>
@endpush
@push('script')
<script>
window.addEventListener('close-modal', () => {
    const modal = bootstrap.Modal.getInstance(
        document.getElementById('modalUbahStatus')
    );
    modal?.hide();
});
</script>
@endpush

@push('script')
<script>
window.addEventListener('import-success', function () {

    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: 'Import presensi selesai',
        timer: 1500,
        showConfirmButton: false
    });

    // 🔥 Tutup modal bootstrap
    const modal = bootstrap.Modal.getInstance(
        document.getElementById('modalImportPresensi')
    );

    if (modal) modal.hide();
});
</script>
@endpush


</div>
