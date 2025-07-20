<div>
    <div class="card">
        <div class="card-body">
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
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label text-dark">NIM</label>
                    <input type="text" class="form-control" wire:model.debounce.300='nim' autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label class="form-label text-dark">Nama Mahasiswa</label>
                    <input type="text" class="form-control" wire:model.debounce.300='nama' autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label class="form-label text-dark">Semester</label>
                    <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                        <select id="semester-select" class="default-select form-control wide" wire:model.debounce.300='semester'>
                            <option value>Nothing Selected</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                        <div class="dropdown-menu">
                            <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label text-dark">Periode</label>
                    <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                        <select id="periode-select" class="default-select form-control wide" wire:model.debounce.300='periode'>
                            <option value>Nothing Selected</option>
                            @foreach($list_periode as $periode)
                            <option value="{{ $periode->id }}">{{ $periode->nama }}</option>
                            @endforeach
                        </select>
                        <div class="dropdown-menu">
                            <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                            </div>
                        </div>
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
                        @foreach($mahasiswa as $mahasiswaItem)
                            @foreach($mahasiswaItem->monitorings as $monitoring)
                                <tr>
                                    <td>{{ $mahasiswaItem->nim }}</td>
                                    <td>{{ $mahasiswaItem->nama }}</td>
                                    <td>{{ $mahasiswaItem->jenis_kelamin }}</td>
                                    <td>{{ ucwords($mahasiswaItem->program_studi) }}</td>
                                    <td>{{ ucwords($mahasiswaItem->jalur_beastudi) }}</td>
                                    <td>{{ $mahasiswaItem->tahun_masuk }}</td>
                                    <td>{{ $monitoring->semester ?? '-' }}</td>
                                    <td>{{ $monitoring->periode->nama ?? '-' }}</td>
                                    <td>
                                        @isset($monitoring->status_beastudi)
                                            {!! $monitoring->format_status_beastudi !!}
                                        @else
                                            <span class="badge badge-secondary" style="padding:8px; font-size:12px;">Menunggu Update</span>
                                        @endisset
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $mahasiswa->links('vendor.livewire.bootstrap') }}
                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script>
        $('#semester-select').on('changed.bs.select', function () {
            var selectedSemester = $(this).val();
            @this.set('semester', selectedSemester);
        });

        $('#periode-select').on('changed.bs.select', function () {
            var selectedPeriode = $(this).val();
            @this.set('periode', selectedPeriode);
        });
    </script>
    @endpush
</div>
