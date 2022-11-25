@extends('layouts.app')

@section('content-header')
    <h1 class="m-0">Usuarios</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @livewire('user.index-users')
        </div>
    </div>
@stop
