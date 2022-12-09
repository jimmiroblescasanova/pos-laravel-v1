<div>
    <div class="card">
        <div class="card-header">
            Empresa
        </div>
        <x-form wire:submit.prevent="save" enctype="multipart/form-data">
            <div class="card-body">
                @wire('lazy')
                    <x-form-input name="name" label="Nombre de la empresa" />
                    <x-form-input name="address" label="Direccion de la empresa" />
                @endwire
                <div class="form-group">
                    <label for="logo">Selecciona una imagen de logo</label>
                    <input type="file" wire:model.defer="logo" class="form-control-file @error('logo') is-invalid @enderror" id="logo">
                    <span class="text-muted text-sm">Tamaño máximo: 100 kb, 250px</span>
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
