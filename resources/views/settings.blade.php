@extends('layouts.app')

@section('content-header')
    <h1 class="m-0">Configuraciones</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            @livewire('settings.business')
        </div>
    </div>
@stop
