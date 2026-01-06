<div>
    <div class="card">
        <div class="card-body">
            {{-- PENGATURAN PENGUMPULAN --}}
<div class="mb-3">
    @livewire('admin.pengaturan-monitoring')
</div>

            <div class="mb-3">
                <div class="d-flex justify-content-center">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ $status_beastudi === 'evaluasi' ? 'active' : '' }}" wire:click.prevent="$set('status_beastudi', 'evaluasi')">
                                <i class="fa fa-exclamation-circle text-warning"></i> Evaluasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ $status_beastudi === 'aman' ? 'active' : '' }}" wire:click.prevent="$set('status_beastudi', 'aman')">
                                <i class="fa fa-check-circle text-success"></i> Aman
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ $status_beastudi === 'keluar' ? 'active' : '' }}" wire:click.prevent="$set('status_beastudi', 'keluar')">
                                <i class="fa fa-times-circle text-danger"></i> Keluar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

  <div class="row mb-2">
                <div class="col-12 d-flex justify-content-end">
                    <button id="btn-back"
                            type="button"
                            class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-refresh"></i> Reset Filter
                    </button>
                </div>
            </div>

    
         
    <div class="row g-3">

    <!-- NIM -->
    <div class="col-md-3">
        <label class="form-label text-dark">NIM</label>
        <input type="text"
               class="form-control"
               wire:model.debounce.300="nim"
               autocomplete="off">
    </div>

    <!-- Nama Mahasiswa -->
    <div class="col-md-3">
        <label class="form-label text-dark">Nama Mahasiswa</label>
        <input type="text"
               class="form-control"
               wire:model.debounce.300="nama"
               autocomplete="off">
    </div>

    <!-- Semester -->
    <div class="col-md-3">
        <label class="form-label text-dark">Semester</label>
        <div class="dropdown bootstrap-select default-select w-100" wire:ignore>
            <select id="semester-select"
                    class="form-control"
                    wire:model.debounce.300="semester">
                <option value="">Nothing Selected</option>
                @for ($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>

    <!-- Periode -->
    <div class="col-md-3">
        <label class="form-label text-dark">Periode</label>
        <div class="dropdown bootstrap-select default-select w-100" wire:ignore>
            <select id="periode-select"
                    class="form-control"
                    wire:model.debounce.300="periode">
                <option value="">Nothing Selected</option>
                @foreach ($list_periode as $periode)
                    <option value="{{ $periode->id }}">
                        {{ $periode->nama }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    </div>
            <div class="table-responsive mt-4">
                <div wire:loading wire:target="download">
                    <button class="btn btn-success btn-block btn-sm mb-1" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Proses download...
                    </button>
                </div>

                <div wire:loading.remove wire:target="download">
                    <button class="btn btn-success btn-block btn-sm mb-1" wire:click="download">
                        Download
                    </button>
                </div>

                <table class="table table-bordered">
                    <thead style="background:#FF4747;">
                        <tr>
                            <th style="color:white !important;">NIM</th>
                            <th style="color:white !important;">Nama Mahasiswa</th>
                            <th style="color:white !important;">Jenis Kelamin</th>
                            <th style="color:white !important;">Program Studi</th>
                            <th style="color:white !important;">Jalur Beastudi</th>
                            <th style="color:white !important;">Angkatan Masuk</th>
                            <th style="color:white !important;">Semester</th>
                            <th style="color:white !important;">Periode</th>
                            <th style="color:white !important;">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-black">
                        @foreach($monitorings as $monitoring)
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $monitorings->links('vendor.livewire.bootstrap') }}
                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // SIMPAN URL AWAL SEKALI SAJA
            if (!sessionStorage.getItem('monitoring_back_url')) {
                sessionStorage.setItem('monitoring_back_url', window.location.href);
            }

            // TOMBOL BACK
            document.getElementById('btn-back').addEventListener('click', function () {
                let backUrl = sessionStorage.getItem('monitoring_back_url');
                if (backUrl) {
                    window.location.href = backUrl;
                } else {
                    window.history.back();
                }
            });

            // SELECT SEMESTER
            $('#semester-select').on('changed.bs.select', function () {
                @this.set('semester', $(this).val());
            });

            // SELECT PERIODE
            $('#periode-select').on('changed.bs.select', function () {
                @this.set('periode', $(this).val());
            });

        });
    </script>
    @endpush
</div>
