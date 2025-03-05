@extends('layouts.app')

@section('title', 'Dashboard')

@section('title_dashboard', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @livewire('monitoring-filter')
                </div>

                <div class="row mb-4">
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
