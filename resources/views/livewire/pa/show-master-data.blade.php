<div>
    @section('title_dashboard', 'Detail Mahasiswa: ' . $mahasiswa->nama)

    <div class="container-fluid">
        <div class="col-xl-12">

            {{-- INFORMASI DATA DIRI --}}
            <div class="card">

                <div class="card-header">
                    <h5 class="mb-0">Informasi Data Diri</h5>

                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('pa.monitoring.show', $mahasiswa->nim) }}"
                           class="btn btn-primary btn-sm"
                           title="Monitoring Mahasiswa">
                            <i class="material-icons" style="vertical-align: middle;">
                                assignment
                            </i>
                            Monitoring
                        </a>

                        <a href="{{ route('pa.master-data') }}"
                           class="btn btn-light btn-sm"
                           title="Kembali ke Master Data">
                            <i class="material-icons" style="vertical-align: middle;">
                                arrow_back
                            </i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <label class="form-label text-dark">Nama Mahasiswa</label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->nama }}" readonly>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label text-dark">Nomor KTP Mahasiswa</label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->no_ktp }}" readonly>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label text-dark">Jenis Kelamin</label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->jenis_kelamin }}" readonly>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label text-dark">Agama</label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->agama }}" readonly>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label text-dark">Email</label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->email }}" readonly>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label text-dark">Nomor KK Mahasiswa</label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->no_kk }}" readonly>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label text-dark">Tanggal Lahir</label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->tanggal_lahir }}" readonly>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label text-dark">Nomor Handphone</label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->nomor_hp }}" readonly>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label text-dark">
                                Nomor Handphone Orang Tua / Wali
                            </label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->nomor_hp_ortu }}" readonly>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ALAMAT MAHASISWA --}}
            <div class="card">

                <div class="card-header">
                    <h5 class="mb-0">Alamat Mahasiswa</h5>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <label class="form-label text-dark">Provinsi</label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->provinsi }}" readonly>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label text-dark">Kabupaten / Kota</label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->kota }}" readonly>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label text-dark">Kecamatan</label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->kecamatan }}" readonly>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label text-dark">Desa / Kelurahan</label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->kelurahan }}" readonly>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label text-dark">Kode POS</label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->kode_pos }}" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label text-dark">Alamat Domisili</label>
                            <textarea class="form-control"
                                      rows="3"
                                      readonly>{{ $mahasiswa->alamat }}</textarea>
                        </div>

                    </div>
                </div>
            </div>

            {{-- DATA AKADEMIK --}}
            <div class="card">

                <div class="card-header">
                    <h5 class="mb-0">Data Akademik</h5>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-2 mb-3">
                            <label class="form-label text-dark">NIM</label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->nim }}" readonly>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label text-dark">Program Studi</label>
                            <input type="text" class="form-control"
                                   value="{{ ucwords($mahasiswa->program_studi) }}" readonly>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="form-label text-dark">Rombel</label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->rombel }}" readonly>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="form-label text-dark">Angkatan</label>
                            <input type="text" class="form-control"
                                   value="{{ $mahasiswa->tahun_masuk }}" readonly>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label text-dark">Jalur Beastudi</label>
                            <input type="text" class="form-control"
                                   value="{{ ucwords($mahasiswa->jalur_beastudi) }}" readonly>
                        </div>

                    </div>
                </div>
            </div>

            {{-- BERKAS AKADEMIK --}}
            <div class="card">

                <div class="card-header">
                    <h5 class="mb-0">Berkas Akademik</h5>
                </div>

                <div class="card-body">

                    @php
                        $berkas = [
                            [
                                'judul' => 'Surat Perjanjian Rangkap 1',
                                'file' => $mahasiswa->mou->spb_rangkap_1 ?? null,
                                'folder' => 'camaba/spb-rangkap-1',
                            ],
                            [
                                'judul' => 'Surat Perjanjian Rangkap 2',
                                'file' => $mahasiswa->mou->spb_rangkap_2 ?? null,
                                'folder' => 'camaba/spb-rangkap-2',
                            ],
                            [
                                'judul' => 'Surat Komitmen Orang Tua',
                                'file' => $mahasiswa->mou->surat_komitmen_ortu ?? null,
                                'folder' => 'camaba/surat-komitmen-ortu',
                            ],
                        ];

                        $berkasTersedia = collect($berkas)
                            ->filter(function ($item) {
                                return !empty($item['file']);
                            });
                    @endphp

                    @forelse($berkasTersedia as $berkasItem)

                        <div class="d-flex justify-content-between mb-3"
                             style="padding-right:30%;">

                            <p>{{ $berkasItem['judul'] }}</p>

                            <a href="{{ asset('storage/' . $berkasItem['folder'] . '/' . $berkasItem['file']) }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="text-dark">
                                Lihat File
                            </a>

                        </div>

                    @empty

                        <p class="mb-0">Tidak ada berkas akademik.</p>

                    @endforelse

                </div>
            </div>

        </div>
    </div>
</div>