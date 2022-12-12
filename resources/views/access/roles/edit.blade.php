@extends('layouts.app')

@section('content-header')
    <h1 class="m-0">Usuarios</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Seleccionar permisos del perfil: {{ Str::upper($role->name) }}
                </div>
                <form action="{{ route('roles.update', $role) }}" method="POST">
                    @csrf
                    <div class="card-body">
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
                    <div class="card-footer text-muted">
                        <button type="submit" class="btn btn-primary btn-sm">Actualizar permisos</button>
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