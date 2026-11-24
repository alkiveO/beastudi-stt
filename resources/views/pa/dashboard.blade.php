@extends('layouts.app')

@section('title', 'Dashboard PA')

@section('title_dashboard', 'Dashboard')

@section('content')
    <div class="container-fluid">
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