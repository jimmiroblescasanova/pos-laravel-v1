<div>
    <div class="row">
        <div class="col-12 col-md-5 col-lg-6">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" wire:model.debounce.300ms='search' class="form-control"
                    placeholder="Buscar por nombre, codigo de barras, codigo prov...">
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 col-lg-2">
            <div class="form-group">
                <select wire:model='showInventory' class="form-control">
                    <option value="0">Todos</option>
                    <option value="1">Existencia cero</option>
                    <option value="2">Solo en existencia</option>
                </select>
            </div>
        </div>
        <div class="col-6 col-md-3 col-lg-1">
            <div class="form-group">
                <select wire:model='perPage' class="form-control">
                    <option>10</option>
                    <option>15</option>
                    <option>25</option>
                    <option>50</option>
                </select>
            </div>
        </div>
        <div class="col-6 col-md-3 col-lg-1">
            <button type="button" wire:click='clear' data-toggle="tooltip" class="btn btn-default btn-block">
                <i class="fas fa-eraser mr-2"></i>
            </button>
        </div>
        <div class="col-6 col-md-3 col-lg-2">
            <div class="btn-group btn-block">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">Avanzado
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <button type="button" id="download-inventory" class="dropdown-item">
                        <i class="fas fa-download mr-2"></i>
                        Descargar inventario
                    </button>
                    <a class="dropdown-item" href="{{ route('inventory.import') }}">
                        <i class="fas fa-upload mr-2"></i>
                        Cargar inventario
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0 table-responsive">
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
                                    Código proveedor
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
                                @can('inventory_edit')
                                <th class="text-center" style="width: 15%;">
                                    <i class="fas fa-cogs"></i>
                                </th>
                                @endcan
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
                                @can('inventory_edit')
                                <td class="text-right">
                                    <button type="button" class="btn btn-primary btn-xs btn-edit"
                                        data-product="{{ $product->id }}">
                                        <i class="fas fa-edit mr-2"></i>Modificar
                                    </button>
                                </td>
                                @endcan
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No existen resultados para la búsqueda realizada. ¿Deseas agregar un <a href="{{ route('products.create') }}">producto nuevo</a>?</td>
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
    </div>
    <form action="{{ route('inventory.export') }}" class="d-none" method="POST" id="download-form">
        @csrf
        <input type="hidden" name="type" value="{{ $showInventory }}">
    </form>
</div>

@push('third_party_scripts')
<script type="module">
$(function () {
    $('[data-toggle="tooltip"]').tooltip({
        placement: 'top',
        title: "Limpiar valores",
    });
});

let btnDownload = document.getElementById('download-inventory');
let form = document.getElementById('download-form');

btnDownload.addEventListener('click', function() {
    form.submit();
});
</script>
@endpush