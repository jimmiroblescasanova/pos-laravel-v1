@bind($product)
    <div class="row form-group">
        <div class="col-sm-3">
            <x-form-input name="barcode" label="Codigo de barras">
                @slot('prepend')
                    <i class="fas fa-barcode"></i>
                @endslot
            </x-form-input>
        </div>
        <div class="col-sm-9">
            <x-form-input name="name" label="Nombre del producto">
                @slot('prepend')
                    <i class="fas fa-boxes"></i>
                @endslot
            </x-form-input>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-3">
            <x-form-input name="supplier_code" label="Codigo del proveedor">
                @slot('prepend')
                    <i class="fas fa-barcode"></i>
                @endslot
            </x-form-input>
        </div>
        <div class="col-sm-3">
            <x-form-input type="number" step="0.01" name="cost" label="Costo de compra">
                @slot('prepend')
                    <i class="fas fa-coins"></i>
                @endslot
            </x-form-input>
        </div>
        <div class="col-sm-3">
            <x-form-input type="number" step="0.01" name="price" label="Precio de venta (neto)">
                @slot('prepend')
                    <i class="fas fa-coins"></i>
                @endslot
            </x-form-input>
        </div>
        <div class="col-sm-3">
            <x-form-select name="active" label="Estado">
                <option value="1" @selected($product->active == 1)>Activo</option>
                <option value="0" @selected($product->active == 0)>Inactivo</option>
            </x-form-select>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="group">Grupo</label>
                <select 
                    name="group_id"
                    class="form-control select2 @error('group_id') is-invalid @enderror">
                    <option value="">(Ninguno)</option>
                    @foreach ($groups as $id => $group)
                    <option value="{{ $id }}" @selected($product->group_id == $id)>{{ $group }}</option>
                    @endforeach
                </select>
                @error('group_id')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <x-form-textarea name="description" label="Descripcion larga del producto"></x-form-textarea>
@endbind


@push('third_party_scripts')
    <script type="module">
        $(document).ready(function () {
            $('.select2').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush