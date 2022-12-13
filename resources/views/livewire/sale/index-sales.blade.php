<div>
    <div class="row">
        <div class="form-group col-6">
            <input type="text" id="date-range" class="form-control">
        </div>
        <div class="form-group col-3">
            <select class="form-control">
                <option value="all">Todos los vendedores</option>
            </select>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Vendedor</th>
                        <th><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                    <tr>
                        <td scope="row">{{ $sale->id }}</td>
                        <td>{{ $sale->updated_at->format('d/m/Y') }}</td>
                        <td>{{ $sale->customer }}</td>
                        <td>{{ $sale->total }}</td>
                        <td>{{ $sale->user->name }}</td>
                        <td></td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6">No existen resultados para la búsqueda realizada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            Footer
        </div>
    </div>
</div>
