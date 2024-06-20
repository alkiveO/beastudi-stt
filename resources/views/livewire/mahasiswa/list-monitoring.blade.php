<div>
    <div>
        @include('partials.modal-edit-monitoring')
        @include('partials.modal-detail-kontribusi')
        @include('partials.modal-delete-monitoring')
    </div>

    <div class="row">
        <div class="col-xl-12">
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
                                <th>Kontribusi</th>
                                <th>File LPJ</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($monitoring as $monitoring)
                                <tr class="selected odd">
                                    <td class="sorting_1">
                                        <h6 class="mb-0">{{ $loop->iteration }}.</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $monitoring->nim }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $monitoring->mahasiswa }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ ucfirst($monitoring->prodi->nama) }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $monitoring->angkatan }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">
                                            {{ str()->limit($monitoring->kontribusi, 50) }}

                                            @if(strlen($monitoring->kontribusi) > 50)
                                            <a href="#" style="text-decoration:underline" wire:click='$emit("showDetailKonstribusiModal", {{ $monitoring }})'>detail</a>
                                            @endif
                                        </h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">
                                            <a href="{{ asset('storage/monitoring/' . $monitoring->file) }}" target="__blank" style="text-decoration:underline">lihat file</a>
                                        </h6>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-primary shadow btn-xs sharp me-1" wire:click='$emit("showEditMonitoringModal", {{ $monitoring }})'><i class="fas fa-pencil-alt"></i></button>
                                            <button class="btn btn-danger shadow btn-xs sharp" wire:click='$emit("showDeleteMonitoringModal", {{ $monitoring }})'>
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center p-5">Monitoring tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('livewire/monitoring.js') }}"></script>
    @endpush
</div>
