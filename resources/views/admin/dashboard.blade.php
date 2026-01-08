@extends('layouts.app')

@section('title', 'Dashboard')

@section('title_dashboard', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                {{-- FILTER --}}
                <div class="row">
                    @livewire('monitoring-filter')
                </div>

                {{-- CHART STATUS & PROGRAM STUDI --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        @livewire('monitoring-status-chart')
                    </div>
                    <div class="col-md-6">
                        @livewire('program-studi-chart')
                    </div>
                </div>

                {{-- CHART IPK / PRESTASI --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        @livewire('monitoring-chart')
                    </div>
                    <div class="col-md-6">
                        @livewire('prestasi-chart')
                    </div>
                </div>

                {{-- CHART JALUR BEASISWA --}}
                <div class="row">
                    <div class="col-md-6">
                        @livewire('jalur-beastudi-chart')
                    </div>
                     <div class="col-md-6">
        @livewire('admin.evaluasi-chart')
    </div>
                </div>

              

            </div>
        </div>
    </div>
@endsection
