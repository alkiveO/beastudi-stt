<div>
    <div>
        @include('partials.modal-edit-prestasi')
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label text-dark">Kategori Lomba</label>
                    <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                        <select id="kategori-prestasi-select" class="default-select form-control wide" wire:model.debounce.300='kategori_prestasi'>
                            <option hidden>Nothing Selected</option>
                            @foreach($list_kategori_prestasi as $kategoriPrestasiItem)
                                <option value="{{ $kategoriPrestasiItem->id }}">{{ $kategoriPrestasiItem->nama }}</option>
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
            <div class="row mt-2">
                    <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-md btn-success" wire:click="exportExcel">
                        <i class="fa fa-download"></i> Download Excel
                    </button>
                </div>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered">
                    <thead style="background:#FF4747;">
                        <tr>
                            <th style="color:white !important;">NIM</th>
                            <th style="color:white !important;">Nama Mahasiswa</th>
                            <th style="color:white !important;">Semester</th>
                            <th style="color:white !important;">Periode</th>
                            <th style="color:white !important;">Nama Lomba</th>
                            <th style="color:white !important;">Kategori Lomba</th>
                            <th style="color:white !important;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-black">
                    @if($prestasi && $prestasi->count())
                        @foreach($prestasi as $prestasiItem)
                            <tr>
                                <td>{{ $prestasiItem->nim }}</td>
                                <td>{{ $prestasiItem->mahasiswa->nama }}</td>
                                <td>{{ $prestasiItem->semester }}</td>
                                <td>{{ $prestasiItem->periode->nama }}</td>
                                <td>{{ $prestasiItem->nama }}</td>
                                <td>{{ $prestasiItem->kategori_prestasi->nama ?? 'Lainnya' }}</td>
                                <td>
                                    <a href="javascript:void(0);" wire:click='$emit("showEditPrestasiModal", {{ $prestasiItem }})'>Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

                @if($prestasi && $prestasi->count())
                <div class="mt-4">
                    {{ $prestasi->links('vendor.livewire.bootstrap') }}
                </div>
                @else
                <div class="mt-4">
                    <p class="text-center">Data Prestasi tidak ditemukan</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    @push('script')
    <script>
        $('#kategori-prestasi-select').on('changed.bs.select', function () {
            var kategoriPrestasi = $(this).val();
            @this.set('kategori_prestasi', kategoriPrestasi);
        });

        Livewire.on('showEditPrestasiModal', (prestasi) => {
            $('#editPrestasiModal').modal('show')

            Livewire.emit('setEditPrestasi', prestasi)
        })

        Livewire.on('closeModalPrestasi', () => {
            $('#editPrestasiModal').modal('hide')
        })
    </script>
    @endpush
</div>
