@extends('layouts.app')

@section('content')
    @livewire('pa.show-monitoring', ['nim' => $nim])
@endsection