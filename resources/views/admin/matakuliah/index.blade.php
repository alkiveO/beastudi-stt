@extends('layouts.app')

@section('title', 'Master Data')
@section('title_dashboard', 'Master Data')

@section('content')
<div class="container-fluid">
    <div class="col-xl-12">

        <div class="card">

            {{-- CARD HEADER --}}
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Data Matakuliah</h5>

                <button class="btn btn-sm btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTambah">
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Matakuliah
                </button>
            </div>

            {{-- CARD BODY --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>Kode MK</th>
                                <th>Nama Matakuliah</th>
                                <th width="10%" class="text-center">SKS</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($matakuliah as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_mk }}</td>
                                    <td>{{ $item->nama_mk }}</td>
                                    <td class="text-center">{{ $item->sks }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('admin/matakuliah/'.$item->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Data matakuliah belum tersedia
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>

{{-- MODAL TAMBAH MATAKULIAH --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-md">
        <form action="{{ url('admin/matakuliah') }}"
              method="POST"
              class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Tambah Matakuliah</h5>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Kode Matakuliah</label>
                    <input type="text"
                           name="kode_mk"
                           class="form-control"
                           placeholder="Contoh: IF101"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Matakuliah</label>
                    <input type="text"
                           name="nama_mk"
                           class="form-control"
                           placeholder="Contoh: Algoritma dan Pemrograman"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">SKS</label>
                    <input type="number"
                           name="sks"
                           class="form-control"
                           min="1"
                           max="6"
                           placeholder="1 - 6"
                           required>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="submit"
                        class="btn btn-primary">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
