@extends('layouts.app')

@section('content-header')
    <div class="col-12">
        <h1 class="m-0">Configuracion de Grupos</h1>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            Grupos de productos
        </div>
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $id => $group)
                    <tr>
                        <td scope="row">{{ $group }}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            Footer
        </div>
    </div>
@stop

@push('third_party_scripts')
    
@endpush