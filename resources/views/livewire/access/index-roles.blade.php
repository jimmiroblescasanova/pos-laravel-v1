<div>
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">
                <i class="fas fa-id-card-alt mr-2"></i>Listado de tipos de perfil
            </h3>
            <div class="card-tools">
                <a href="{{ route('access.roles.create') }}" class="btn btn-xs btn-primary"><i class="fas fa-pencil-alt mr-2"></i>Crear un perfil</a>
            </div>
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Nombre del perfil</th>
                        <th style="width: 25%;" class="text-center"><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td scope="row">{{ $role->name }}</td>
                        <td class="text-right">
                            @if ($role->id > 1)
                            <a href="{{ route('access.roles.edit', $role) }}" class="btn btn-xs btn-default">
                                <i class="fas fa-edit mr-2"></i>
                                Editar
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $roles->links() }}
        </div>
    </div>
</div>