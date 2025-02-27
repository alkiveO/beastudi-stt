@extends('layouts.app')

@section('title', 'Dashboard')

@section('title_dashboard', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                {{-- <div class="row">
                    <h3 class="mt-2 mb-3 text-black">Data Mahasiswa Beastudi Aktif</h3>
                    <div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-4">
                        <div class="widget-stat card bg-default">
                            <div class="card-body  p-4">
                                <div class="media">
                                    <div class="media-body text-white">
                                        <span class="me-3">
                                            <a href="index.html" class="brand-logo">
                                                <img src="{{ asset('images/logo/mhs2.svg') }}" width="50">
                                            </a>
                                        </span>
                                        <p class="mb-0 text-white">Mahasiswa</p>
                                        <p class="mb-0 text-white">Beastudi Aktif</p>
                                    </div>
                                    <div class="media-body text-end">
                                        <h1 class="text-white">{{ $countAktif }}</h1>
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
                                                <img src="{{ asset('images/logo/mhs3.svg') }}" width="50">
                                            </a>
                                        </span>
                                        <p class="mb-0 text-white">Mahasiswa Beastudi</p>
                                        <p class="mb-0 text-white">Tidak Aktif</p>
                                    </div>
                                    <div class="media-body text-end">
                                        <h1 class="text-white">{{ $countTidakAktif }}</h1>
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
                                                <img src="{{ asset('images/logo/mhs1.svg') }}" width="50">
                                            </a>
                                        </span>
                                        <p class="mb-0 text-white">Mahasiswa</p>
                                        <p class="mb-0 text-white">Beastudi Keluar</p>
                                    </div>
                                    <div class="media-body text-end">
                                        <h1 class="text-white">{{ $countKeluar }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="row">
                    @livewire('monitoring-filter')
                </div>

                <div class="row">
                    <div class="col-md-6">
                        @livewire('monitoring-status-chart')
                    </div>
                    <div class="col-md-6">
                        @livewire('program-studi-chart')
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        @livewire('monitoring-chart')
                    </div>
                    <div class="col-md-6">
                        @livewire('prestasi-chart')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
