@extends('layouts.app')

@section('content-header')
    <h1 class="m-0">Usuarios</h1>
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
