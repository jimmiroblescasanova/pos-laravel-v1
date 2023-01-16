@extends('layouts.app')

@section('content-header')
    <div class="col-12">
        <h1 class="m-0">Reporte: Ventas del día</h1>
    </div>
@endsection

@section('content')
    @livewire('reports.daily-sales')
@stop