@extends('layouts.app')

@section('title', 'Dashboard PA')

@section('title_dashboard', 'Dashboard')

@section('content')
    <div class="container-fluid">

        {{-- INFORMASI PEMBIMBING AKADEMIK --}}
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="mb-2">Dashboard</h4>

                <h5 class="text-primary mb-1">
                    {{ auth()->user()->pembimbingAkademik->nama ?? auth()->user()->name }}
                </h5>

                <p class="mb-0 text-muted">
                    Pembimbing Akademik
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                {{-- FILTER --}}
                <div class="row">
                    @livewire('pa.monitoring-filter')
                </div>

                {{-- CHART STATUS & PROGRAM STUDI --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        @livewire('pa.monitoring-status-chart')
                    </div>

                    <div class="col-md-6">
                        @livewire('pa.program-studi-chart')
                    </div>
                </div>

                {{-- CHART IPK / PRESTASI --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        @livewire('pa.monitoring-chart')
                    </div>

                    <div class="col-md-6">
                        @livewire('pa.prestasi-chart')
                    </div>
                </div>

                {{-- CHART JALUR BEASISWA & EVALUASI --}}
                <div class="row">
                    <div class="col-md-6">
                        @livewire('pa.jalur-beastudi-chart')
                    </div>

                    <div class="col-md-6">
                        @livewire('pa.evaluasi-chart')
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
