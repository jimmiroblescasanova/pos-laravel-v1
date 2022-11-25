<div>
    <div class="row mb-3">
        <div class="col-md-2">
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-block">
                <i class="fas fa-plus mr-2"></i>
                Nuevo producto
            </a>
        </div>
    </div>
    <div class="card card-default">
        <div class="card-body">
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
                            <td>{{ $product->status }}</td>
                            <td>{{ $product->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}"
                                    class="btn btn-primary btn-xs">Editar</a>
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
