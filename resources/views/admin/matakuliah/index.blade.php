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

    {{-- SEARCH --}}
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text"
                   id="searchInput"
                   class="form-control"
                   placeholder="Cari kode / nama matakuliah...">
        </div>
    </div>

    {{-- TABLE --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle mb-0"
               id="matakuliahTable">
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
                        <td class="text-center">{{ $loop->iteration }} </td>
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

    {{-- PAGINATION --}}
    <div class="mt-3 d-flex justify-content-center">
        <ul class="pagination" id="pagination"></ul>
    </div>

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
@push('script')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const table = document.getElementById('matakuliahTable');
    const rows = Array.from(table.querySelectorAll('tbody tr'));
    const searchInput = document.getElementById('searchInput');
    const pagination = document.getElementById('pagination');

    const rowsPerPage = 10;
    let currentPage = 1;
    let filteredRows = rows;

    function renderTable() {
        table.querySelector('tbody').innerHTML = '';

        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        filteredRows.slice(start, end).forEach(row => {
            table.querySelector('tbody').appendChild(row);
        });
    }

    function renderPagination() {
        pagination.innerHTML = '';
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement('li');
            li.className = `page-item ${i === currentPage ? 'active' : ''}`;

            const a = document.createElement('a');
            a.className = 'page-link';
            a.href = '#';
            a.innerText = i;

            a.addEventListener('click', function (e) {
                e.preventDefault();
                currentPage = i;
                renderTable();
                renderPagination();
            });

            li.appendChild(a);
            pagination.appendChild(li);
        }
    }

    function applySearch() {
        const keyword = searchInput.value.toLowerCase();

        filteredRows = rows.filter(row => {
            return row.innerText.toLowerCase().includes(keyword);
        });

        currentPage = 1;
        renderTable();
        renderPagination();
    }

    searchInput.addEventListener('input', applySearch);

    // init
    renderTable();
    renderPagination();
});
</script>

@endpush
@endsection
