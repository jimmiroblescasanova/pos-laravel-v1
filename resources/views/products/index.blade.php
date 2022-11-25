@extends('layouts.app')

@section('content-header')
    <h1 class="m-0">Productos</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @livewire('product.index-products')
        </div>
    </div>
@stop
