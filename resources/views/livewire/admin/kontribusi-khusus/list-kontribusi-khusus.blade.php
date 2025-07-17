<div>
    <div>
        @include('partials.modal-add-kontribusi-khusus')
        @include('partials.modal-edit-kontribusi-khusus')
        @include('partials.modal-delete-kontribusi-khusus')
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mt-4 mb-4" style="text-align:right;">
                <a href="#" class="btn btn-primary" wire:click='$emit("showAddKontribusiKhususModal")'>Tambah</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background:#FF4747;">
                        <tr>
                            <th style="color:white !important;">#</th>
                            <th style="color:white !important;">Kontribusi Khusus</th>
                            <th style="color:white !important;">Nama PIC</th>
                            <th style="color:white !important;">Telephone PIC</th>
                            <th style="color:white !important;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-black">
                        @foreach($data_kontribusi_khusus as $kontribusi_khusus)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>
                                    {{ $kontribusi_khusus->nama }} <br>
                                    @foreach($kontribusi_khusus->item_kontribusi_khusus as $item_kontribusi_khusus)
                                        <span class="d-block mt-2">- {{ $item_kontribusi_khusus->nama }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $kontribusi_khusus->pic }}</td>
                                <td>{{ $kontribusi_khusus->telp_pic }}</td>
                                <td>
                                    <a href="#" wire:click='$emit("showEditKontribusiKhususModal", {{ $kontribusi_khusus }})'>Edit |</a>
                                    <a href="#" wire:click='$emit("showDeleteKontribusiKhususModal", {{ $kontribusi_khusus }})'>Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('script')
        <script src='/livewire/admin/kontribusi-khusus.js'></script>
    @endpush
</div>
