<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="STT Terpadu Nurul Fikri">
    <meta name="robots" content="">
    <meta name="keywords" content="stt terpadu nurul fikri, kampus nurul fikri, universitas nurul fikri, teknik informatika nurul fikri, sistem informasi nurul fikri, bisnis digital nurul, mahasiswa beastudi, mahasiswa berprestasi">
    <meta name="description" content="Beastudi STT Terpadu Nurul Fikr - program beasiswa yang mendukung pengembangan akademis dan profesional mahasiswa dengan memberikan pelatihan keterampilan, serta pembinaan karakter untuk mencetak lulusan unggul dan berintegritas.">
    <meta property="og:title" content="Beastudi STT Terpadu Nurul Fikri">
    <meta property="og:description" content="Beastudi STT Terpadu Nurul Fikri - program beasiswa yang mendukung pengembangan akademis dan profesional mahasiswa dengan memberikan pelatihan keterampilan, serta pembinaan karakter untuk mencetak lulusan unggul dan berintegritas.">
    <meta property="og:image" content="https://nurulfikri.ac.id/wp-content/uploads/slider/cache/b9cdbba1a0e7c5c45cc35ca06eaebf93/Banner-Web-1-scaled.webp">

    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Page Title Here -->
    <title>Beastudi STT Terpadu Nurul Fikri | @yield('title')</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link href="{{ asset('vendor/wow-master/css/libs/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-select-country/css/bootstrap-select-country.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/jquery-nice-select/css/nice-select.css') }}">
    <link href="{{ asset('vendor/datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <!--swiper-slider-->
    <link rel="stylesheet" href="{{ asset('vendor/swiper/css/swiper-bundle.min.css') }}">
    <!-- Style css -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custome.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

    @livewireStyles

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

        textarea.monitoring {
            height: 250px !important;
        }
        .loader2 {
            width: 30px;
            aspect-ratio: 3;
            background: radial-gradient(circle closest-side,#000 90%,#0000) 0/calc(100%/3) 100% space;
            clip-path: inset(0 100% 0 0);
            animation: l1 1s steps(4) infinite;
        }
        @keyframes l1 {to{clip-path: inset(0 -34% 0 0)}}
    </style>

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <div class="dots">
                <div class="dot mainDot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>

        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        @include('_navbar')
        <!--**********************************
            Nav header end
        ***********************************-->
        <!--**********************************
            Header start
        ***********************************-->
        @include('_header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->

        @include('_sidebar')

        <!--**********************************
            Sidebar end
        ***********************************-->

        <div class="content-body">
            @yield('content')
        </div>
    </div>

    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }} "></script>
    <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }} "></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }} "></script>
    <!-- Apex Chart -->
    <script src="{{ asset('vendor/apexchart/apexchart.js') }} "></script>
    <!-- Chart piety plugin files -->
    <script src="{{ asset('vendor/peity/jquery.peity.min.js') }} "></script>
    <script src="{{ asset('vendor/jquery-nice-select/js/jquery.nice-select.min.js') }} "></script>
    <!--swiper-slider-->
    <script src="{{ asset('vendor/swiper/js/swiper-bundle.min.js') }} "></script>


    <!-- Datatable -->
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }} "></script>

    <!-- Dashboard 1 -->
    {{-- <script src="{{ asset('js/dashboard/dashboard-1.js') }} "></script> --}}
    <script src="{{ asset('vendor/wow-master/dist/wow.min.js') }} "></script>
    <script src="{{ asset('vendor/bootstrap-datetimepicker/js/moment.js') }} "></script>
    <script src="{{ asset('vendor/datepicker/js/bootstrap-datepicker.min.js') }} "></script>
    <script src="{{ asset('vendor/bootstrap-select-country/js/bootstrap-select-country.min.js') }} "></script>

    <script src="{{ asset('js/dlabnav-init.js') }} "></script>
    <script src="{{ asset('js/custom.min.js') }} "></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Chart ChartJS plugin files -->
    {{-- <script src="{{ asset('js/plugins-init/chartjs-init.js') }}"></script> --}}

    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('setProdi', (prodi_id) => {
                let selectProdi = document.getElementById('edit-prodi');
                selectProdi.value = prodi_id;
                $(selectProdi).selectpicker('refresh');
            });

            Livewire.on('setJalurPrestasi', (jalur_prestasi_id) => {
                let selectJalurPrestasi = document.getElementById('edit-jalur-prestasi');
                selectJalurPrestasi.value = jalur_prestasi_id;
                $(selectJalurPrestasi).selectpicker('refresh');
            });

            Livewire.on('resetBootstrapSelect', () => {
                let selects = document.querySelectorAll('#bootstrap-select');
                selects.forEach(select => {
                    select.value = '';
                    $(select).selectpicker('refresh');
                });
            });

            Livewire.on('resetFileUpload', () => {
                let file = document.querySelectorAll('#file');
                file.forEach(file => {
                    file.value = '';
                });
            });

             Livewire.on('redirectToMasterData', () => {
        setTimeout(() => {
            window.location.href = "{{ route('admin.master-data') }}";
        }, 1500); // kasih jeda biar alert kelihatan
    });

            Livewire.on('alert', (title, messages, type) => {
                 if (Array.isArray(messages)) {
                    messages = messages.map(msg => `<li class=text-danger>${msg}</li>`).join('');
                    messages = `<ul style="text-align: left;">${messages}</ul>`;
                }

                 Swal.fire({
                    title: title,
                    html: messages, // Menggunakan `html` agar format list berfungsi
                    icon: type
                });
            });
        });
    </script>

    @livewireScripts

    @stack('script')
</body>

</html>
