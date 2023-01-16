@extends('layouts.app')

@section('content-header')
    <div class="col-12">
        <h1 class="m-0">Reporte: Ventas por producto</h1>
    </div>
@endsection

@section('content')
    @livewire('reports.product-sales')
@stop