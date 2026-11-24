<!DOCTYPE html>
<html lang="id" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="STT Terpadu Nurul Fikri">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - Beastudi STT Terpadu Nurul Fikri</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
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
                                    <p class="fs-1 fw-bold lh-sm mt-4 text-gray">
                                        Informasi Beastudi
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fs-5 text-gray">
                        Program Beastudi STT Terpadu Nurul Fikri mendukung
                        pengembangan akademis dan profesional mahasiswa melalui
                        pelatihan keterampilan serta pembinaan karakter untuk
                        mencetak lulusan unggul dan berintegritas.
                    </div>
                </div>

            </div>
        </div>

        <div class="login-aside d-flex flex-column flex-row-auto flex-row-fluid bg-orange align-items-center">

            <div id="sign-up" class="auth-form tab-pane fade show active form-validation mt-4">
                <div class="p-4">

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <h2 class="text-white">Masuk</h2>
                            <p class="text-white">
                                Administrasi dan Mahasiswa Beastudi
                            </p>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <div class="mb-3">
                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                id="email"
                                placeholder="Email"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                required
                                autofocus
                            >
                        </div>

                        <div class="mb-2">
                            <input
                                type="password"
                                class="form-control"
                                name="password"
                                id="password"
                                placeholder="Password"
                                autocomplete="current-password"
                                required
                            >
                        </div>

                        <div class="form-check mb-3">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="remember"
                                id="remember"
                            >
                            <label class="form-check-label text-white" for="remember">
                                Ingat saya
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">
                            Masuk
                        </button>

                    </form>

                </div>
            </div>

            <footer class="mt-auto text-center">
                <p class="fs-12 text-white">
                    Beastudi @ Sekolah Tinggi Teknologi Terpadu Nurul Fikri
                </p>
            </footer>

        </div>
    </div>

    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/dlabnav-init.js') }}"></script>

</body>
</html>