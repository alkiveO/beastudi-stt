@extends('layouts.app')

@section('title', 'SPB Monitoring')

@section('content')

<div class="container-fluid">
    <div class="col-xl-12">
        <livewire:mahasiswa.create-monitoring>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <livewire:mahasiswa.list-monitoring>
        </div>
    </div>
</div>

@endsection
