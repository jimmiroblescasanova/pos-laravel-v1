<div class="modal fade" id="downloadProducts" tabindex="-1" aria-labelledby="downloadProductsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadProductsLabel">Parámetros de descarga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('products.download') }}" method="post">
                @csrf 
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Estado del producto</label>
                        <select class="form-control" name="status" id="status">
                            <option value="all">Todos</option>
                            <option value="1">Activos</option>
                            <option value="0">Inactivos</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <p>Seleccionar columnas a descargar</p>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="columns[]" id="barcode" value="barcode" checked>
                                Código de barras
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="columns[]" id="supplier_code" value="supplier_code" checked>
                                Código del proveedor
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="columns[]" id="name" value="name" checked>
                                Nombre del producto
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="columns[]" id="cost" value="cost" checked>
                                Costo
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="columns[]" id="price" value="price" checked>
                                Precio
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Descargar ahora</button>
                </div>
            </form>
        </div>
    </div>
</div>