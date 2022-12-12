<fieldset class="border p-3 main">
    <legend class="w-auto px-3">Módulo de productos</legend>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input parent" name="permission[]" id="" value="products_access" @checked($role->hasPermissionTo('products_access')) />
            Acceso a productos
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input child" name="permission[]" id="" value="products_create" @checked($role->hasPermissionTo('products_create')) />
            Crear productos
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input child" name="permission[]" id="" value="products_edit" @checked($role->hasPermissionTo('products_edit')) />
            Editar productos
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input child" name="permission[]" id="" value="products_delete" @checked($role->hasPermissionTo('products_delete')) />
            Eliminar productos
        </label>
    </div>
</fieldset>