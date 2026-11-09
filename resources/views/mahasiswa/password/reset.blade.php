
<!DOCTYPE html>
<html lang="id" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reset Password - Beastudi STT NF</title>

    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custome.css') }}" rel="stylesheet">
</head>

<body class="body h-100">
    <div class="authincation d-flex flex-column flex-lg-row flex-column-fluid">

        <div class="flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden">
            <div class="px-4">
                <header class="d-flex flex-wrap justify-content-center border-2 px-4">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
                        <img src="{{ asset('images/logo.png') }}" width="90" alt="logo-nf">
                    </a>
                </header>

                <div class="px-4 mt-4">
                    <h1 class="text-gray">Buat Password Baru</h1>

                    <p class="fs-5 text-gray">
                        Silakan masukkan password baru untuk akun mahasiswa Beastudi Anda.
                    </p>
                </div>
            </div>
        </div>

        <div class="login-aside d-flex flex-column flex-row-auto flex-row-fluid bg-orange align-items-center justify-content-center">

            <div class="auth-form form-validation">
                <div class="p-4">

                    <h2 class="text-white mb-4">Reset Password</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('mahasiswa.password.update') }}" method="POST">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label for="email" class="form-label text-white">
                                Email
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                id="email"
                                value="{{ old('email', $email) }}"
                                autocomplete="email"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-white">
                                Password Baru
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                name="password"
                                id="password"
                                placeholder="Masukkan password baru"
                                autocomplete="new-password"
                                minlength="8"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label text-white">
                                Konfirmasi Password Baru
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                name="password_confirmation"
                                id="password_confirmation"
                                placeholder="Ulangi password baru"
                                autocomplete="new-password"
                                minlength="8"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 w-100">
                            Simpan Password Baru
                        </button>
                    </form>

                    <div class="mt-4 text-center">
                        <a href="{{ route('mahasiswa.login') }}" class="text-white">
                            Kembali ke halaman login
                        </a>
                    </div>

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
