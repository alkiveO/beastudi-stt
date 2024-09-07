<div>
    <form wire:submit.prevent="store">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Data Diri</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="nama" class="form-label text-dark">
                                Nama Mahasiswa
                            </label>
                            <input type="text" class="form-control" id="nama" autocomplete="off" wire:model.debounce='nama'>
                            <span class="required">@error('nama') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="no_ktp" class="form-label text-dark">
                                Nomor KTP Mahasiswa
                            </label>
                            <input type="text" class="form-control" id="no_ktp" autocomplete="off" wire:model.debounce='no_ktp'>
                            <span class="required">@error('no_ktp') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="angkatan" class="form-label text-dark">Tahun Angkatan Masuk</label>
                            <input type="number" class="form-control" id="tahun_masuk" autocomplete="off" wire:model.debounce='tahun_masuk'>
                            <span class="required">@error('tahun_masuk') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Jenis Kelamin</label>
                            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                                <select id="jenis_kelamin" class="default-select form-control wide" wire:model.debounce='jenis_kelamin'>
                                    <option hidden>Nothing Selected</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                                <div class="dropdown-menu">
                                    <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
                            <span class="required">@error('jenis_kelamin') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="no_kk" class="form-label text-dark">
                                Nomor KK Mahasiswa
                            </label>
                            <input type="text" class="form-control" id="no_kk" autocomplete="off" wire:model.debounce='no_kk'>
                            <span class="required">@error('no_kk') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="nim" class="form-label text-dark">
                                Nomor Induk Mahasiswa
                            </label>
                            <input type="number" class="form-control" id="nim" autocomplete="off" wire:model.debounce='nim'>
                            <span class="required">@error('nim') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="tanggal_lahir" class="form-label text-dark">
                                Tanggal dan Tahun Lahir
                            </label>
                            <input type="date" class="form-control" id="tanggal_lahir" autocomplete="off" wire:model.debounce='tanggal_lahir'>
                            <span class="required">@error('tanggal_lahir') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Agama</label>
                            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                                <select id="agama" class="default-select form-control wide" wire:model.debounce='agama_id'>
                                    <option hidden>Nothing Selected</option>
                                    @foreach($list_agama as $agama)
                                        <option value="{{ $agama->id }}">{{ ucfirst($agama->nama) }}</option>
                                    @endforeach
                                </select>
                                <div class="dropdown-menu">
                                    <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
                            <span class="required">@error('agama_id') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Program Studi Pilihan</label>
                            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                                <select id="prodi" class="default-select form-control wide" wire:model.debounce='program_studi_id'>
                                    <option hidden>Nothing Selected</option>
                                    @foreach($program_studi as $program)
                                    <option value="{{ $program->id }}">{{ ucwords($program->nama) }}</option>
                                    @endforeach
                                </select>
                                <div class="dropdown-menu ">
                                    <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
                            <span class="required">@error('program_studi_id') {{ $message }} @enderror</span>
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
                            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                                <select id="jalur-prestasi" class="default-select form-control wide" wire:model.debounce='jalur_prestasi_id'>
                                    <option hidden>Nothing Selected</option>
                                    @foreach($list_prestasi as $prestasi)
                                    <option value="{{ $prestasi->id }}">{{ ucwords($prestasi->nama) }}</option>
                                    @endforeach
                                </select>
                                <div class="dropdown-menu ">
                                    <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
                            <span class="required">@error('jalur_prestasi_id') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="nomor_hp" class="form-label text-dark">Nomor Handhone</label>
                            <input type="number" class="form-control" id="nomor_hp" autocomplete="off" wire:model.debounce='nomor_hp'>
                            <span class="required">@error('nomor_hp') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="nomor_hp_ortu" class="form-label text-dark">Nomor Handhone Orang Tua / Wali</label>
                            <input type="number" class="form-control" id="nomor_hp_ortu" autocomplete="off" wire:model.debounce='nomor_hp_ortu'>
                            <span class="required">@error('nomor_hp_ortu') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Provinsi</label>
                            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                                <select id="provinsi" class="default-select form-control wide" wire:model.debounce='province_id'>
                                    <option hidden>Nothing Selected</option>
                                    @foreach($list_provinsi as $provinsi)
                                    <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                    @endforeach
                                </select>
                                <div class="dropdown-menu ">
                                    <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
                            <span class="required">@error('province_id') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Kabupaten / Kota</label>
                            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                                <select id="kabupaten" class="default-select form-control wide" wire:model.debounce='regency_id'>
                                    <option hidden>Nothing Selected</option>
                                    @foreach($list_kabupaten as $kabupaten)
                                    <option value="{{ $kabupaten->id }}">{{ $kabupaten->name }}</option>
                                    @endforeach
                                </select>
                                <div class="dropdown-menu ">
                                    <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
                            <span class="required">@error('regency_id') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Kecamatan</label>
                            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                                <select id="kecamatan" class="default-select form-control wide" wire:model.debounce='district_id'>
                                    <option hidden>Nothing Selected</option>
                                    @foreach($list_kecamatan as $kecamatan)
                                    <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                                    @endforeach
                                </select>
                                <div class="dropdown-menu ">
                                    <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
                            <span class="required">@error('district_id') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Desa / Kelurahan</label>
                            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                                <select id="kelurahan" class="default-select form-control wide" wire:model.debounce='village_id'>
                                    <option hidden>Nothing Selected</option>
                                    @foreach($list_kelurahan as $kelurahan)
                                    <option value="{{ $kelurahan->id }}">{{ $kelurahan->name }}</option>
                                    @endforeach
                                </select>
                                <div class="dropdown-menu ">
                                    <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
                            <span class="required">@error('village_id') {{ $message }} @enderror</span>
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="kode_pos" class="form-label text-dark">
                                Kode POS
                            </label>
                            <input type="number" class="form-control" id="kode_pos" autocomplete="off" wire:model.debounce='kode_pos'>
                            <span class="required">@error('kode_pos') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label for="alamat" class="form-label text-dark">
                                Alamat Domisili
                            </label>
                            <textarea class="form-control" id="alamat" autocomplete="off" wire:model.debounce='alamat' style="resize:none;"></textarea>
                            <span class="required">@error('alamat') {{ $message }} @enderror</span>
                        </div>
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
            $('#provinsi').on('change', function(e) {
                const provinsiId = e.target.value

                $('#kabupaten').empty();
                $('#kabupaten').selectpicker('refresh');

                $('#kecamatan').empty();
                $('#kecamatan').selectpicker('refresh');

                $('#kelurahan').empty();
                $('#kelurahan').selectpicker('refresh');

                $.ajax({
                    url: '/kabupaten',
                    data: {province_id: provinsiId},
                    success: function(res){
                        $('#kabupaten').append('<option hidden>Nothing Selected</option>');
                        $.each(res, function(id, value) {
                            $('#kabupaten').append(
                                `
                                    <option value=${value.id}>${value.name}</option>
                                `
                            )
                        })
                        $('#kabupaten').selectpicker('refresh');
                    }
                })

                Livewire.emit('provinsiChanged');
            })

            $('#kabupaten').on('change', function(e) {
                const regencyId = e.target.value

                $('#kecamatan').empty();
                $('#kecamatan').selectpicker('refresh');

                $('#kelurahan').empty();
                $('#kelurahan').selectpicker('refresh');

                $.ajax({
                    url: '/kecamatan',
                    data: {regency_id: regencyId},
                    success: function(res){
                        $('#kecamatan').append('<option hidden>Nothing Selected</option>');
                        $.each(res, function(id, value) {
                            $('#kecamatan').append(
                                `
                                    <option value=${value.id}>${value.name}</option>
                                `
                            )
                        })
                        $('#kecamatan').selectpicker('refresh');
                    }
                })

                Livewire.emit('regencyChanged');
            })

            $('#kecamatan').on('change', function(e) {
                const districtId = e.target.value

                $('#kelurahan').empty();
                $('#kelurahan').selectpicker('refresh');

                $.ajax({
                    url: '/kelurahan',
                    data: {district_id: districtId},
                    success: function(res){
                        $('#kelurahan').append('<option hidden>Nothing Selected</option>');
                        $.each(res, function(id, value) {
                            $('#kelurahan').append(
                                `
                                    <option value=${value.id}>${value.name}</option>
                                `
                            )
                        })
                        $('#kelurahan').selectpicker('refresh');
                    }
                })

                Livewire.emit('districtChanged');
            })
        </script>
    @endpush
</div>
