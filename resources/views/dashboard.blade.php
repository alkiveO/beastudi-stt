@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Row -->
    <div class="row">
        <h2 class="mt-2 mb-3">Data Mahasiswa Beastudi Aktif</h2>
        <div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-4">
            <div class="widget-stat card bg-default">
                <div class="card-body  p-4">
                    <div class="media">
                        <div class="media-body text-white">
                            <span class="me-3">
                                <a href="index.html" class="brand-logo">
                                    <img src="images/logo/mhs2.svg" width="50">
                                </a>
                            </span>
                            <p class="mb-0 text-white">Mahasiswa</p>
                            <p class="mb-0 text-white">Beastudi Aktif</p>
                        </div>
                        <div class="media-body text-end">
                            <h1 class="text-white">4512</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-4">
            <div class="widget-stat card bg-default">
                <div class="card-body  p-4">
                    <div class="media">
                        <div class="media-body text-white">
                            <span class="me-3">
                                <a href="index.html" class="brand-logo">
                                    <img src="images/logo/mhs1.svg" width="50">
                                </a>
                            </span>
                            <p class="mb-0 text-white">Mahasiswa</p>
                            <p class="mb-0 text-white">Beastudi Keluar</p>
                        </div>
                        <div class="media-body text-end">
                            <h1 class="text-white">90</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-4">
            <div class="widget-stat card bg-default">
                <div class="card-body  p-4">
                    <div class="media">
                        <div class="media-body text-white">
                            <span class="me-3">
                                <a href="index.html" class="brand-logo">
                                    <img src="images/logo/mhs3.svg" width="50">
                                </a>
                            </span>
                            <p class="mb-0 text-white">Mahasiswa</p>
                            <p class="mb-0 text-white">Beastudi Keluar</p>
                        </div>
                        <div class="media-body text-end">
                            <h1 class="text-white">90</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
                    <h2 class="mt-2 mb-3">Mahasiswa Beastudi Tiap angkatan</h2>
                    <div class="col-xl-12 col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="barChart_1"></canvas>
                            </div>
                        </div>
                    </div>
                </div> --}}

    <div class="row">
        <h2 class="mt-2 mb-3">Mahasiswa Beastudi Tiap angkatan</h2>
        <div class="col-xl-2 col-xxl-2 col-sm-6">
            <div class="card counter">
                <div class="card-body d-flex align-items-center px-3 pt-3 pb-0">
                    <div class="chart-num">
                        <p class="text-black fs-4 lh-sm">
                            Mahasiswa Beastudi <b>2018</b>
                        </p>
                        <h1 class="mb-0 text-orange">415</h1>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-2 col-xxl-2 col-sm-6">
            <div class="card counter">
                <div class="card-body d-flex align-items-center px-3 pt-3 pb-0">
                    <div class="chart-num">
                        <p class="text-black fs-4 lh-sm">
                            Mahasiswa Beastudi <b>2019</b>
                        </p>
                        <h1 class="mb-0 text-orange">415</h1>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-2 col-xxl-2 col-sm-6">
            <div class="card counter">
                <div class="card-body d-flex align-items-center px-3 pt-3 pb-0">
                    <div class="chart-num">
                        <p class="text-black fs-4 lh-sm">
                            Mahasiswa Beastudi <b>2020</b>
                        </p>
                        <h1 class="mb-0 text-orange">415</h1>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-2 col-xxl-2 col-sm-6">
            <div class="card counter">
                <div class="card-body d-flex align-items-center px-3 pt-3 pb-0">
                    <div class="chart-num">
                        <p class="text-black fs-4 lh-sm">
                            Mahasiswa Beastudi <b>2021</b>
                        </p>
                        <h1 class="mb-0 text-orange">415</h1>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-2 col-xxl-2 col-sm-6">
            <div class="card counter">
                <div class="card-body d-flex align-items-center px-3 pt-3 pb-0">
                    <div class="chart-num">
                        <p class="text-black fs-4 lh-sm">
                            Mahasiswa Beastudi <b>2022</b>
                        </p>
                        <h1 class="mb-0 text-orange">415</h1>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-2 col-xxl-2 col-sm-6">
            <div class="card counter">
                <div class="card-body d-flex align-items-center px-3 pt-3 pb-0">
                    <div class="chart-num">
                        <p class="text-black fs-4 lh-sm">
                            Mahasiswa Beastudi <b>2023</b>
                        </p>
                        <h1 class="mb-0 text-orange">415</h1>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <h2 class="mt-2 mb-3">PIC Kontribusi</h2>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="card counter">
                <div class="row g-0">
                    <div class="col-10">
                        <div class="p-3 d-flex align-items-center bg-default bg-default-radius">
                            <div class="chart-num">
                                <p class="text-white fs-4 ">
                                    Kemahasiswaan
                                </p>
                                <p class="mb-0 mt-3 fs-3 fw-bold text-white ">Dalias., S.IP</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card bg-orange h-100 border-0">
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <!-- Content for the second "merged" part goes here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="card counter">
                <div class="row g-0">
                    <div class="col-10">
                        <div class="p-3 d-flex align-items-center bg-default bg-default-radius">
                            <div class="chart-num">
                                <p class="text-white fs-4 ">
                                    Waket 3
                                </p>
                                <p class="mb-0 mt-3 fs-3 fw-bold text-white ">M. Teguh P</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card bg-orange h-100 border-0">
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <!-- Content for the second "merged" part goes here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="card counter">
                <div class="row g-0">
                    <div class="col-10">
                        <div class="p-3 d-flex align-items-center bg-default bg-default-radius">
                            <div class="chart-num">
                                <p class="text-white fs-4 ">
                                    LPPM
                                </p>
                                <p class="mb-0 mt-3 fs-3 fw-bold text-white ">M. Syaiful R</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card bg-orange h-100 border-0">
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <!-- Content for the second "merged" part goes here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="card counter">
                <div class="row g-0">
                    <div class="col-10">
                        <div class="p-3 d-flex align-items-center bg-default bg-default-radius">
                            <div class="chart-num">
                                <p class="text-white fs-4 ">
                                    Waket 3
                                </p>
                                <p class="mb-0 mt-3 fs-3 fw-bold text-white ">Ricta N. Yuliana</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card bg-orange h-100 border-0">
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <!-- Content for the second "merged" part goes here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
