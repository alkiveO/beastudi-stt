<div>
    <div class="card">
        <div class="card-body">

            {{-- FILTER --}}
            <div class="row">

                <div class="col-md-3">
                    <input
                        type="text"
                        class="form-control"
                        wire:model.debounce.300ms="nama"
                        placeholder="Cari nama mahasiswa"
                        autocomplete="off"
                    >
                </div>

                <div class="col-md-3">
                    <input
                        type="number"
                        class="form-control"
                        wire:model.debounce.300ms="tahun_masuk"
                        placeholder="Cari angkatan mahasiswa"
                        autocomplete="off"
                    >
                </div>

                <div class="col-md-3">
                    <select
                        class="default-select form-control wide"
                        wire:model="program_studi"
                    >
                        <option value="">Semua Program Studi</option>

                        @foreach($list_prodi as $prodi)
                            <option value="{{ $prodi->nama }}">
                                {{ ucwords($prodi->nama) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select
                        class="default-select form-control wide"
                        wire:model="jalur_beastudi"
                    >
                        <option value="">Semua Jalur Beastudi</option>

                        @foreach($list_beastudi as $beastudi)
                            <option value="{{ $beastudi->nama }}">
                                {{ ucwords($beastudi->nama) }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- TABEL MAHASISWA --}}
            <div class="table-responsive mt-4">

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

                        @forelse($data_mahasiswa as $mahasiswa)

                            <tr>
                                <td>{{ $mahasiswa->mhs_id }}</td>
                                <td>{{ $mahasiswa->nim }}</td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td>{{ ucwords($mahasiswa->program_studi) }}</td>
                                <td>{{ ucwords($mahasiswa->jalur_beastudi) }}</td>
                                <td>{{ $mahasiswa->tahun_masuk }}</td>
                                <td>{{ $mahasiswa->jenis_kelamin }}</td>

                                <td>
                                    <a
                                        href="{{ route('pa.master-data.show', $mahasiswa->mhs_id) }}"
                                        title="Detail"
                                    >
                                        <span class="material-icons">
                                            visibility
                                        </span>
                                    </a>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="text-center">
                                    Belum ada mahasiswa bimbingan.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

                {{-- PAGINATION --}}
                <div class="mt-4">
                    {{ $data_mahasiswa->links('vendor.livewire.bootstrap') }}
                </div>

            </div>

        </div>
    </div>
</div>