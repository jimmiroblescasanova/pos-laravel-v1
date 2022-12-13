@extends('layouts.app')

@section('content-header')
    <div class="col-12">
        <h1 class="m-0">Productos / Crear producto nuevo</h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    Formulario de producto nuevo
                </div>
                <x-form :action="route('products.create')" enctype="multipart/form-data">
                    <div class="card-body">
                        @include('products._form')
                        <div class="form-group">
                            <label for="image">Seleccionar imagen del producto</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-default"><i class="fas fa-backward mr-2"></i>Atrás</a>
                        <x-form-submit class="btn btn-sm btn-primary">
                            <i class="fas fa-save mr-2"></i>Guardar producto
                        </x-form-submit>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@stop
