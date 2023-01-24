<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(): View
    {
        $roles = Role::pluck('name');

        return view('access.users.create', [
            'user' => new User(),
            'roles' => $roles,
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validated();
            $validated['password'] = Hash::make($validated['password']);
            $user = User::create($validated);
            $user->assignRole($request->role);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, $e->getMessage());
        }

        notyf()
            ->ripple(true)
            ->duration(2000)
            ->addSuccess('Usuario creado exitosamente');

        return redirect()->route('access.index');
    }

    public function edit(User $user): View
    {
        $roles = Role::pluck('name');

        return view('access.users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        try {
            DB::beginTransaction();
            if ($request->password === null) {
                $user->update($request->safe()->except('password'));
            } else {
                $validated = $request->validated();
                $validated['password'] = Hash::make($validated['password']);
                $user->update($validated);
            }
            
            $user->syncRoles($request->role);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, $e->getMessage());
        }

        notyf()
            ->ripple(true)
            ->duration(2000)
            ->addSuccess('Usuario actualizado exitosamente');

        return redirect()->route('access.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        notyf()
            ->ripple(true)
            ->duration(2000)
            ->addSuccess('Usuario eliminado exitosamente');

        return redirect()->route('access.index');
    }
}
