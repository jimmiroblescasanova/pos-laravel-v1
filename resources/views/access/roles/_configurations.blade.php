<fieldset class="border p-3 main">
    <legend class="w-auto px-3">Configuracion de Empresa</legend>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input parent" name="permission[]" id="" value="configurations_access" @checked($role->hasPermissionTo('configurations_access')) />
            Acceso a configuraciones
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input child" name="permission[]" id="" value="company_edit" @checked($role->hasPermissionTo('company_edit')) />
            Editar Empresa
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input child" name="permission[]" id="" value="ticket_edit" @checked($role->hasPermissionTo('ticket_edit')) />
            Editar Ticket
        </label>
    </div>
</fieldset>