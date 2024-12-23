<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <!-- All Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="STT Terpadu Nurul Fikri">
    <meta name="robots" content="">
    <meta name="keywords" content="stt terpadu nurul fikri, kampus nurul fikri, universitas nurul fikri, teknik informatika nurul fikri, sistem informasi nurul fikri, bisnis digital nurul, mahasiswa beastudi, mahasiswa berprestasi">
    <meta name="description" content="Beastudi STT Terpadu Nurul Fikr - program beasiswa yang mendukung pengembangan akademis dan profesional mahasiswa dengan memberikan pelatihan keterampilan, serta pembinaan karakter untuk mencetak lulusan unggul dan berintegritas.">
    <meta property="og:title" content="Beastudi STT Terpadu Nurul Fikri">
    <meta property="og:description" content="Beastudi STT Terpadu Nurul Fikri - program beasiswa yang mendukung pengembangan akademis dan profesional mahasiswa dengan memberikan pelatihan keterampilan, serta pembinaan karakter untuk mencetak lulusan unggul dan berintegritas.">
    <meta property="og:image" content="https://nurulfikri.ac.id/wp-content/uploads/slider/cache/b9cdbba1a0e7c5c45cc35ca06eaebf93/Banner-Web-1-scaled.webp">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Page Title Here -->
    <title>Beastudi STT Terpadu Nurul Fikri</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custome.css') }}" rel="stylesheet">
</head>

<body class="body h-100">
    <div class="authincation d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden">
            <div class="px-4">
                <header class="d-flex flex-wrap justify-content-center border-2 px-4">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                        <img src="{{ asset('images/logo.png') }}" width="90" alt="logo-nf">
                    </a>
                </header>

                <div class="px-4">
                    <div class="d-flex">
                        <div class="authincation-content style-2">
                            <div class="row no-gutters">
                                <div class="col-xl-12 tab-content">
                                    <p class="fs-1 fw-bold lh-sm mt-4 text-gray">{{ ucwords($redaksi_login_page?->judul) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="fs-5 text-gray">
                        {!! $redaksi_login_page?->deskripsi !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="login-aside d-flex flex-column flex-row-auto flex-row-fluid bg-orange align-items-center ">
            <div id="sign-up" class="auth-form tab-pane fade show active form-validation mt-4">
                <div class="p-4">
                    <form action="{{ route('mahasiswa.login') }}" method="post">
                    @csrf
                        <div class="mb-4">
                            <h2 class="text-white">Masuk</h3>
                        </div>
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" id="email " placeholder="Email" value="user@nf.mail" autocomplete="off" required>
                        </div>
                        <div class="mb-2">
                            <input type="password" class="form-control" name="password" id="pass" placeholder="Password" value="12345678" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Masuk</button>
                    </form>
                    <div class="mt-3">
                        <p class="text-white">Bila belum memiliki akun mahasiswa beastudi aktif silahkan untuk menghubungi koordinator beastudi STT-NF</a>
                        </p>
                    </div>
                </div>
            </div>
            <footer class="mt-auto text-center">
                <p class="fs-12 text-white">Beastudi @ Sekolah Tinggi Teknologi Terpadu Nurul Fikri</p>
            </footer>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/dlabnav-init.js') }}"></script>

</body>

</html>
