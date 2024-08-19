<div class="dlabnav">
    <div class="dlabnav-scroll">
        @if(auth()->guard('web')->check())
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">signal_cellular_alt</i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.master-data') }}" aria-expanded="false">
                        <i class="bi bi-pencil-square"></i>
                        <span class="nav-text">Master Data</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.redaksi') }}" aria-expanded="false">
                        <i class="bi bi-pencil-square"></i>
                        <span class="nav-text">Redaksi</span>
                    </a>
                </li>
                <li class="">
                    <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                        <i class="material-symbols-outlined">settings</i>
                        <span class="nav-text">Pengaturan</span>
                    </a>
					<ul aria-expanded="false" class="mm-collapse" style="height: 16px;">
						<li><a href="#">Periode</a></li>
						<li><a href="#">Jalur Beastudi</a></li>
						<li><a href="{{ route('admin.kontribusi-khusus') }}">Kontribusi Khusus</a></li>
					</ul>
					</li>
                <li>
                    <a
                        href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    >
                        <i class="bi bi-box-arrow-left"></i>
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
                        <i class="material-icons">signal_cellular_alt</i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.data-diri') }}" aria-expanded="false">
                        <i class="bi bi-pencil-square"></i>
                        <span class="nav-text">Data Diri</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.monitoring') }}" aria-expanded="false">
                        <i class="bi bi-pencil-square"></i>
                        <span class="nav-text">Laporan Semester</span>
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
            </ul>
        @endif

    </div>
</div>
