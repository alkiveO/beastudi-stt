<div>
    <div>
        @include('partials.modal-add-periode')
        @include('partials.modal-edit-periode')
        @include('partials.modal-delete-periode')
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mt-4 mb-4" style="text-align:right;">
                <button class="btn btn-primary" wire:click='$emit("showAddPeriodeModal")'>Tambah</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background:#FF4747;">
                        <tr>
                            <th style="color:white !important;">#</th>
                            <th style="color:white !important;">Periode</th>
                            <th style="color:white !important;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-black">
                        @foreach($data_periode as $periode)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $periode->nama }}</td>
                                <td>
                                    <a href="#" wire:click='$emit("showEditPeriodeModal", {{ $periode }})'>Edit |</a>
                                    <a href="#" wire:click='$emit("showDeletePeriodeModal", {{ $periode }})'>Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('script')
        <script src='/livewire/admin/periode.js'></script>
    @endpush
</div>
