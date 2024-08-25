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
                                <select id="semester-select" class="default-select form-control wide" wire:model.debounce.300='semester_select'>
                                    <option value="">Pilih</option>
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
                                <select id="periode-select" class="default-select form-control wide" wire:model.debounce.300='periode_select'>
                                    <option value="">Pilih</option>
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

                @if (is_string($monitoring))
                    <div>
                        <p>{{ $monitoring }}</p>
                    </div>
                @elseif ($monitoring)
                    <div>
                        @include('partials.modal-update-status-monitoring')
                    </div>

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
                                    <div class="mb-3" wire:ignore>
                                        <label class="form-label text-dark">Semester</label>
                                        <select id="semester" class="form-control" wire:model.debounce='semester'>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                        <span class="required">@error('semester') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3" wire:ignore>
                                        <label class="form-label text-dark">Pembimbing Akademik</label>
                                        <select id="pembimbing_akademik" class="default-select form-control wide" wire:model.debounce='pembimbing_akademik_id'>
                                            @foreach($pembimbing_akademik as $pa)
                                            <option value="{{ $pa->id }}">{{ $pa->nama }}</option>
                                            @endforeach
                                        </select>
                                        <span class="required">@error('pembimbing_akademik_id') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="ipk" class="form-label text-dark">
                                            IPK
                                        </label>
                                        <input type="text" class="form-control" id="ipk" autocomplete="off" wire:model.debounce='ipk' oninput="validateNumberInput(event)" maxlength="4">
                                        <span class="required">@error('ipk') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3" wire:ignore>
                                        <label class="form-label text-dark">Periode</label>
                                        <select id="periode" class="default-select form-control wide" wire:model.debounce='periode_id'>
                                            @foreach($list_periode as $periode)
                                            <option value="{{ $periode->id }}">{{ $periode->nama }}</option>
                                            @endforeach
                                        </select>
                                        <span class="required">@error('periode_id') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3" wire:ignore>
                                        <label class="form-label text-dark">Kontribusi Khusus</label>
                                        <select id="kontribusi_khusus" class="default-select form-control wide" wire:model.debounce='kontribusi_khusus_id'>
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
                            <div class="row">
                                @if($file_kegiatan)
                                    <div class="d-flex justify-content-between" style="padding-right:30%;">
                                        <p>Dokumen Keikutsertaan Kegiatan</p>
                                        <p><a href="{{ asset('storage/monitoring/file-kegiatan/' . $file_kegiatan) }}" target="__blank" class="text-dark">Lihat File</a></p>
                                    </div>
                                @endif
                                @if($file_internal_kampus)
                                    <div class="d-flex justify-content-between" style="padding-right:30%;">
                                        <p>Dokumen Keikutsertaan Internal Kampus</p>
                                        <p><a href="{{ asset('storage/monitoring/file-internal-kampus/' . $file_internal_kampus) }}" target="__blank" class="text-dark">Lihat File</a></p>
                                    </div>
                                @endif
                                @if($file_prestasi)
                                    <div class="d-flex justify-content-between" style="padding-right:30%;">
                                        <p>Dokumen Prestasi</p>
                                        <p><a href="{{ asset('storage/monitoring/file-prestasi/' . $file_prestasi) }}" target="__blank" class="text-dark">Lihat File</a></p>
                                    </div>
                                @endif
                                <div class="d-flex justify-content-between" style="padding-right:30%;">
                                    <p>Dokumen LPJ</p>
                                    <p><a href="{{ asset('storage/monitoring/file-lpj/' . $file_lpj) }}" target="__blank" class="text-dark">Lihat File</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer" style="border: none;">
                            <div>
                                <button type="submit" class="btn btn-primary">Edit Data</button>
                                <button type="button" class="btn btn-primary" wire:click='updateStatus("{{ $mahasiswa->nim }}", "{{ $semester  }}", "{{ $periode_id }}")'>
                                    Update Status
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    @push('script')
        <script>
            function initSelectPicker() {
                $('#semester').selectpicker();
                $('#pembimbing_akademik').selectpicker();
                $('#periode').selectpicker();
                $('#kontribusi_khusus').selectpicker();

                $('#semester-select, #periode-select').selectpicker('destroy').selectpicker();

                $('#semester-select').on('changed.bs.select', function () {
                    var selectedSemester = $(this).val();
                    @this.set('semester_select', selectedSemester);
                });

                $('#periode-select').on('changed.bs.select', function () {
                    var selectedPeriode = $(this).val();
                    @this.set('periode_select', selectedPeriode);
                });
            }

            document.addEventListener('livewire:load', function () {
                initSelectPicker();
            });

            document.addEventListener('livewire:update', function () {
                initSelectPicker();
            });

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

            Livewire.on('showUpdateStatusMonitoringModal', (nim, semester, periodeId) => {
                $('#updateStatusMonitoringModal').modal('show')

                Livewire.emit('setMonitoring', nim, semester, periodeId)
            })

            Livewire.on('closeUpdateStatusMonitoringModal', () => {
                $('#updateStatusMonitoringModal').modal('hide')
            })
        </script>
    @endpush
</div>
