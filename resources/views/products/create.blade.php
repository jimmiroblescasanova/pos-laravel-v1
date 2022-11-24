@extends('layouts.app')

@section('content-header')
    <h1 class="m-0">Productos / Crear producto nuevo</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Formulario de producto nuevo
            </div>
            <div class="card-body">
                <x-form :action="route('products.create')" enctype="multipart/form-data">
                    <x-form-input name="barcode" label="Codigo de barras">
                        @slot('prepend')
                            <i class="fas fa-barcode"></i>
                        @endslot
                    </x-form-input>
                    <x-form-input name="name" label="Nombre del producto">
                        @slot('prepend')
                            <i class="fas fa-boxes"></i>
                        @endslot
                    </x-form-input>
                    <x-form-input name="supplier_code" label="Codigo del proveedor"></x-form-input>
                    <x-form-input name="cost" label="Costo de compra"></x-form-input>
                    <x-form-input name="price" label="Precio de venta (neto)"></x-form-input>
                    <x-form-input name="inventory" label="Inventario actual"></x-form-input>
                    <x-form-input name="minimum" label="Cant. minima en almacen"></x-form-input>
                    <x-form-select name="status" label="Estado">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </x-form-select>
                    <x-form-textarea name="description" label="Descripcion larga del producto"></x-form-textarea>
                    <input type="file" name="image" id="image">
                    <x-form-submit />
                </x-form>
            </div>
            <div class="card-footer text-muted">
                Footer
            </div>
        </div>
    </div>
@stop
