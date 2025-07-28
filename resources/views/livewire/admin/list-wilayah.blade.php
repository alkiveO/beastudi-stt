<div>
    @section('title', 'Wilayah')
    @section('title_dashboard', 'Wilayah')

    <div class="container-fluid">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-md-4 mb-3" wire:ignore>
                    <label>Provinsi</label>
                    <select id="province-select" class="form-control" data-live-search="true">
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach($provinces as $prov)
                            <option value="{{ $prov->id }}" @if($province_id == $prov->id) selected @endif>{{ $prov->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Kabupaten/Kota</label>
                    <select id="regency-select" class="form-control">
                        <option value="">-- Pilih Kabupaten --</option>
                        @foreach($regencies as $reg)
                            <option value="{{ $reg->id }}" @if($regency_id == $reg->id) selected @endif>{{ $reg->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Kecamatan</label>
                    <select id="district-select" class="form-control">
                        <option value="">-- Pilih Kecamatan --</option>
                        @foreach($districts as $dist)
                            <option value="{{ $dist->id }}" @if($district_id == $dist->id) selected @endif>{{ $dist->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @if($villages->count())
                            <table class="table table-bordered">
                                <thead style="background:#FF4747;">
                                    <tr>
                                        <th style="color:white !important;">ID</th>
                                        <th style="color:white !important;">Nama Desa/Kelurahan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($villages as $village)
                                        <tr>
                                            <td>{{ $village->id }}</td>
                                            <td>{{ $village->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="p-1">
                                <button class="btn btn-primary btn-block btn-sm" data-bs-toggle="modal" data-bs-target="#addWilayah">
                                    Tambah Wilayah
                                </button>
                            </div>
                        @else
                            <p class="text-center mt-4">Data desa/kelurahan tidak ditemukan atau belum dipilih.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="addWilayah" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addWilayahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="store">
                    <div class="modal-header">
                    <h5 class="modal-title" id="addWilayahLabel">Tambah Wilayah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="id" class="form-label">ID</label>
                            <input type="text" id="id" class="form-control" wire:model.lazy="village_id" autocomplete="off">
                            @error('village_id') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Desa/Kelurahan</label>
                            <input type="text" id="name" class="form-control text-uppercase" wire:model.lazy="village_name" autocomplete="off">
                            @error('village_name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
    <script>
        function initSelectPicker() {
            $('#province-select').selectpicker();
            $('#regency-select').selectpicker();
            $('#district-select').selectpicker();
        }

        document.addEventListener('livewire:load', function () {
            initSelectPicker();

            $('#province-select').on('changed.bs.select', function () {
                @this.set('province_id', $(this).val());
            });

            $('#regency-select').on('changed.bs.select', function () {
                @this.set('regency_id', $(this).val());
            });

            $('#district-select').on('changed.bs.select', function () {
                @this.set('district_id', $(this).val());
            });

            Livewire.hook('message.processed', (message, component) => {
                initSelectPicker(); // 🔁 Re-init setelah update
            });

            Livewire.on('closeModalWilayah', () => {
                $('#addWilayah').modal('hide')
            })
        });
    </script>
    @endpush
</div>
