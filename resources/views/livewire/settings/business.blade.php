<div>
    <div class="card">
        <div class="card-header">
            Empresa
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <x-form wire:submit.prevent="save" enctype="multipart/form-data">
            <div class="card-body">
                @wire('debounce.500ms')
                    <x-form-input name="name" label="Nombre de la empresa" />
                    <x-form-input name="address" label="Direccion de la empresa" />
                    <x-form-input name="admin_email" label="Correo de administrador" />
                @endwire
                <div class="form-group">
                    <label for="logo">Selecciona una imagen</label>
                    <input type="file" wire:model.defer="logo" class="form-control-file @error('logo') is-invalid @enderror" id="logo">
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer text-muted">
                <x-form-submit class="btn btn-sm btn-primary">Guardar datos empresa</x-form-submit>
            </div>
        </x-form>
    </div>
</div>
