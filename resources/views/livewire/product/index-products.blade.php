<div>
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" wire:model.debounce.500ms='search' class="form-control" placeholder="Buscar por código, descipción, cod. proveedor...">
                </div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="form-group">
                <select wire:model='active' class="form-control">
                    <option value="all">Todos</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>
        </div>
        <div class="col-3 col-md-1">
            <div class="form-group">
                <select wire:model='perPage' class="form-control">
                    <option>10</option>
                    <option>20</option>
                    <option>25</option>
                    <option>50</option>
                </select>
            </div>
        </div>
        <div class="col-3 col-md-1">
            <button type="button" wire:click='clear' data-toggle="tooltip" class="btn btn-default btn-block">
                <i class="fas fa-eraser mr-2"></i>
            </button>
        </div>
    </div>
    <div class="card card-default">
        <div class="card-body p-0 table-responsive">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <x-table-heading 
                            sortable 
                            width="15%"
                            wire:click="sortBy('barcode')" 
                            :direction="$sortField === 'barcode' ? $sortDirection : null">
                            Código barras
                        </x-table-heading>
                        <x-table-heading sortable wire:click="sortBy('name')" :direction="$sortField === 'name' ? $sortDirection : null"
                            width="30%">
                            Nombre del producto
                        </x-table-heading>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Ult. modificación</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td scope="row">
                                <a href="{{ route('products.edit', $product) }}">
                                    {{ $product->barcode }}
                                </a>
                            </td>
                            <td>{{ $product->name }}</td>
                            <td class="text-right">$ {{ number_format($product->price, 2) }}</td>
                            <td class="text-center">
                                <span @class([
                                    'badge', 
                                    'badge-success' => $product->active,
                                    'badge-danger' => !$product->active,
                                    ])>{{ $product->active ? 'Activo' : 'Inactivo' }}</span>
                            </td>
                            <td class="text-right">{{ $product->updated_at->format('d/m/Y') }}</td>
                            <td class="text-right"><img src="{{ $product->getFirstMediaUrl('product', 'thumb') }}" alt=""></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No existen resultados para la búsqueda realizada. ¿Deseas agregar un <a href="{{ route('products.create') }}">producto nuevo</a>?</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $products->links() }}
        </div>
    </div>
</div>

@push('third_party_scripts')
<script type="module">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            placement: 'top',
            title: "Limpiar valores",
        });
    });
</script>
@endpush