@extends('layouts.app')

@section('title', 'SPB MOU')

@section('content')

<div class="container-fluid">
    <div class="col-xl-12">
        <livewire:mahasiswa.create-mou>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <livewire:mahasiswa.list-mou>
        </div>
    </div>
</div>

@endsection
