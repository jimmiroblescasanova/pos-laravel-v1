<fieldset class="border p-3 main">
    <legend class="w-auto px-3">Módulo de Ventas</legend>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input parent" name="permission[]" id="" value="sales_access" @checked($role->hasPermissionTo('sales_access')) />
            Acceso a ventas
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input child" name="permission[]" id="" value="sales_share" @checked($role->hasPermissionTo('sales_share')) />
            Enviar ventas correo
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input child" name="permission[]" id="" value="sales_cancel" @checked($role->hasPermissionTo('sales_cancel')) />
            Cancelar ventas
        </label>
    </div>
</fieldset>