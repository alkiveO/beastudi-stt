@extends('layouts.app')

@section('title', 'Maba')

@section('content')

<div class="container-fluid">
    <div class="col-xl-12">
        <livewire:mahasiswa.create-maba>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <livewire:mahasiswa.list-maba>
        </div>
    </div>
</div>

@endsection
