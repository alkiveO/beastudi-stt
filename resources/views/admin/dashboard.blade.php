@extends('layouts.app')

@section('title', 'Dashboard')

@section('title_dashboard', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
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
                </div>

                <div class="row">
                    <h3 class="mt-2 mb-3 text-black">Mahasiswa Beastudi Tiap angkatan</h3>
                    {{-- <div class="input-group search-area ms-3 mb-3">
                    <span class="input-group-text">
                        <svg width="15" height="15" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.5605 15.4395L13.7527 11.6317C14.5395 10.446 15 9.02625 15 7.5C15 3.3645 11.6355 0 7.5 0C3.3645 0 0 3.3645 0 7.5C0 11.6355 3.3645 15 7.5 15C9.02625 15 10.446 14.5395 11.6317 13.7527L15.4395 17.5605C16.0245 18.1462 16.9755 18.1462 17.5605 17.5605C18.1462 16.9747 18.1462 16.0252 17.5605 15.4395V15.4395ZM2.25 7.5C2.25 4.605 4.605 2.25 7.5 2.25C10.395 2.25 12.75 4.605 12.75 7.5C12.75 10.395 10.395 12.75 7.5 12.75C4.605 12.75 2.25 10.395 2.25 7.5V7.5Z" fill="#01A3FF"/>
                        </svg>
                    </span>
                    <input type="text" class="form-control" placeholder="Pilih Angkatan">
                </div> --}}

                    <div class="col-xl-12 col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

<script>
    (function($) {
        "use strict";
        var dzSparkLine = function() {
            var barChart = function() {
                if (document.getElementById('barChart')) {
                    const ctx = document.getElementById('barChart').getContext('2d');
                    ctx.height = 100;

                    // Convert PHP data to JavaScript object
                    const dataFromPHP = @json($data);

                    // Extract years
                    const years = Object.keys(dataFromPHP);

                    // Prepare data for each dataset
                    const sistemInformasiData = years.map(year => 
                        dataFromPHP[year]['sistem informasi'] || 0
                    );
                    const teknikInformatikaData = years.map(year => 
                        dataFromPHP[year]['teknik informatika'] || 0
                    );
                    const bisnisDigitalData = years.map(year => 
                        dataFromPHP[year]['bisnis digital'] || 0
                    );

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: years,
                            datasets: [
                                {
                                    label: "Sistem Informasi",
                                    data: sistemInformasiData,
                                    borderColor: 'rgb(238, 137, 18)',
                                    borderWidth: 1,
                                    backgroundColor: 'rgb(238, 137, 18)',
                                },
                                {
                                    label: "Teknik Informatika",
                                    data: teknikInformatikaData,
                                    borderColor: 'rgba(77, 68, 181, 1)',
                                    borderWidth: 1,
                                    backgroundColor: 'rgba(77, 68, 181, 1)',
                                },
                                {
                                    label: "Bisnis Digital",
                                    data: bisnisDigitalData,
                                    borderColor: 'rgb(238, 57, 18)',
                                    borderWidth: 1,
                                    backgroundColor: 'rgb(238, 57, 18)',
                                }
                            ]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                            },
                            scales: {
                                y: {
                                    beginAtZero: true, // Ensure the scale starts at zero
                                    max: 100, // Force y-axis to go up to 100
                                    ticks: {
                                        stepSize: 10 // Ensure y-axis increments by 10
                                    }
                                },
                                x: {
                                    barPercentage: 0.7, // Control width of bars
                                    categoryPercentage: 0.5 // Space between bars in the same group
                                }
                            }
                        }
                    });
                }
            };

            barChart();
        }();
    })(jQuery);
</script>
@endpush
