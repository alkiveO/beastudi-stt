<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <!-- All Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="STT-NF">
    <meta name="robots" content="">
    <meta name="keywords"
        content="school, school admin, education, academy, admin dashboard, college, college management, education management, institute, school management, school management system, student management, teacher management, university, university management">
    <meta name="description" content="Beastudi STT Terpadu Nurul Fikri">
    <meta property="og:title" content="Beastudi STT Terpadu Nurul Fikri">
    <meta property="og:description" content="Beastudi STT Terpadu Nurul Fikri">
    <meta name="format-detection" content="telephone=no">
    <link rel="apple-touch-icon" sizes="180x180" href="images/sttnf/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/sttnf/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/sttnf/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Page Title Here -->
    <title>Beastudi STT Terpadu Nurul Fikri</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/custome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

    @livewireStyles
</head>

<body class="body h-100">
    <div class="row">
        <div class="col-lg-8 col-sm-12 p-0">
            <div
                class="h-100 bg-default flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden">
                <div class="px-5 pt-3 mt-lpm">
                    <div class="card pb-5 px-4">
                        <div class="card-body pb-0">
                            <p class="fs-2 fw-bold lh-sm mt-4 text-gray">Sistem Informasi Unggah <br> Dokumen Perjanjian
                                Beastudi</p>
                            <hr>
                            <p class="fs-4 text-gray">Pastikan calon mahasiswa baru memeriksa berkas dengan seksama dan
                                sesuai dengan aturan format yang diberikan.</p>
                            <p class="fs-4 text-gray">Pastikan sebelum mengunggah dokumen untuk:</p>
                                <ul class="unorder-list px-3 fs-4 text-gray">
                                    <li>Dokumen scan / pindai dengan baik dan jelas</li>
                                    <li>Dokumen di tanda tangan dengan posisi yang sudah sesuai dengan aturan dan
                                        menggunakan
                                        materai</li>
                                    <li>Pastikan nama dan program studi sesuai dengan pendaftaran di admisi.nurulfikri
                                    </li>

                                </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12 p-0">
            <div
                class="login-aside page-mhs d-flex flex-column flex-row-auto flex-row-fluidalign-items-center bg-white">
                <div id="sign-up" class="auth-form tab-pane fade show active form-validation">
                    <div class="p-2">
                        <livewire:create-camaba>
                    </div>
                </div>
                <footer class="mt-auto text-center">
                    <p class="fs-12 text-body">Beastudi sekolah tinggi teknologi terpadu nurul fikri @ 2018 - 2024</p>
                </footer>
            </div>
        </div>
    </div>
    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src=" vendor/global/global.min.js "></script>
    <script src="js/custom.min.js "></script>
    <script src="js/dlabnav-init.js "></script>
    <script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @livewireScripts

    <script>
        Livewire.on('resetProdi', () => {
            let selectProdi = document.getElementById('prodi');
            selectProdi.value = '';
            $(selectProdi).selectpicker('refresh');
        });

        Livewire.on('resetFileUpload', () => {
            let file = document.querySelectorAll('#file');
            file.forEach(file => {
                file.value = '';
            });
        });

        Livewire.on('alert', (title, message, type) => {
            Swal.fire(title, message, type);
        });
    </script>
</body>

</html>
