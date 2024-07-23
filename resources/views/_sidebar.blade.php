<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('mahasiswa.dashboard') }}">
                    <i class="material-icons">signal_cellular_alt</i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.mou.index') }}">
                    <i class="bi bi-pencil-square"></i>
                    <span class="nav-text">Form SPB MOU</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.data-diri') }}" aria-expanded="false">
                    <i class="bi bi-pencil-square"></i>
                    <span class="nav-text">Form Data Diri</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.monitoring') }}" aria-expanded="false">
                    <i class="bi bi-pencil-square"></i>
                    <span class="nav-text">Form Monitoring</span>
                </a>
            </li>
            <li>
                <a
                    href="{{ route('mahasiswa.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >
                    <i class="bi bi-box-arrow-left"></i>
                    <span class="nav-text">Keluar</span>
                </a>
            </li>

            <form id="logout-form" action="{{ route('mahasiswa.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            {{-- <li>
                <a href="form-evaluasi.html" aria-expanded="false">
                    <i class="bi bi-pencil-square"></i>
                    <span class="nav-text">Form Evaluasi</span>
                </a>
            </li>
            <li>
                <a href="reporting.html" aria-expanded="false">
                    <i class="bi bi-pencil-square"></i>
                    <span class="nav-text">Reporting</span>
                </a>
            </li>
            <li>
                <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="bi bi-pencil-square"></i>
                    <span class="nav-text">Redaksi</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="redaksi-informasi.html">Informasi</a></li>
                    <li><a href="halaman-login-redaksi.html">Halaman Login</a></li>
                </ul>
            </li>
            <li>
                <a href="form-aktif.html" aria-expanded="false">
                    <i class="bi bi-pencil-square"></i>
                    <span class="nav-text">Form Aktif</span>
                </a>
            </li>
            <li>
                <a href="data-mahasiswa.html" aria-expanded="false">
                    <i class="material-icons">people_outline</i>
                    <span class="nav-text">Data Mahasiswa</span>
                </a>
            </li>
            <li>
                <a href="master-data.html" aria-expanded="false">
                    <i class="material-icons">folder_open</i>
                    <span class="nav-text">Master Data</span>
                </a>
            </li>
            <li>
                <a href="managemen-akun.html" aria-expanded="false">
                    <i class="bi bi-person-lines-fill"></i>
                    <span class="nav-text">Manajemen Akun</span>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
