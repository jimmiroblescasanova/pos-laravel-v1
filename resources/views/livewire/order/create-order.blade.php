<div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-danger">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <span>Carrito de compras</span>
                        <span>Folio: {{ sprintf('%04d', $order->id) }}</span>
                    </div>
                </div>
                <div class="card-body p-0 pb-2">
                    <div class="row form-group p-3">
                        <label for="customer" class="col-sm-2 col-form-label">CLIENTE:</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model.lazy="customerName" id="customer" class="form-control"
                                style="text-transform: uppercase">
                        </div>
                    </div>
                    <table class="table table-sm table-condensed">
                        <thead>
                            <tr>
                                <th>Descripcion</th>
                                <th style="width: 15%;">Precio</th>
                                <th style="width: 30%;">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orderItems as $item)
                                <tr>
                                    <td scope="row">{{ $item->product->name }}</td>
                                    <td class="text-right">
                                        <span>{{ accounting($item->price) }}</span>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm" role="group">
                                            <input type="text" class="form-control form-control-sm" readonly
                                                value="{{ $item->quantity }}">
                                            <div class="input-group-append">
                                                <button type="button"
                                                    wire:click="increaseQuantity('{{ $item->id }}')"
                                                    class="btn btn-default">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                                <button type="button"
                                                    wire:click="decreaseQuantity('{{ $item->id }}')"
                                                    class="btn btn-default">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" wire:click="removeProduct({{ $item->id }})"
                                                    class="btn btn-danger">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Agrega un producto para iniciar.</td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="2" class="text-right">Total:</td>
                                <td class="text-right">
                                    {{ accounting($order->total) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if ($itemsCount > 0)
                    <div class="card-footer text-center">
                        <button type="button" wire:click="closeOrder" class="btn btn-sm btn-warning">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            TERMINAR VENTA
                        </button>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Agregar productos
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <input type="text" wire:model="search" class="form-control"
                                placeholder="Buscar por codigo, nombre de producto, cod. de proveedor">
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Descripcion</th>
                                    <th style="width: 15%;">Precio</th>
                                    <th style="width: 20%;">Inventario</th>
                                    <th style="width: 10%;" class="text-center">
                                        <i class="fas fa-cart-plus"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td scope="row">{{ $product->name }}</td>
                                        <td class="text-right">{{ accounting($product->price) }}</td>
                                        <td class="text-right">{{ $product->inventory }}</td>
                                        <td class="text-right">
                                            <button type="button" wire:click="addProduct('{{ $product->id }}')"
                                                class="btn btn-sm btn-default">
                                                <i class="fas fa-cart-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No hay productos para la búsqueda. ¿Deseas agregar <a href="{{ route('products.create') }}">nuevo producto</a>?</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    Footer
                </div>
            </div>
        </div>
    </div>
</div>
