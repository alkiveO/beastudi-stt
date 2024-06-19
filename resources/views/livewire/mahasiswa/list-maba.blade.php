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
                                <th>Nomor Handphone</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($list_maba as $maba)
                                <tr class="selected odd">
                                    <td class="sorting_1">
                                        <h6 class="mb-0">{{ $loop->iteration }}.</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $maba->nim }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $maba->mahasiswa }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ ucfirst($maba->prodi->nama) }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $maba->angkatan }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $maba->handphone }}</h6>
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
                                    <td colspan="7" class="text-center p-5">Data Maba tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
