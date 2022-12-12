<fieldset class="border p-3 main">
    <legend class="w-auto px-3">Punto de Venta</legend>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input parent" name="permission[]" id="" value="pos_access" @checked($role->hasPermissionTo('pos_access')) />
            Acceso al Punto de Venta
        </label>
    </div>
</fieldset>