<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(): View
    {
        return view('access.roles.create', [
            'role' => new Role(),
        ]);
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permission);

        notyf()
            ->ripple(true)
            ->duration(2000)
            ->addSuccess('Perfil creado exitosamente');

        return redirect()->route('access.index');
    }

    public function edit(Role $role): View
    {
        return view('access.roles.edit', [
            'role' => $role,
        ]);
    }

    public function update(Role $role, Request $request)
    {
        $role->syncPermissions($request->permission);

        notyf()
            ->ripple(true)
            ->duration(2000)
            ->addSuccess('Permisos actualizados');

        return redirect()->route('access.index');
    }

    public function destroy(Role $role)
    {
        $users_with_roles = User::role($role->name)->count();

        if ($users_with_roles >=1) {
            notyf()
                ->ripple(true)
                ->duration(2000)
                ->addWarning('No se puede eliminar el perfil');

            return back();
        }

        $role->delete();

        notyf()
            ->ripple(true)
            ->duration(2000)
            ->addSuccess('Perfil eliminado con éxito');

        return redirect()->route('access.index');
    }
}
