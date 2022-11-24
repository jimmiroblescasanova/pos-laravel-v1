@extends('layouts.app')

@section('content-header')
    <h1 class="m-0">Productos</h1>
@endsection

@section('content')
    <div class="container-fluid">
        @livewire('product.index-products')
    </div>
@stop