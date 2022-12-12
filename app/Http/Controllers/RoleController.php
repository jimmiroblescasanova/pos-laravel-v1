<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
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
}
