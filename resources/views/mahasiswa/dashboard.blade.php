@extends('layouts.app')

@section('title', 'Dashboard')

@section('title_dashboard', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="col-xl-12">
            <div class="card">
                <div class="px-4 pt-4">
                    <div class="alert alert-{{ $alertType }} alert-dismissible alert-alt solid fade show fs-5">
                        {{ $StatusForm }}
                    </div>
                </div>
                <div class="px-4 pb-4">
                    <h3 class="mb-3">Informasi Mahasiswa</h3>
                    <p class="fs-4 text-black">Status Mahasiswa: {{ $StatusMHS }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
