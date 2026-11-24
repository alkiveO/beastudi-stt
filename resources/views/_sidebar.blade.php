<div class="dlabnav">
    <div class="dlabnav-scroll">

        {{-- ================= ADMIN ================= --}}
        @if(auth()->guard('web')->check() && auth()->user()->role === 'admin')
            <ul class="metismenu" id="menu-admin">

                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.master-data') }}">
                        <i class="material-icons">folder</i>
                        <span class="nav-text">Master Data</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.monitoring') }}">
                        <i class="material-icons">description</i>
                        <span class="nav-text">Monitoring</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.redaksi') }}">
                        <i class="material-icons">folder</i>
                        <span class="nav-text">Redaksi</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.prestasi') }}">
                        <i class="material-icons">emoji_events</i>
                        <span class="nav-text">Prestasi</span>
                    </a>
                </li>

                <li class="has-sub">
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="material-icons">settings</i>
                        <span class="nav-text">Pengaturan</span>
                    </a>

                    <ul class="mm-collapse">
                        <li><a href="{{ url('admin/matakuliah') }}">Matakuliah</a></li>
                        <li><a href="{{ route('admin.documents.index') }}">Dokumen</a></li>
                        <li><a href="{{ route('admin.wilayah') }}">Wilayah</a></li>
                        <li><a href="{{ route('admin.periode') }}">Periode</a></li>
                        <li><a href="{{ route('admin.jalur-beastudi') }}">Jalur Beastudi</a></li>
                        <li><a href="{{ route('admin.kontribusi-khusus') }}">Kontribusi Khusus</a></li>
                        <li><a href="{{ route('admin.pembimbing-akademik') }}">Pembimbing Akademik</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-admin').submit();">
                        <i class="material-icons">logout</i>
                        <span class="nav-text">Keluar</span>
                    </a>
                </li>

                <form id="logout-admin"
                      action="{{ route('admin.logout') }}"
                      method="POST"
                      style="display:none;">
                    @csrf
                </form>

            </ul>
        @endif


        {{-- ================= KEMAS ================= --}}
        @if(auth()->guard('web')->check() && auth()->user()->role === 'kemas')
            <ul class="metismenu" id="menu-kemas">

                <li>
                    <a href="{{ route('kemas.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('kemas.prestasi') }}">
                        <i class="material-icons">emoji_events</i>
                        <span class="nav-text">Prestasi</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('kemas.logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-kemas').submit();">
                        <i class="material-icons">logout</i>
                        <span class="nav-text">Keluar</span>
                    </a>
                </li>

                <form id="logout-kemas"
                      action="{{ route('kemas.logout') }}"
                      method="POST"
                      style="display:none;">
                    @csrf
                </form>

            </ul>
        @endif


        {{-- ================= PA ================= --}}
        @if(auth()->guard('web')->check() && auth()->user()->role === 'pa')
            <ul class="metismenu" id="menu-pa">

                <li>
                    <a href="{{ route('pa.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pa.master-data') }}">
                        <i class="material-icons">folder</i>
                        <span class="nav-text">Master Data</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pa.logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-pa').submit();">
                        <i class="material-icons">logout</i>
                        <span class="nav-text">Keluar</span>
                    </a>
                </li>

                <form id="logout-pa"
                      action="{{ route('pa.logout') }}"
                      method="POST"
                      style="display:none;">
                    @csrf
                </form>

            </ul>
        @endif


        {{-- ================= MAHASISWA ================= --}}
        @if(auth()->guard('mahasiswa')->check())
            <ul class="metismenu" id="menu-mahasiswa">

                <li>
                    <a href="{{ route('mahasiswa.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('mahasiswa.data-diri') }}">
                        <i class="material-icons">assignment</i>
                        <span class="nav-text">Data Diri</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('mahasiswa.monitoring') }}">
                        <i class="material-icons">receipt_long</i>
                        <span class="nav-text">Laporan Semester</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('mahasiswa.logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-mhs').submit();">
                        <i class="material-icons">logout</i>
                        <span class="nav-text">Keluar</span>
                    </a>
                </li>

                <form id="logout-mhs"
                      action="{{ route('mahasiswa.logout') }}"
                      method="POST"
                      style="display:none;">
                    @csrf
                </form>

            </ul>
        @endif

    </div>
</div>

@push('script')
<script>
    $(document).ready(function () {
        $('#menu-admin').metisMenu();
        $('#menu-kemas').metisMenu();
        $('#menu-pa').metisMenu();
        $('#menu-mahasiswa').metisMenu();
    });
</script>
@endpush