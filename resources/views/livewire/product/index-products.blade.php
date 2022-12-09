<div>
    <div class="row mb-3">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <input type="text" wire:model.debounce.500ms='search' class="form-control border-0 shadow-sm" placeholder="Buscar por código, descipción, cod. proveedor...">
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="form-group">
                <select name="" id="" class="form-control border-0 shadow-sm">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>
        </div>
        <div class="col-3 col-md-1">
            <div class="form-group">
                <select wire:model='perPage' class="form-control border-0 shadow-sm">
                    <option>10</option>
                    <option>20</option>
                    <option>25</option>
                    <option>50</option>
                </select>
            </div>
        </div>
        <div class="col-3 col-md-1">
            <button type="button" class="btn btn-default btn-block">
                <i class="fas fa-eraser"></i>
            </button>
        </div>
        <div class="col-12 col-md-2">
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-block">
                <i class="fas fa-plus mr-2"></i>
                Nuevo producto
            </a>
        </div>
    </div>
    <div class="card card-default">
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>Codigo de barras</th>
                        <th>Imagen</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Fecha alta</th>
                        <th><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td scope="row">{{ $product->barcode }}</td>
                            <td><img src="{{ $product->getFirstMediaUrl('product', 'thumb') }}" alt=""></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <span @class([
                                    'badge', 
                                    'badge-success' => $product->active,
                                    'badge-danger' => !$product->active,
                                ])>{{ $product->active ? 'Activo' : 'Inactivo' }}</span>
                            </td>
                            <td>{{ $product->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-xs">
                                    <i class="fas fa-edit mr-2"></i>
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No existen resultados para la búsqueda realizada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
