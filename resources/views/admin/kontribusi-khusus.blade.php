@extends('layouts.app')

@section('title', 'Konstribusi Khusus')

@section('title_dashboard', 'Konstribusi Khusus')

@section('content')

<div class="container-fluid">
    <div class="col-xl-12">
        <livewire:admin.kontribusi-khusus.list-kontribusi-khusus>
    </div>
</div>

@endsection
