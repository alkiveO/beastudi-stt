<div>
    <div>
        @include('partials.modal-download-spb')
        @include('partials.modal-download-lpj')
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control" wire:model.debounce.300='nama' placeholder="Cari nama mahasiswa" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" wire:model.debounce.300='tahun_masuk' placeholder="Cari angkatan mahasiswa" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                        <select id="prodi" class="default-select form-control wide" wire:model.debounce.300='program_studi'>
                            <option hidden>Nothing Selected</option>
                            @foreach($list_prodi as $prodi)
                                <option value="{{ $prodi->nama }}">{{ ucwords($prodi->nama) }}</option>
                            @endforeach
                        </select>
                        <div class="dropdown-menu">
                            <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                        <select id="jalur-beastudi" class="default-select form-control wide" wire:model.debounce.300='jalur_beastudi'>
                            <option hidden>Nothing Selected</option>
                            @foreach($list_beastudi as $beastudi)
                                <option value="{{ $beastudi->nama }}">{{ ucwords($beastudi->nama) }}</option>
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
            <div class="mt-4 mb-4" style="text-align:right;">
                <livewire:admin.import-mahasiswa>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background:#FF4747;">
                        <tr>
                            <th style="color:white !important;">ID</th>
                            <th style="color:white !important;">NIM</th>
                            <th style="color:white !important;">Nama Mahasiswa</th>
                            <th style="color:white !important;">Program Studi</th>
                            <th style="color:white !important;">Jalur Beastudi</th>
                            <th style="color:white !important;">Angkatan Masuk</th>
                            <th style="color:white !important;">Jenis Kelamin</th>
                            <th style="color:white !important;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-black">
                        @foreach($data_mahasiswa as $mahasiswa)
                            <tr>
                                <td>{{ $mahasiswa->mhs_id }}</td>
                                <td>{{ $mahasiswa->nim }}</td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td>{{ ucwords($mahasiswa->program_studi) }}</td>
                                <td>{{ ucwords($mahasiswa->jalur_beastudi) }}</td>
                                <td>{{ $mahasiswa->tahun_masuk }}</td>
                                <td>{{ $mahasiswa->jenis_kelamin }}</td>
                                <td>
                                    <a href="{{ route('admin.master-data.show', $mahasiswa->mhs_id) }}">Detail</a>
                                    @if($mahasiswa->nim)
                                        <a href="{{ route('admin.monitoring.show', $mahasiswa->nim) }}"> | Monitoring | </a>
                                        <a href="#" id="download-spb" data-nim="{{ $mahasiswa->nim }}">Download SPB | </a>
                                        <a href="#" id="download-lpj" data-nim="{{ $mahasiswa->nim }}">Download LPJ</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $data_mahasiswa->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $('body').on('click', '#download-spb', function() {
                const nim = $(this).data('nim');

                $('#downloadSpbModal')
                    .find('form')
                    .attr('action', '/admin/download-spb')

                $('#downloadSpbModal')
                    .find('#input-nim')
                    .val(nim)

                $('#downloadSpbModal').modal('show')
            })

            $('body').on('click', '#download-lpj', function() {
                const nim = $(this).data('nim');

                $('#downloadLpjModal')
                    .find('form')
                    .attr('action', '/admin/download-lpj')

                $('#downloadLpjModal')
                    .find('#input-nim')
                    .val(nim)

                $('#downloadLpjModal').modal('show')
            })
        </script>
    @endpush
</div>
