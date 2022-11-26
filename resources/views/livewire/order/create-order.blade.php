<div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-danger">
                <div class="card-header">
                    Carrito de compras (total prod: {{ $itemsCount }})
                </div>
                <div class="card-body p-0">
                    <div class="row form-group p-3">
                        <label for="customer" class="col-sm-2 col-form-label">CLIENTE:</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model.lazy="customerName" id="customer" class="form-control" style="text-transform: uppercase">
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
                                        <span>{{ $item->price }}</span>
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
                                    <td colspan="3">Agrega un producto para iniciar</td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="2" class="text-right">Total:</td>
                                <td class="text-right">
                                    {{ $order->total }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    Footer
                </div>
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
                                    <th>Precio</th>
                                    <th>+</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td scope="row">{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            <button type="button" wire:click="addProduct('{{ $product->id }}')">
                                                add
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No hay productos para la búsqueda</td>
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
