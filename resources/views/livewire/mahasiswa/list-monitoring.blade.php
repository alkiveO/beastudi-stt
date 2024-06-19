<div>
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
                                            <a href="{{ asset('storage/monitoring/' . $monitoring->file) }}" target="__blank">lihat file</a>
                                        </h6>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-success shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center p-5">Monitoring tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
