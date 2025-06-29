<div>
    <form wire:submit.prevent='update'>
        <div class="card-body">
            <div class="form-group mb-2">
                <label for="nim" class="form-label text-dark">
                   NIM
                </label>
                <input type="text" class="form-control" id="nim" autocomplete="off" wire:model.blur='nim'>
                <div class="text-danger">@error('nim') {{ $message }} @enderror</div>
            </div>
            {{-- <div class="form-group mb-2">
                <label for="nama_mhs" class="form-label text-dark">
                   Nama Mahasiswa
                </label>
                <input type="text" class="form-control" id="nama_mhs" autocomplete="off" wire:model.blur='nama_mhs'>
                <div class="text-danger">@error('nama_mhs') {{ $message }} @enderror</div>
            </div> --}}
            <div class="form-group mb-2">
                <label class="form-label text-dark">Semester</label>
                <div wire:ignore>
                    <select id="semester-select" class="default-select form-control wide">
                        <option hidden>Nothing Selected</option>
                        @foreach($semester_arr as $semesterItem)
                            <option value="{{ $semesterItem }}">{{ $semesterItem }}</option>
                        @endforeach
                    </select>
                    <div class="dropdown-menu">
                        <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                            <ul class="dropdown-menu inner show" role="presentation"></ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mb-2">
                <label class="form-label text-dark">Periode</label>
                <div wire:ignore>
                    <select id="periode-select" class="default-select form-control wide" wire:model.blur='periode'>
                        <option hidden>Nothing Selected</option>
                        @foreach($list_periode as $periodeItem)
                            <option value="{{ $periodeItem->id }}">{{ $periodeItem->nama }}</option>
                        @endforeach
                    </select>
                    <div class="dropdown-menu">
                        <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                            <ul class="dropdown-menu inner show" role="presentation"></ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mb-2">
                <label for="nama" class="form-label text-dark">
                   Nama Lomba
                </label>
                <input type="text" class="form-control" id="nama" autocomplete="off" wire:model.blur='nama'>
                <div class="text-danger">@error('nama') {{ $message }} @enderror</div>
            </div>
            <div class="form-group">
                <label class="form-label text-dark">Kategori Lomba</label>
                <div wire:ignore>
                    <select id="kategori-prestasi-select-edit" class="default-select form-control wide" wire:model.blur='kategori_prestasi'>
                        <option hidden>Nothing Selected</option>
                        @foreach($list_kategori_prestasi as $kategori_prestasi)
                            <option value="{{ $kategori_prestasi->id }}">{{ $kategori_prestasi->nama }}</option>
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

        <div class="card-footer" style="border: none;">
            <div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>

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

        $('#kategori-prestasi-select-edit').on('changed.bs.select', function () {
            var selectedKategoriPrestasi = $(this).val();
            @this.set('kategori_prestasi', selectedKategoriPrestasi);
        });

        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('semester-updated', event => {
                const select = document.getElementById('semester-select');
                select.value = event.detail.value;

                $('#semester-select').selectpicker('refresh');
            });

            window.addEventListener('periode-updated', event => {
                const select = document.getElementById('periode-select');
                select.value = event.detail.value;

                $('#periode-select').selectpicker('refresh');
            });

            window.addEventListener('kategori-prestasi-updated', event => {
                const select = document.getElementById('kategori-prestasi-select-edit');
                select.value = event.detail.value;

                $('#kategori-prestasi-select-edit').selectpicker('refresh');
            });
        });
    </script>
    @endpush
</div>
