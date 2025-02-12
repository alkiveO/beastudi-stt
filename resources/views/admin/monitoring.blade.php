@extends('layouts.app')

@section('title', 'Monitoring')

@section('title_dashboard', 'Monitoring')

@section('content')

<div class="container-fluid">
    <div class="col-xl-12">
        <livewire:admin.list-monitoring>
    </div>
</div>

@endsection
