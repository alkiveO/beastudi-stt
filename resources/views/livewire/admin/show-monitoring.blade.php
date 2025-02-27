<div>
    @section('title_dashboard', 'Detail Monitoring: ' .$mahasiswa->nama)

    <div class="container-fluid">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label text-dark">Semester</label>
                            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                                <select id="semester-select" class="default-select form-control wide" wire:model.debounce.300='semester'>
                                    <option hidden>Nothing Selected</option>
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
                                <select id="periode-select" class="default-select form-control wide" wire:model.debounce.300='periode_id'>
                                    <option hidden>Nothing Selected</option>
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
                </div>

                <div>
                    @include('partials.modal-update-status-monitoring')
                </div>

                @if($semester && $periode_id)
                    <form wire:submit.prevent='update'>
                        <div class="card-header">
                            <h5 class="mb-0">Data Diri</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="tanggal_isi" class="form-label text-dark">
                                            Tanggal Isi
                                        </label>
                                        <input type="date" class="form-control" id="tanggal_isi" autocomplete="off" wire:model.debounce='tanggal_isi'>
                                        <span class="required">@error('tanggal_isi') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="nim" class="form-label text-dark">
                                            NIM
                                        </label>
                                        <input type="number" class="form-control" id="nim" autocomplete="off" wire:model.debounce='nim' disabled>
                                        <span class="required">@error('nim') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="ips" class="form-label text-dark">
                                            IPS
                                        </label>
                                        <input type="text" class="form-control" id="ips" autocomplete="off" wire:model.debounce='ips' oninput="validateNumberInput(event)" maxlength="4">
                                        <span class="required">@error('ips') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="ipk" class="form-label text-dark">
                                            IPK
                                        </label>
                                        <input type="text" class="form-control" id="ipk" autocomplete="off" wire:model.debounce='ipk' oninput="validateNumberInput(event)" maxlength="4">
                                        <span class="required">@error('ipk') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3" wire:ignore>
                                        <label class="form-label text-dark">Pembimbing Akademik</label>
                                        <select id="bootstrap-select" class="default-select pa-select form-control wide" wire:model.debounce='pembimbing_akademik_id'>
                                            <option hidden>Nothing Selected</option>
                                            @foreach($pembimbing_akademik as $pa)
                                            <option value="{{ $pa->id }}">{{ $pa->nama }}</option>
                                            @endforeach
                                        </select>
                                        <span class="required">@error('pembimbing_akademik_id') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3" wire:ignore>
                                        <label class="form-label text-dark">Kontribusi Khusus</label>
                                        <select id="bootstrap-select" class="default-select kontribusi-select form-control wide" wire:model.debounce='kontribusi_khusus_id'>
                                            <option hidden>Nothing Selected</option>
                                            @foreach($kontribusi_khusus as $kontribusi)
                                            <option value="{{ $kontribusi->id }}">{{ $kontribusi->nama }}</option>
                                            @endforeach
                                        </select>
                                        <span class="required">@error('kontribusi_khusus_id') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-header">
                            <h5 class="mb-0">Evaluasi dan Rencana</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="deskripsi_capaian" class="form-label text-dark">
                                            Capaian Semester
                                        </label>
                                        <textarea class="form-control monitoring" id="deskripsi_capaian" autocomplete="off" wire:model.debounce='deskripsi_capaian' style="resize:none;" maxLength='500' placeholder="Ceritakan capaianmu di semester ini maks. 500 kata"></textarea>
                                        <span class="required">@error('deskripsi_capaian') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="deskripsi_kendala" class="form-label text-dark">
                                            Kendala Semester
                                        </label>
                                        <textarea class="form-control monitoring" id="deskripsi_kendala" autocomplete="off" wire:model.debounce='deskripsi_kendala' style="resize:none;" maxLength='500' placeholder="Ceritakan kendalamu di semester ini maks. 500 kata"></textarea>
                                        <span class="required">@error('deskripsi_kendala') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="deskripsi_rencana" class="form-label text-dark">
                                            Rencana Semester Selanjutnya
                                        </label>
                                        <textarea class="form-control monitoring" id="deskripsi_rencana" autocomplete="off" wire:model.debounce='deskripsi_rencana' style="resize:none;" maxLength='500' placeholder="Ceritakan rencanamu di semester depan maks. 500 kata"></textarea>
                                        <span class="required">@error('deskripsi_rencana') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-header">
                            <h5 class="mb-0">Bukti Dokumen</h5>
                        </div>
                        <div class="card-body">
                            <!-- prestasi -->
                            <div class="row">
                                <div class="col-md-5">
                                    <h5>Kegiatan lomba atau prestasi</h5>
                                    @forelse($prestasi as $item)
                                    <div class="d-flex justify-content-between">
                                        <p class="text-dark">{{ $loop->iteration }}. {{ $item->nama }}</p>
                                        <p class="text-dark">Kategori: {{ $item->kategori_prestasi->nama }}</p>
                                        <p><a href="{{ Storage::url($item->file) }}" target="_blank" class="text-dark">Lihat Dokumen</a></p>
                                    </div>
                                    @empty
                                        <p>Belum ada prestasi yang ditambahkan.</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- spb -->
                            <div class="row mt-3">
                                <div class="col-md-7">
                                    <h5>Dokumen SPK</h5>

                                    @if($file_spb)
                                        <div class="d-flex justify-content-between" style="padding-right:30%;">
                                            <p class="text-dark">{{ $file_spb }}</p>
                                            <p><a href="{{ asset('storage/monitoring/file-spb/' . $file_spb) }}" target="__blank" class="text-dark">Lihat Dokumen</a></p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-footer" style="border: none;">
                            <div>
                                <button type="submit" class="btn btn-primary">Edit Data</button>
                                @if($monitoring)
                                <button type="button" class="btn btn-primary" wire:click='updateStatus("{{ $mahasiswa->nim }}", "{{ $semester  }}", "{{ $periode_id }}")'>
                                    Update Status
                                </button>
                                @endif
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    @push('script')
        <script>
            function validateNumberInput(event) {
                const input = event.target;

                let value = input.value;

                value = value.replace(/[^0-9.]/g, '');

                if (value.length > 4) {
                    value = value.slice(0, 2);
                }
                if (value.length === 2 && !value.endsWith('.')) {
                    value = value.charAt(0) + '.';
                }
                if (value.length === 1 && !value.match(/^\d$/)) {
                    value = '';
                }

                input.value = value;
            }

            function initSelectPicker() {
                $('#bootstrap-select').selectpicker();

                let selects = document.querySelectorAll('#bootstrap-select');
                selects.forEach(select => {
                    $(select).selectpicker();
                });
            }

            document.addEventListener('livewire:load', function () {
                initSelectPicker();
            });

            document.addEventListener('livewire:update', function () {
                initSelectPicker();
            });

            $('#semester-select').on('changed.bs.select', function () {
                var selectedSemester = $(this).val();
                @this.set('semester_select', selectedSemester);
            });

            $('#periode-select').on('changed.bs.select', function () {
                var selectedPeriode = $(this).val();
                @this.set('periode_select', selectedPeriode);
            });

            Livewire.on('clearSelect', () => {
                $('.kontribusi-select, .pa-select')
                    .selectpicker('destroy')
                    .selectpicker();
            })

            Livewire.on('kontribusiSelect', (value) => {
                $('.kontribusi-select').val(value);
                $('.kontribusi-select').selectpicker('refresh');
            })

            Livewire.on('paSelect', (value) => {
                $('.pa-select').val(value);
                $('.pa-select').selectpicker('refresh');
            })

            Livewire.on('showUpdateStatusMonitoringModal', (nim, semester, periode_id) => {
                $('#updateStatusMonitoringModal').modal('show');

                Livewire.emitTo('admin.update-status-monitoring', 'setMonitoring', nim, semester, periode_id);
            })

            Livewire.on('closeUpdateStatusMonitoringModal', () => {
                $('#updateStatusMonitoringModal').modal('hide');
            })
        </script>
    @endpush
</div>
