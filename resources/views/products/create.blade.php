@extends('layouts.app')

@section('content-header')
    <h1 class="m-0">Productos / Crear producto nuevo</h1>
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
                        <x-form-submit>
                            <i class="fas fa-pencil-alt mr-2"></i>Guardar producto
                        </x-form-submit>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@stop
