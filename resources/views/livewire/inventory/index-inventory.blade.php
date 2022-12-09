<div>
    <div class="row">
        <div class="col-12 col-md-5 form-group">
            <input type="text" wire:model.debounce.300ms='search' class="form-control border-0 shadow-sm"
                placeholder="Buscar por nombre, codigo de barras, codigo prov...">
        </div>
        <div class="col-6 col-md-3 form-group">
            <select wire:model='showInventory' class="form-control border-0 shadow-sm">
                <option value="0">Todos</option>
                <option value="1">Existencia cero</option>
                <option value="2">Solo en existencia</option>
            </select>
        </div>
        <div class="col-6 col-md-1 form-group">
            <select wire:model='perPage' class="form-control border-0 shadow-sm">
                <option>10</option>
                <option>15</option>
                <option>25</option>
                <option>50</option>
            </select>
        </div>
        <div class="col-6 col-md-1 form-group">
            <button type="button" wire:click='clear' class="btn btn-default btn-block">
                <i class="fas fa-eraser mr-2"></i> Limpiar
            </button>
        </div>
        <div class="col-6 col-md-2 form-group">
            <div class="btn-group btn-block">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">Opciones avanzadas
                </button>
                <div class="dropdown-menu dropdown-menu-right" style="">
                    <a class="dropdown-item" href="#"><i class="fas fa-download mr-2"></i> Descargar inventario</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-upload mr-2"></i> Cargar inventario</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <x-table-heading 
                                    sortable
                                    wire:click="sortBy('barcode')"
                                    :direction="$sortField === 'barcode' ? $sortDirection : null">
                                    Código barras
                                </x-table-heading>
                                <x-table-heading 
                                    sortable 
                                    wire:click="sortBy('supplier_code')" 
                                    :direction="$sortField === 'supplier_code' ? $sortDirection : null">
                                    Código barras
                                </x-table-heading>
                                <x-table-heading 
                                    sortable 
                                    wire:click="sortBy('name')" 
                                    :direction="$sortField === 'name' ? $sortDirection : null"
                                    width="35%">
                                    Nombre del producto
                                </x-table-heading>
                                <th>Cant. minima</th>
                                <th>Existencia actual</th>
                                <th class="text-center">
                                    <i class="fas fa-cogs"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td scope="row">{{ $product->barcode }}</td>
                                <td>{{ $product->supplier_code }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->minimum }}</td>
                                <td>{{ $product->inventory }}</td>
                                <td class="text-right">
                                    <button type="button" class="btn btn-primary btn-xs btn-edit"
                                        data-product="{{ $product->id }}">
                                        <i class="fas fa-edit mr-2"></i>Modificar
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No existen resultados para la búsqueda realizada. ¿Deseas agregar un <a href="{{ route('products.create') }}">producto nuevo</a>?</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>