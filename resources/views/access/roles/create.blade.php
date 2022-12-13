@extends('layouts.app')

@section('content-header')
    <div class="col-12">
        <h1 class="m-0">Crear un perfil</h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Seleccionar permisos del perfil
                    </h3>
                </div>
                <form action="{{ route('access.roles.create') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <x-form-input name="name" label="Ingresar el nombre del perfil a crear">
                            @slot('prepend')
                            <i class="fas fa-id-card-alt"></i>
                            @endslot
                        </x-form-input>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4">
                                @include('access.roles._products')
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                @include('access.roles._users')
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                @include('access.roles._inventory')
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4">
                            @include('access.roles._pos')
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            @include('access.roles._configurations')
                        </div>
                        <div class="col-12 col-sm-6 col-md-4"></div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('access.index') }}" class="btn btn-sm btn-default"><i class="fas fa-backward mr-2"></i>Atrás</a>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save mr-2"></i>Crear perfil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('third_party_scripts')
    <script type="module">
        $(document).ready(function() {
            let countChecked = 0;
            // Funcion para activar el acceso cuando se marca una opcion
            $('.child').on('click', function() {
                console.log(this.checked);
                let fieldset = $(this).closest('fieldset');
                let parent = fieldset.find('.parent');

                if(this.checked) {
                    parent.prop('checked', true);
                }
            });
            // Impedir desmarcar el acceso
            $('.parent').click(function(evt){
                let fieldset = $(this).closest('fieldset');
                countChecked = fieldset.find(' input.child:checked').length;
                if (countChecked > 0) {    
                    evt.preventDefault();
                }
            });
        });
    </script>
@endpush