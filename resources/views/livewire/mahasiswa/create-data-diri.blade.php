<div>
    <form wire:submit.prevent="store" class="data-diri-form">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Data Diri</h5>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="nama" class="form-label text-dark">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama" autocomplete="off"
                                wire:model.debounce="nama" @disabled(!$isEditing)>
                            <span class="required">@error('nama') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="no_ktp" class="form-label text-dark">Nomor KTP Mahasiswa</label>
                            <input type="text" class="form-control" id="no_ktp" autocomplete="off"
                                wire:model.debounce="no_ktp" @disabled(!$isEditing)>
                            <span class="required">@error('no_ktp') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="tahun_masuk" class="form-label text-dark">Tahun Angkatan Masuk</label>
                            <input type="number" class="form-control" id="tahun_masuk" autocomplete="off"
                                wire:model.debounce="tahun_masuk" @disabled(!$isEditing)>
                            <span class="required">@error('tahun_masuk') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="rombel" class="form-label text-dark">Rombel</label>
                            <input type="text" class="form-control" id="rombel" autocomplete="off"
                                wire:model.debounce="rombel" placeholder="Masukkan rombel"
                                @disabled(!$isEditing)>
                            <span class="required">@error('rombel') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Jenis Kelamin</label>
                            <div wire:ignore>
                                <select id="jenis_kelamin"
                                    class="default-select form-control wide data-diri-select"
                                    data-model="jenis_kelamin" @disabled(!$isEditing)>
                                    <option value="">Nothing Selected</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                            <span class="required">@error('jenis_kelamin') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="no_kk" class="form-label text-dark">Nomor KK Mahasiswa</label>
                            <input type="text" class="form-control" id="no_kk" autocomplete="off"
                                wire:model.debounce="no_kk" @disabled(!$isEditing)>
                            <span class="required">@error('no_kk') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="tanggal_lahir" class="form-label text-dark">Tanggal dan Tahun Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" autocomplete="off"
                                wire:model.debounce="tanggal_lahir" @disabled(!$isEditing)>
                            <span class="required">@error('tanggal_lahir') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Agama</label>
                            <div wire:ignore>
                                <select id="agama"
                                    class="default-select form-control wide data-diri-select"
                                    data-model="agama_id" @disabled(!$isEditing)>
                                    <option value="">Nothing Selected</option>
                                    @foreach($list_agama as $agama)
                                        <option value="{{ $agama->id }}">{{ ucfirst($agama->nama) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="required">@error('agama_id') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Program Studi Pilihan</label>
                            <div wire:ignore>
                                <select id="prodi"
                                    class="default-select form-control wide data-diri-select"
                                    data-model="program_studi_id" @disabled(!$isEditing)>
                                    <option value="">Nothing Selected</option>
                                    @foreach($program_studi as $program)
                                        <option value="{{ $program->id }}">{{ ucwords($program->nama) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="required">@error('program_studi_id') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="pembimbing_akademik_id" class="form-label text-dark">
                                Pembimbing Akademik
                            </label>

                            <select id="pembimbing_akademik_id"
                                class="form-control"
                                wire:model="pembimbing_akademik_id"
                                @disabled(!$isEditing || !$program_studi_id)>
                                <option value="">Pilih Pembimbing Akademik</option>

                                @foreach($list_pembimbing_akademik as $pembimbing)
                                    <option value="{{ $pembimbing->id }}">
                                        {{ $pembimbing->nama }}
                                    </option>
                                @endforeach
                            </select>

                            @if(!$program_studi_id)
                                <small class="text-muted">
                                    Pilih Program Studi terlebih dahulu.
                                </small>
                            @elseif($list_pembimbing_akademik->isEmpty())
                                <small class="text-muted">
                                    Belum ada Pembimbing Akademik untuk Program Studi ini.
                                </small>
                            @endif

                            <span class="required">
                                @error('pembimbing_akademik_id') {{ $message }} @enderror
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-header">
                <h5 class="mb-0">Informasi Detail</h5>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Jalur Bestudi yang diambil</label>
                            <div wire:ignore>
                                <select id="jalur-prestasi"
                                    class="default-select form-control wide data-diri-select"
                                    data-model="jalur_prestasi_id" @disabled(!$isEditing)>
                                    <option value="">Nothing Selected</option>
                                    @foreach($list_prestasi as $prestasi)
                                        <option value="{{ $prestasi->id }}">{{ ucwords($prestasi->nama) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="required">@error('jalur_prestasi_id') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="nomor_hp" class="form-label text-dark">Nomor Handphone/WA</label>
                            <input type="number" class="form-control" id="nomor_hp" autocomplete="off"
                                wire:model.debounce="nomor_hp" @disabled(!$isEditing)>
                            <span class="required">@error('nomor_hp') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="nomor_hp_ortu" class="form-label text-dark">Nomor Handphone Orang Tua / Wali</label>
                            <input type="number" class="form-control" id="nomor_hp_ortu" autocomplete="off"
                                wire:model.debounce="nomor_hp_ortu" @disabled(!$isEditing)>
                            <span class="required">@error('nomor_hp_ortu') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Provinsi</label>
                            <div wire:ignore>
                                <select id="provinsi" class="default-select form-control wide"
                                    @disabled(!$isEditing)>
                                    <option value="">Nothing Selected</option>
                                    @foreach($list_provinsi as $provinsi)
                                        <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="required">@error('province_id') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Kabupaten / Kota</label>
                            <div wire:ignore>
                                <select id="kabupaten" class="default-select form-control wide"
                                    @disabled(!$isEditing)>
                                    <option value="">Nothing Selected</option>
                                    @foreach($list_kabupaten as $kabupaten)
                                        <option value="{{ $kabupaten->id }}">{{ $kabupaten->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="required">@error('regency_id') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Kecamatan</label>
                            <div wire:ignore>
                                <select id="kecamatan" class="default-select form-control wide"
                                    @disabled(!$isEditing)>
                                    <option value="">Nothing Selected</option>
                                    @foreach($list_kecamatan as $kecamatan)
                                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="required">@error('district_id') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Desa / Kelurahan</label>
                            <div wire:ignore>
                                <select id="kelurahan" class="default-select form-control wide"
                                    @disabled(!$isEditing)>
                                    <option value="">Nothing Selected</option>
                                    @foreach($list_kelurahan as $kelurahan)
                                        <option value="{{ $kelurahan->id }}">{{ $kelurahan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="required">@error('village_id') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="kode_pos" class="form-label text-dark">Kode POS</label>
                            <input type="number" class="form-control" id="kode_pos" autocomplete="off"
                                wire:model.debounce="kode_pos" @disabled(!$isEditing)>
                            <span class="required">@error('kode_pos') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="alamat" class="form-label text-dark">Alamat Domisili</label>
                            <textarea class="form-control" id="alamat" autocomplete="off"
                                wire:model.debounce="alamat" style="resize:none;"
                                @disabled(!$isEditing)></textarea>
                            <span class="required">@error('alamat') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer" style="border: none;">
                <div>
                    @if($isEditing)
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" wire:click="cancelEdit">
                            Batal
                        </button>
                    @else
                        <button type="button" class="btn btn-primary" wire:click="edit">
                            Edit
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </form>

    @push('script')
        <script>
            $(document).ready(function () {
                const selectIds = [
                    '#jenis_kelamin',
                    '#agama',
                    '#prodi',
                    '#jalur-prestasi',
                    '#provinsi',
                    '#kabupaten',
                    '#kecamatan',
                    '#kelurahan'
                ];

                selectIds.forEach(function (selector) {
                    $(selector).selectpicker();
                });

                // Hanya kirim perubahan jika data-model tersedia dan valid.
                $('.data-diri-select').on('change', function () {
                    const model = $(this).attr('data-model');

                    if (typeof model !== 'string' || model.trim() === '') {
                        console.warn('Select tidak memiliki data-model:', this);
                        return;
                    }

                    @this.set(model, $(this).val());
                });

                function refreshSelects() {
                    selectIds.forEach(function (selector) {
                        $(selector).selectpicker('refresh');
                    });
                }

                function setSelectValue(selector, value) {
                    $(selector).selectpicker('val', value || '');
                    $(selector).selectpicker('refresh');
                }

                function restoreRegionSelects() {
                    const provinceId = @this.get('province_id');
                    const regencyId = @this.get('regency_id');
                    const districtId = @this.get('district_id');
                    const villageId = @this.get('village_id');

                    setSelectValue('#provinsi', provinceId);

                    if (!provinceId) {
                        return;
                    }

                    $.ajax({
                        url: '/kabupaten',
                        data: { province_id: provinceId },
                        success: function (res) {
                            $('#kabupaten').empty()
                                .append('<option value="">Nothing Selected</option>');

                            $.each(res, function (id, value) {
                                $('#kabupaten').append(
                                    $('<option>', {
                                        value: value.id,
                                        text: value.name
                                    })
                                );
                            });

                            setSelectValue('#kabupaten', regencyId);

                            if (!regencyId) {
                                return;
                            }

                            $.ajax({
                                url: '/kecamatan',
                                data: { regency_id: regencyId },
                                success: function (res) {
                                    $('#kecamatan').empty()
                                        .append('<option value="">Nothing Selected</option>');

                                    $.each(res, function (id, value) {
                                        $('#kecamatan').append(
                                            $('<option>', {
                                                value: value.id,
                                                text: value.name
                                            })
                                        );
                                    });

                                    setSelectValue('#kecamatan', districtId);

                                    if (!districtId) {
                                        return;
                                    }

                                    $.ajax({
                                        url: '/kelurahan',
                                        data: { district_id: districtId },
                                        success: function (res) {
                                            $('#kelurahan').empty()
                                                .append('<option value="">Nothing Selected</option>');

                                            $.each(res, function (id, value) {
                                                $('#kelurahan').append(
                                                    $('<option>', {
                                                        value: value.id,
                                                        text: value.name
                                                    })
                                                );
                                            });

                                            setSelectValue('#kelurahan', villageId);
                                        }
                                    });
                                }
                            });
                        }
                    });
                }

                window.addEventListener('data-diri-mode-changed', function (event) {
                    const editing = event.detail.editing;

                    $('.data-diri-form input, .data-diri-form textarea')
                        .prop('disabled', !editing);

                    $('#pembimbing_akademik_id')
                        .prop('disabled', !editing || !@this.get('program_studi_id'));

                    selectIds.forEach(function (selector) {
                        $(selector).prop('disabled', !editing);
                    });

                    refreshSelects();

                    if (!editing) {
                        setSelectValue('#jenis_kelamin', @this.get('jenis_kelamin'));
                        setSelectValue('#agama', @this.get('agama_id'));
                        setSelectValue('#prodi', @this.get('program_studi_id'));
                        setSelectValue('#jalur-prestasi', @this.get('jalur_prestasi_id'));

                        restoreRegionSelects();
                    }
                });

                setSelectValue('#jenis_kelamin', @this.get('jenis_kelamin'));
                setSelectValue('#agama', @this.get('agama_id'));
                setSelectValue('#prodi', @this.get('program_studi_id'));
                setSelectValue('#jalur-prestasi', @this.get('jalur_prestasi_id'));

                setSelectValue('#provinsi', @this.get('province_id'));
                setSelectValue('#kabupaten', @this.get('regency_id'));
                setSelectValue('#kecamatan', @this.get('district_id'));
                setSelectValue('#kelurahan', @this.get('village_id'));

                selectIds.forEach(function (selector) {
                    $(selector).prop('disabled', !@this.get('isEditing'));
                });

                refreshSelects();

                $('#provinsi').on('change', function (e) {
                    const provinsiId = e.target.value;

                    $('#kabupaten').empty()
                        .append('<option value="">Nothing Selected</option>');
                    $('#kecamatan').empty()
                        .append('<option value="">Nothing Selected</option>');
                    $('#kelurahan').empty()
                        .append('<option value="">Nothing Selected</option>');

                    refreshSelects();

                    $.ajax({
                        url: '/kabupaten',
                        data: { province_id: provinsiId },
                        success: function (res) {
                            $.each(res, function (id, value) {
                                $('#kabupaten').append(
                                    $('<option>', {
                                        value: value.id,
                                        text: value.name
                                    })
                                );
                            });

                            refreshSelects();
                        }
                    });

                    Livewire.emit('provinsiChanged', provinsiId);
                });

                $('#kabupaten').on('change', function (e) {
                    const regencyId = e.target.value;

                    $('#kecamatan').empty()
                        .append('<option value="">Nothing Selected</option>');
                    $('#kelurahan').empty()
                        .append('<option value="">Nothing Selected</option>');

                    refreshSelects();

                    $.ajax({
                        url: '/kecamatan',
                        data: { regency_id: regencyId },
                        success: function (res) {
                            $.each(res, function (id, value) {
                                $('#kecamatan').append(
                                    $('<option>', {
                                        value: value.id,
                                        text: value.name
                                    })
                                );
                            });

                            refreshSelects();
                        }
                    });

                    Livewire.emit('regencyChanged', regencyId);
                });

                $('#kecamatan').on('change', function (e) {
                    const districtId = e.target.value;

                    $('#kelurahan').empty()
                        .append('<option value="">Nothing Selected</option>');

                    refreshSelects();

                    $.ajax({
                        url: '/kelurahan',
                        data: { district_id: districtId },
                        success: function (res) {
                            $.each(res, function (id, value) {
                                $('#kelurahan').append(
                                    $('<option>', {
                                        value: value.id,
                                        text: value.name
                                    })
                                );
                            });

                            refreshSelects();
                        }
                    });

                    Livewire.emit('districtChanged', districtId);
                });

                $('#kelurahan').on('change', function (e) {
                    Livewire.emit('villageChanged', e.target.value);
                });
            });
        </script>
    @endpush
</div>