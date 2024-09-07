<div>
    <div>
        @include('partials.modal-add-jalur-beastudi')
        @include('partials.modal-edit-jalur-beastudi')
        @include('partials.modal-delete-jalur-beastudi')
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mt-4 mb-4" style="text-align:right;">
                <button class="btn btn-primary" wire:click='$emit("showAddJalurBeastudiModal")'>Tambah</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background:#FF4747;">
                        <tr>
                            <th style="color:white !important;">#</th>
                            <th style="color:white !important;">Jalur Beastudi</th>
                            <th style="color:white !important;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-black">
                        @foreach($data_jalur_beastudi as $jalur_beastudi)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $jalur_beastudi->nama }}</td>
                                <td>
                                    <a href="#" wire:click='$emit("showEditJalurBeastudiModal", {{ $jalur_beastudi }})'>Edit |</a>
                                    <a href="#" wire:click='$emit("showDeleteJalurBeastudiModal", {{ $jalur_beastudi }})'>Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('script')
        <script src='/livewire/admin/jalur-beastudi.js'></script>
    @endpush
</div>
