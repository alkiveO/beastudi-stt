@extends('layouts.app')

@section('title', 'Jalur Beastudi')

@section('title_dashboard', 'Jalur Beastudi')

@section('content')

<div class="container-fluid">
    <div class="col-xl-12">
        <livewire:admin.jalur-beastudi.list-jalur-beastudi>
    </div>
</div>

@endsection
