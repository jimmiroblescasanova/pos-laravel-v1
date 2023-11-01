@extends('layouts.app')

@section('content-header')
    <div class="col-6">
        <h1 class="m-0">Configuracion de Grupos</h1>
    </div>
    <div class="col-6">
        @can('groups_create')
        <button type="button" class="btn btn-default float-right" data-toggle="modal" data-target="#createGroup">
            <i class="fas fa-pencil-alt mr-2"></i>Crear grupo
        </button>
        @endcan
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            Grupos de productos
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        @can('groups_delete')
                        <th>Eliminar</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($groups as $group)
                    <tr>
                        <td scope="row">{{ $group->name }}</td>
                        @can('groups_delete')
                        <td>
                            <button type="button" class="btn btn-danger btn-xs btn-delete float-right" data-toggle="modal" data-group="{{ $group->id }}" data-target="#deleteGroup">
                                <i class="fas fa-trash-alt mr-2"></i>Eliminar
                            </button>
                        </td>
                        @endcan
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2">la tabla esta vacía</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            {{ $groups->links() }}
        </div>
    </div>
    
    <!-- Modal crear group-->
    <div class="modal fade" id="createGroup" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo grupo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form action="{{ route('settings.groups.store') }}" method="POST">
                    @csrf 
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nombre del grupo:</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal eliminar group -->
    <div class="modal fade" id="deleteGroup" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">¿Eliminar?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <p>* Todos los productos con este grupo, quedarán en (Ninguno).</p>
                    <p class="text-danger">* Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('settings.groups.destroy') }}" method="POST">
                        @csrf 
                        @method('DELETE')
                        <input type="hidden" name="id" id="deleteGroupInput" value="">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No, cancelar</button>
                        <button type="submit" class="btn btn-danger">SI, eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('third_party_scripts')
    <script type="module">
        $('#createGroup').on('shown.bs.modal', function () {
            $('#name').trigger('focus');
        });

        $('#createGroup').on('hidden.bs.modal', function () {
            $('#name').val("");
        });

        $('.btn-delete').on('click', function() {
            let group = $(this).data('group');
            $('#deleteGroupInput').val(group);
        });
    </script>
@endpush