@extends('layouts.app')

@section('content-header')
    <div class="col-6">
        <h1 class="m-0">Productos</h1>
    </div>
    <div class="col-6">
        <div class="btn-group float-right" role="group">
            <a href="{{ route('products.create') }}" class="btn btn-default">+ Producto</a>
    
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">
                    + Opciones
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#downloadProducts">
                        <i class="fas fa-download mr-2"></i>
                        Descargar a CSV
                    </button>
                    <a class="dropdown-item" href="{{ route('products.import') }}">
                        <i class="fas fa-upload mr-2"></i>
                        Carga masiva
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @livewire('product.index-products')
        </div>
    </div>
    <!-- Modal download products -->
    @include('products._download')
@stop

@push('third_party_scripts')
    <script type="module">
        if (window.location.hash === '#create') {
            $('#downloadProducts').modal('show');
        }

        $('#downloadProducts').on('hide.bs.modal', function (){
            window.location.hash = '#';
        });
    </script>
@endpush