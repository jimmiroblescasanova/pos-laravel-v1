<fieldset class="border p-3 main">
    <legend class="w-auto px-3">Módulo Grupos de Producto</legend>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input parent" name="permission[]" id="" value="groups_access" @checked($role->hasPermissionTo('groups_access')) />
            Acceso a grupos
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input child" name="permission[]" id="" value="groups_create" @checked($role->hasPermissionTo('groups_create')) />
            Crear grupos
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input child" name="permission[]" id="" value="groups_delete" @checked($role->hasPermissionTo('groups_delete')) />
            Eliminar grupos
        </label>
    </div>
</fieldset>