@extends('layouts.app')

@section('title', 'Manajemen Akun')

@section('title_dashboard', 'Manajemen Akun')

@section('content')

<div class="container-fluid">
    <div class="col-xl-12">
        <livewire:admin.list-manajemen-akun>
    </div>
</div>

@endsection
