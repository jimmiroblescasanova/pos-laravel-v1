@extends('layouts.app')

@section('content-header')
    <h1 class="m-0">Usuarios</h1>
@endsection

@section('content')
    <div class="container-fluid">
        @livewire('user.index-users')
    </div>
@stop