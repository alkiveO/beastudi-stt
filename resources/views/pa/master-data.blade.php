@extends('layouts.app')

@section('title', 'Master Data')

@section('title_dashboard', 'Master Data')

@section('content')

<div class="container-fluid">
    <div class="col-xl-12">
        <livewire:pa.list-master-data>
    </div>
</div>

@endsection