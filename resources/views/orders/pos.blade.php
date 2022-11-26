@extends('layouts.app')

@section('content-header')
    <h1 class="m-0">Punto de Venta</h1>
@endsection

@section('content')
    @livewire('order.create-order')
@stop
