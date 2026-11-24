@extends('layouts.app')

@section('content')
    @livewire('pa.show-master-data', ['mhs_id' => $mhs_id])
@endsection
