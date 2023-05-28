<fieldset class="border p-3 main">
    <legend class="w-auto px-3">Módulo de Perfiles</legend>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input parent" name="permission[]" id="" value="roles_access" @checked($role->hasPermissionTo('roles_access')) />
            Acceso a perfiles
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input child" name="permission[]" id="" value="roles_create" @checked($role->hasPermissionTo('roles_create')) />
            Crear perfiles
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input child" name="permission[]" id="" value="roles_edit" @checked($role->hasPermissionTo('roles_edit')) />
            Editar perfiles
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input child" name="permission[]" id="" value="roles_delete" @checked($role->hasPermissionTo('roles_delete')) />
            Eliminar perfiles
        </label>
    </div>
</fieldset>