@extends('layouts.app')

@section('content-header')
    <div class="col-6">
        <h1 class="m-0">Ticket</h1>
    </div>
    <div class="col-6 text-right">
        <a href="{{ route('orders.create') }}" class="btn btn-success">
            <i class="fas fa-store mr-2"></i>
            Regresar al Punto de Venta
        </a>
    </div>
@endsection

@section('content')
    <embed src="{{ asset('storage/'.$filePath) }}" style="width: 100%; height: 80vh;" frameborder="0">
@stop
