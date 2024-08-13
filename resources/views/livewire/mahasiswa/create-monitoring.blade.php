<div>
    <form wire:submit.prevent="store" enctype="multipart/form-data">
        <div class="card">
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
                            <label class="form-label text-dark">Semester</label>
                            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                                <select id="bootstrap-select" class="default-select form-control wide" wire:model.debounce='semester'>
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
                                <div class="dropdown-menu ">
                                    <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
                            <span class="required">@error('semester') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label text-dark">Pembimbing Akademik</label>
                            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                                <select id="bootstrap-select" class="default-select form-control wide" wire:model.debounce='pembimbing_akademik_id'>
                                    <option value="">Pilih</option>
                                    @foreach($pembimbing_akademik as $pa)
                                        <option value="{{ $pa->id }}">{{ $pa->nama }}</option>
                                    @endforeach
                                </select>
                                <div class="dropdown-menu ">
                                    <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
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
                        <div class="mb-3">
                            <label class="form-label text-dark">Periode</label>
                            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                                <select id="bootstrap-select" class="default-select form-control wide" wire:model.debounce='periode_id'>
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
                            <span class="required">@error('periode_id') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label text-dark">Kontribusi Khusus</label>
                            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                                <select id="bootstrap-select" class="default-select form-control wide" wire:model.debounce='kontribusi_khusus_id'>
                                    <option value="">Pilih</option>
                                    @foreach($kontribusi_khusus as $kontribusi)
                                        <option value="{{ $kontribusi->id }}">{{ $kontribusi->nama }}</option>
                                    @endforeach
                                </select>
                                <div class="dropdown-menu ">
                                    <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
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
                <h5 class="mb-0">Unggah Bukti Dokumen (format .pdf)</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="file" class="form-label text-dark">Unggah dokumen keikutsertaan kegiatan</label>
                        <input class="form-control" type="file" id="file" wire:model='file_kegiatan'>
                        <div class="text-danger">@error('file_kegiatan') {{ $message }} @enderror</div>
                    </div>
                    <div class="col-md-4">
                        <label for="file" class="form-label text-dark">Unggah dokumen keikutsertaan internal kampus</label>
                        <input class="form-control" type="file" id="file" wire:model='file_internal_kampus'>
                        <div class="text-danger">@error('file_internal_kampus') {{ $message }} @enderror</div>
                    </div>
                    <div class="col-md-4">
                        <label for="file" class="form-label text-dark">Unggah dokumen prestasi</label>
                        <input class="form-control" type="file" id="file" wire:model='file_prestasi'>
                        <div class="text-danger">@error('file_prestasi') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <label for="file" class="form-label text-dark">Unggah dokumen SPB <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" id="file" wire:model='file_spb'>
                        <div class="text-danger">@error('file_spb') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>

            <div class="card-footer" style="border: none;">
                <div>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>

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
        </script>
    @endpush
</div>
