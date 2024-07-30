<div>
    <div class="card">
        <div class="card-body">
            <div class="mb-4" style="text-align:right;">
                <livewire:admin.import-mahasiswa>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background:#FF4747;">
                        <tr>
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
                                <td>{{ $mahasiswa->nim }}</td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td>{{ ucwords($mahasiswa->program_studi) }}</td>
                                <td>{{ ucwords($mahasiswa->jalur_beastudi) }}</td>
                                <td>{{ $mahasiswa->tahun_masuk }}</td>
                                <td>{{ $mahasiswa->jenis_kelamin }}</td>
                                <td>
                                    <a href="#">Detail |</a>
                                    <a href="#">Ekspor | </a>
                                    <a href="#">Monitoring</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
