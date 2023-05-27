@extends('layouts.app')

@section('content-header')
    <div class="col-12">
        <h1 class="m-0">Modificar datos del usuario</h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulario de actualizacion de usuarios</h3>
                    <div class="card-tools">
                        @can('users_delete')
                        <form action="{{ route('access.users.destroy', $user) }}" method="POST" id="delete">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt mr-2"></i>Eliminar usuario</button>
                        </form>
                        @endcan
                    </div>
                </div>
                <form action="{{ route('access.users.update', $user) }}" method="POST">
                    @csrf 
                    @method('patch')
                    <div class="card-body">
                        @include('access.users._form')
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('access.index') }}" class="btn btn-sm btn-default"><i class="fas fa-backward mr-2"></i>Atrás</a>
                        @can('users_edit')
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-edit mr-2"></i>Actualizar datos</button>
                        @endcan
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('third_party_scripts')
    <script>
        const form = document.getElementById('delete');

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            if(confirm('¿Estas seguro de eliminar el usuario?')){
                form.submit();
            }
        });
    </script>
@endpush