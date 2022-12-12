<fieldset class="border p-3 main">
    <legend class="w-auto px-3">Módulo de Inventarios</legend>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input parent" name="permission[]" id="" value="inventory_access" @checked($role->hasPermissionTo('inventory_access')) />
            Acceso a inventario
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input child" name="permission[]" id="" value="inventory_edit" @checked($role->hasPermissionTo('inventory_edit')) />
            Editar inventario
        </label>
    </div>
</fieldset>