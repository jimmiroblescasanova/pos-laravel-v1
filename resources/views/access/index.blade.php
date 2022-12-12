@extends('layouts.app')

@section('content-header')
    <div class="col-12">
        <h1 class="m-0">Configuracion de Accesos</h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-7">
            @livewire('access.index-users')
        </div>
        <div class="col-5">
            @livewire('access.index-roles')
        </div>
    </div>
@stop
