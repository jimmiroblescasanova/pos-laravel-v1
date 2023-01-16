<div>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    Parámetros del reporte
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="date">Fecha</label>
                        <input type="date" class="form-control" wire:model="form.date" id="date">
                    </div>
                    <div class="form-group">
                        <label for="">Seleccionar vendedor</label>
                        <select class="form-control" wire:model="form.user">
                            <option value="all">== Todos los vendedores ==</option>
                            @foreach ($users as $id => $user)
                            <option value="{{ $id }}">{{ $user }}</option>
                            @endforeach
                        </select>
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
