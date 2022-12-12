<fieldset class="border p-3 main">
    <legend class="w-auto px-3">Módulo de Usuarios</legend>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input parent" name="permission[]" id="" value="users_access" @checked($role->hasPermissionTo('users_access')) />
            Acceso a usuarios
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input child" name="permission[]" id="" value="users_create" @checked($role->hasPermissionTo('users_create')) />
            Crear usuarios
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input child" name="permission[]" id="" value="users_edit" @checked($role->hasPermissionTo('users_edit')) />
            Editar usuarios
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input child" name="permission[]" id="" value="users_delete" @checked($role->hasPermissionTo('users_delete')) />
            Eliminar usuarios
        </label>
    </div>
</fieldset>