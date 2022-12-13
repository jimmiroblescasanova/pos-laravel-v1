@extends('layouts.app')

@section('content-header')
    <div class="col-12">
        <h1 class="m-0">Ventas</h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @livewire('sale.index-sales')
        </div>
    </div>
@stop

