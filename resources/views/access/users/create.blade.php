@extends('layouts.app')

@section('content-header')
    <div class="col-12">
        <h1 class="m-0">Alta de usuario nuevo</h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Formulario de creación de usuarios
                </div>
                <form action="{{ route('access.users.create') }}" method="POST">
                    @csrf 
                    <div class="card-body">
                        @include('access.users._form')
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" onclick="history.back();" class="btn btn-sm btn-default"><i class="fas fa-backward mr-2"></i>Atrás</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save mr-2"></i>Guardar usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
