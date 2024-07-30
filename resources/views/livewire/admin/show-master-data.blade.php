<div>
    @section('title_dashboard', 'Detail Master Data: ' .$mahasiswa->nama)

    <div class="container-fluid">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Data Diri</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label text-dark">
                                Nama Mahasiswa
                            </label>
                            <p>{{ $mahasiswa->nama }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-dark">
                                Nomor KTP
                            </label>
                            <p>{{ $mahasiswa->no_ktp }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-dark">
                                Jenis Kelamin
                            </label>
                            <p>{{ $mahasiswa->jenis_kelamin }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-dark">
                                Agama
                            </label>
                            <p>{{ $mahasiswa->agama }}</p>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <label class="form-label text-dark">
                                Email
                            </label>
                            <p>{{ $mahasiswa->email }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-dark">
                                Nomor KK
                            </label>
                            <p>{{ $mahasiswa->no_kk }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-dark">
                                Tanggal dan Tahun Lahir
                            </label>
                            <p>{{ $mahasiswa->tanggal_lahir }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-dark">
                                Nomor Handphone
                            </label>
                            <p>{{ $mahasiswa->nomor_hp }}</p>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <label class="form-label text-dark">
                                Nomor Handphone Orang Tua / Wali
                            </label>
                            <p>{{ $mahasiswa->nomor_hp_ortu }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <h5 class="mb-0">Alamat Mahasiswa</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label text-dark">
                                Desa / Kelurahan
                            </label>
                            <p>{{ strtoupper($mahasiswa->kelurahan) }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-dark">
                                Kecamatan
                            </label>
                            <p>{{ strtoupper($mahasiswa->kecamatan) }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-dark">
                                Kabupaten / Kota
                            </label>
                            <p>{{ strtoupper($mahasiswa->kota) }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-dark">
                                Provinsi
                            </label>
                            <p>{{ strtoupper($mahasiswa->provinsi) }}</p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <label class="form-label text-dark">
                                Kode Pos
                            </label>
                            <p>{{ $mahasiswa->kode_pos }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-dark">
                                Alamat
                            </label>
                            <p>{{ $mahasiswa->alamat }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <h5 class="mb-0">Data Akademik</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-label text-dark">
                                NIM
                            </label>
                            <p>{{ $mahasiswa->nim }}</p>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-dark">
                                Program Studi
                            </label>
                            <p>{{ ucwords($mahasiswa->program_studi) }}</p>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-dark">
                                Rombel
                            </label>
                            <p>{{ strtoupper($mahasiswa->rombel) }}</p>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-dark">
                                Angkatan
                            </label>
                            <p>{{ $mahasiswa->tahun_masuk }}</p>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-dark">
                                Jalur Beastudi
                            </label>
                            <p>{{ ucwords($mahasiswa->jalur_beastudi) }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <h5 class="mb-0">Berkas Akademik</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-between" style="padding-right:30%;">
                            <p>Surat Perjanjian Rangkap 1</p>
                            <p><a href="{{ asset('storage/camaba/spb-rangkap-1/' . $mahasiswa->mou->spb_rangkap_1) }}" target="__blank" class="text-dark">Lihat File</a></p>
                        </div>
                        <div class="d-flex justify-content-between" style="padding-right:30%;">
                            <p>Surat Perjanjian Rangkap 2</p>
                            <p><a href="{{ asset('storage/camaba/spb-rangkap-2/' . $mahasiswa->mou->spb_rangkap_2) }}" target="__blank" class="text-dark">Lihat File</a></p>
                        </div>
                        <div class="d-flex justify-content-between" style="padding-right:30%;">
                            <p>Surat Komitmen Orang Tua</p>
                            <p><a href="{{ asset('storage/camaba/surat-komitmen-ortu/' . $mahasiswa->mou->surat_komitmen_ortu) }}" target="__blank" class="text-dark">Lihat File</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
