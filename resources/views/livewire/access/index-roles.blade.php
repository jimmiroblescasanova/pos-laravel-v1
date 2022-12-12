<div>
    <div class="card">
        <div class="card-header">
            Header
        </div>
        <div class="card-body p-0">
            <table class="table">
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