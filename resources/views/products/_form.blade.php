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
                <option value="1" {{ $product->active == true ?? 'selected' }}>Activo</option>
                <option value="0" {{ $product->active == false ?? 'selected' }}>Inactivo</option>
            </x-form-select>
        </div>
    </div>
    <x-form-textarea name="description" label="Descripcion larga del producto"></x-form-textarea>
@endbind
