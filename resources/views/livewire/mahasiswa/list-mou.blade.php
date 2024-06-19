<div>
    <div>
        @include('partials.modal-edit-mou')
        @include('partials.modal-delete-mou')
    </div>

    <div class="row">
        <div class="col-xl-12 wow fadeInUp">
            <div class="table-responsive full-data">
                <div>
                    <table class="table-responsive-lg table display dataTablesCard">
                        <thead style="background-color: #BADEFF;">
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Lengkap</th>
                                <th>Program Studi</th>
                                <th>Angkatan</th>
                                <th>File MOU</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($list_mou as $mou)
                                <tr class="selected odd">
                                    <td class="sorting_1">
                                        <h6 class="mb-0">{{ $loop->iteration }}.</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $mou->nim }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $mou->mahasiswa }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ ucfirst($mou->prodi->nama) }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $mou->angkatan }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">
                                            <a href="{{ asset('storage/mou/' . $mou->file) }}" target="__blank">lihat file</a>
                                        </h6>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-primary shadow btn-xs sharp me-1" wire:click='$emit("showEditMouModal", {{ $mou }})'><i class="fas fa-pencil"></i></button>
                                            <button class="btn btn-danger shadow btn-xs sharp" wire:click='$emit("showDeleteMouModal", {{ $mou }})'>
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center p-5">SPB MOU tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('livewire/mou.js') }}"></script>
    @endpush
</div>
