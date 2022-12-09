@extends('layouts.app')

@section('content-header')
    <h1 class="m-0">Productos / Editar producto</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <span>Formulario de producto nuevo</span>
                        <form action="{{ route('products.destroy', $product) }}" id="deleteForm" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" id="delete" class="btn btn-danger btn-xs">
                                <i class="fas fa-trash-alt mr-2"></i>Eliminar producto
                            </button>
                        </form>
                    </div>
                </div>
                <x-form :action="route('products.update', $product)" enctype="multipart/form-data" method="POST">
                    <div class="card-body">
                        @method('patch')
                        @include('products._form')
                        <div class="row form-group">
                            <div class="col-sm-6">
                                <label for="image">Actualizar imagen del producto</label>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ $product->getFirstMediaUrl('product', 'small') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" onclick="history.back();" class="btn btn-default"><i class="fas fa-backward mr-2"></i>Atrás</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt mr-2"></i>Actualizar producto</button>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@stop

@push('third_party_scripts')
    <script>
        const deleteBtn = document.getElementById('delete');
        const deleteForm = document.getElementById('deleteForm');

        deleteBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (confirm('¿Estas seguro?')) {
                deleteForm.submit();
            }
        });
    </script>
@endpush
