<div class="dlabnav">
    <div class="dlabnav-scroll">
        @if(auth()->guard('web')->check())
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.master-data') }}" aria-expanded="false">
                        <i class="material-icons">folder</i>
                        <span class="nav-text">Master Data</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.monitoring') }}" aria-expanded="false">
                        <i class="material-icons">description</i>
                        <span class="nav-text">Monitoring</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.redaksi') }}" aria-expanded="false">
                        <i class="material-icons">folder</i>
                        <span class="nav-text">Redaksi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.prestasi') }}" aria-expanded="false">
                        <i class="material-icons">emoji_events</i>
                        <span class="nav-text">Prestasi</span>
                    </a>
                </li>
                <li class="">
                    <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                        <i class="material-icons">settings</i>
                        <span class="nav-text">Pengaturan</span>
                    </a>
					<ul aria-expanded="false" class="mm-collapse" style="height: 16px;">
						<li><a href="{{ route('admin.periode') }}">Periode</a></li>
						<li><a href="{{ route('admin.jalur-beastudi') }}">Jalur Beastudi</a></li>
						<li><a href="{{ route('admin.kontribusi-khusus') }}">Kontribusi Khusus</a></li>
					</ul>
					</li>
                <li>
                    <a
                        href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    >
                        <i class="material-icons">logout</i>
                        <span class="nav-text">Keluar</span>
                    </a>
                </li>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </ul>
        @endif

        @if(auth()->guard('mahasiswa')->check())
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ route('mahasiswa.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.data-diri') }}" aria-expanded="false">
                        <i class="material-icons">assignment</i>
                        <span class="nav-text">Data Diri</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.monitoring') }}" aria-expanded="false">
                        <i class="material-icons">receipt_long</i>
                        <span class="nav-text">Laporan Semester</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('mahasiswa.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    >
                        <i class="material-icons">logout</i>
                        <span class="nav-text">Keluar</span>
                    </a>
                </li>

                <form id="logout-form" action="{{ route('mahasiswa.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </ul>
        @endif

    </div>
</div>
