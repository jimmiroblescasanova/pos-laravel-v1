<div>
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">
                <i class="fas fa-user-edit mr-2"></i> Usuarios registrados
            </h3>
            @can('users_create')
            <div class="card-tools">
                <a href="{{ route('access.users.create') }}" class="btn btn-xs btn-primary"><i class="fas fa-pencil-alt mr-2"></i> Nuevo usuario</a>
            </div>
            @endcan
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        @can('users_edit')
                        <th style="width: 15%;" class="text-center"><i class="fas fa-cogs"></i></th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td scope="row">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->getRoleNames() as $id => $roles)
                                    {{ $roles }}
                                @endforeach
                            </td>
                            @can('users_edit')
                            <td class="text-right">
                                <a href="{{ route('access.users.edit', $user) }}" class="btn btn-xs btn-default"><i class="fas fa-edit mr-2"></i>Editar</a>
                            </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>
</div>
