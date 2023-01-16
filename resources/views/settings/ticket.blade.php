@extends('layouts.app')

@section('content-header')
    <div class="col-12">
        <h1 class="m-0">Configuraciones</h1>
    </div>
@endsection

@section('content')
    @livewire('settings.ticket-configuration')
@stop
