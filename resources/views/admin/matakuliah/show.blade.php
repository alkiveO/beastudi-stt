@extends('layouts.app')

@section('title', 'Detail Matakuliah')
@section('title_dashboard', 'Master Data')

@section('content')
<div class="container-fluid">
    <div class="col-xl-12">

        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- CARD DETAIL MATAKULIAH --}}
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="mb-1">{{ $matakuliah->nama_mk }}</h5>
                <p class="mb-0 text-muted">
                    Kode: <strong>{{ $matakuliah->kode_mk }}</strong> |
                    SKS: <strong>{{ $matakuliah->sks }}</strong>
                </p>
            </div>
        </div>

        {{-- FILTER --}}
     <div class="card mb-3">
    <div class="card-body">
        <form method="GET" id="filterForm">
            <div class="row g-3 align-items-end">

                <div class="col-md-4">
                    <label class="form-label">Periode</label>
                    <select name="periode_id"
        id="filterPeriode"
        class="form-select filter-select">

                        <option value="">-- Semua Periode --</option>
                        @foreach($periodeList as $periode)
                            <option value="{{ $periode->id }}"
                                {{ $periodeId == $periode->id ? 'selected' : '' }}>
                                {{ $periode->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tahun Masuk</label>
                    <select name="tahun_masuk" class="form-select filter-select">
                        <option value="">-- Semua --</option>
                        @foreach($tahunMasukList as $tahun)
                            <option value="{{ $tahun }}"
                                {{ $tahunMasuk == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Program Studi</label>
                    <select name="program_studi" class="form-select filter-select">
                        <option value="">-- Semua --</option>
                        @foreach($programStudiList as $prodi)
                            <option value="{{ $prodi }}"
                                {{ $programStudi == $prodi ? 'selected' : '' }}>
                                {{ $prodi }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
        </form>
    </div>
</div>

{{-- TABEL MAHASISWA --}}
<div class="card">
    <div class="card-header">

        <div class="d-flex justify-content-between align-items-center">
            

            <button class="btn btn-sm btn-success"
                    id="btnTambahMahasiswa"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah"
                    {{ empty($periodeId) ? 'disabled' : '' }}>
                + Tambah Mahasiswa
            </button>
        </div>

        @if(empty($periodeId))
            <div class="mt-1">
                <small class="text-danger">
                    Pilih periode terlebih dahulu untuk menambahkan mahasiswa
                </small>
            </div>
        @endif

    </div>


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Tahun Masuk</th>
                                <th>Program Studi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mahasiswa as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nim ?? '-' }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->tahun_masuk }}</td>
                
                                    <td>{{ $item->program_studi}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Belum ada mahasiswa
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

{{-- MODAL TAMBAH MAHASISWA --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ url('admin/matakuliah/'.$matakuliah->id.'/mahasiswa') }}" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Tambah Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="periode_id" value="{{ $periodeId }}">

                <div class="table-responsive">
      <div class="row mb-3 align-items-center">
    <div class="col-md-8">
        <div class="input-group">
            <span class="input-group-text">
                🔍
            </span>
            <input type="text"
                   id="searchMahasiswa"
                   class="form-control"
                   placeholder="Cari NIM atau Nama Mahasiswa...">
        </div>
    </div>

    <div class="col-md-4 text-end">
        <div class="form-check form-switch d-inline-flex align-items-center">
            <input class="form-check-input" type="checkbox" id="checkAll">
            <label class="form-check-label ms-2" for="checkAll">
                Pilih Semua
            </label>
        </div>
    </div>
</div>


                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
<tr>
    <th width="5%" class="text-center">
        <input type="checkbox" id="checkAllTable">
    </th>
    <th>NIM</th>
    <th>Nama Mahasiswa</th>
<th>Tahun Masuk</th>
                                <th>Program Studi</th>
</tr>
</thead>

                        <tbody>
                            @forelse($mahasiswaBelum as $mhs)
                               <tr class="row-mahasiswa">
    <td class="text-center">
        <input type="checkbox"
               class="form-check-input check-item"
               name="mahasiswa_id[]"
               value="{{ $mhs->id }}">
    </td>
    <td class="nim">{{ $mhs->nim ?? '-' }}</td>
    <td class="nama">{{ $mhs->nama }}</td>
    <td>{{ $mhs->tahun_masuk }}</td>
    <td>{{ $mhs->program_studi }}</td>
</tr>

                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Tidak ada mahasiswa tersedia
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center mt-3">
    <div class="text-muted" id="pageInfo">
        Menampilkan 0 data
    </div>

    <nav>
        <ul class="pagination pagination-sm mb-0" id="pagination">
            {{-- pagination via JS --}}
        </ul>
    </nav>
</div>

                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

        </form>
    </div>
</div>
@push('script')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput   = document.getElementById('searchMahasiswa');
    const checkAll      = document.getElementById('checkAll');
    const checkAllTable = document.getElementById('checkAllTable');

    const rows = Array.from(document.querySelectorAll('.row-mahasiswa'));
    const checkItems = Array.from(document.querySelectorAll('.check-item'));

    const pagination = document.getElementById('pagination');
    const pageInfo   = document.getElementById('pageInfo');

    const PER_PAGE = 10;
    let currentPage = 1;
    let filteredRows = [...rows];

    // =========================
    // RENDER PAGE
    // =========================
    function renderPage() {
        const start = (currentPage - 1) * PER_PAGE;
        const end   = start + PER_PAGE;

        rows.forEach(row => row.style.display = 'none');

        filteredRows.slice(start, end).forEach(row => {
            row.style.display = '';
        });

        pageInfo.innerText =
            `Menampilkan ${filteredRows.length} data`;
    }

    // =========================
    // RENDER PAGINATION
    // =========================
    function renderPagination() {
        pagination.innerHTML = '';

        const totalPages = Math.ceil(filteredRows.length / PER_PAGE);
        if (totalPages <= 1) return;

        // Prev
        pagination.innerHTML += `
            <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="prev">«</a>
            </li>
        `;

        for (let i = 1; i <= totalPages; i++) {
            pagination.innerHTML += `
                <li class="page-item ${currentPage === i ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>
            `;
        }

        // Next
        pagination.innerHTML += `
            <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="next">»</a>
            </li>
        `;
    }

    // =========================
    // UPDATE VIEW
    // =========================
    function updateView() {
        renderPage();
        renderPagination();
        syncCheckAll();
    }

    // =========================
    // SEARCH
    // =========================
    searchInput.addEventListener('input', function () {
        const keyword = this.value.toLowerCase();

        filteredRows = rows.filter(row => {
            const nim  = row.querySelector('.nim').innerText.toLowerCase();
            const nama = row.querySelector('.nama').innerText.toLowerCase();
            return nim.includes(keyword) || nama.includes(keyword);
        });

        currentPage = 1;
        updateView();
    });

    // =========================
    // PAGINATION CLICK
    // =========================
    pagination.addEventListener('click', function (e) {
        e.preventDefault();
        const page = e.target.dataset.page;
        if (!page) return;

        const totalPages = Math.ceil(filteredRows.length / PER_PAGE);

        if (page === 'prev' && currentPage > 1) currentPage--;
        else if (page === 'next' && currentPage < totalPages) currentPage++;
        else if (!isNaN(page)) currentPage = parseInt(page);

        updateView();
    });

    // =========================
    // CHECK ALL (VISIBLE ONLY)
    // =========================
    function syncCheckAll() {
        const visibleChecks = filteredRows
            .slice((currentPage - 1) * PER_PAGE, currentPage * PER_PAGE)
            .map(row => row.querySelector('.check-item'));

        const allChecked = visibleChecks.length > 0 &&
            visibleChecks.every(i => i.checked);

        checkAll.checked = allChecked;
        checkAllTable.checked = allChecked;
    }

    checkAll.addEventListener('change', function () {
        filteredRows
            .slice((currentPage - 1) * PER_PAGE, currentPage * PER_PAGE)
            .forEach(row => {
                row.querySelector('.check-item').checked = this.checked;
            });

        checkAllTable.checked = this.checked;
    });

    checkAllTable.addEventListener('change', function () {
        checkAll.checked = this.checked;
        checkAll.dispatchEvent(new Event('change'));
    });

    checkItems.forEach(item => {
        item.addEventListener('change', syncCheckAll);
    });

    // =========================
    // INIT
    // =========================
    updateView();

});
</script>
@endpush



@push('script')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const form        = document.getElementById('filterForm');
    const filterItems = document.querySelectorAll('.filter-select');
    const periode     = document.getElementById('filterPeriode');
    const btnTambah   = document.getElementById('btnTambahMahasiswa');

    if (!periode || !btnTambah) return;

    // =========================
    // AUTO SUBMIT FILTER
    // =========================
    filterItems.forEach(el => {
        el.addEventListener('change', function () {
            form.submit();
        });
    });

    // =========================
    // TOGGLE BUTTON TAMBAH
    // =========================
    function toggleButton() {
        if (periode.value !== '') {
            btnTambah.removeAttribute('disabled');
        } else {
            btnTambah.setAttribute('disabled', true);
        }
    }

    // Saat load
    toggleButton();

    // Saat periode berubah
    periode.addEventListener('change', toggleButton);

});
</script>
@endpush




@endsection
