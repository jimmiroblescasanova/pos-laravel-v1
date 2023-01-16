<div>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    Parámetros del reporte
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="date">Fecha Inicial</label>
                        <input type="date" class="form-control" wire:model="form.startDate" id="date">
                    </div>
                    <div class="form-group">
                        <label for="date">Fecha Final</label>
                        <input type="date" class="form-control" wire:model="form.endDate" id="date">
                    </div>
                    <div class="form-group">
                        <label for="">Seleccionar productos</label>
                        <select class="form-control" wire:model="form.product">
                            <option value="all">== Todos los productos ==</option>
                            @foreach ($products as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" wire:model="form.withDocuments" id="withDocuments" value="1">
                        Solo productos con movimientos
                      </label>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <button type="button" wire:click="pdf" class="btn btn-sm btn-danger">
                        <i class="fas fa-file-pdf mr-2"></i>
                        PDF
                    </button>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    Visualizacion del reporte
                </div>
                <div class="card-body p-0">
                    @if (!is_null($pdf))
                        <embed src="{{ asset($pdf) }}" style="width: 100%; height: 70vh;" frameborder="0">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
