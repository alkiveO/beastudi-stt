@extends('layouts.app')

@section('title', 'Periode')

@section('title_dashboard', 'Periode')

@section('content')

<div class="container-fluid">
    <div class="col-xl-12">
        <livewire:admin.periode.list-periode>
    </div>
</div>

@endsection
