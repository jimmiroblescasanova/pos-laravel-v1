<div>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    Parámetros del reporte
                </div>
                <form wire:submit.prevent='pdf'>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="group">Seleccionar grupo</label>
                            <select wire:model="form.group" id="group" class="form-control">
                                <option value="all">== Todos ==</option>
                                @foreach ($categories as $id => $category)
                                    <option value="{{ $id }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" wire:model="form.withInventory" class="custom-control-input" id="with-inventory">
                                <label class="custom-control-label" for="with-inventory">Solo productos con existencias</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" wire:model="form.active" class="custom-control-input" id="active-products">
                                <label class="custom-control-label" for="active-products">Solo productos activos</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-file-pdf mr-2"></i>
                            PDF
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    Visualizacion del reporte
                </div>
                <div class="card-body p-0">
                    @if (!is_null($pdf))
                        <embed src="{{ asset('storage/'.$pdf) }}" style="width: 100%; height: 70vh;" frameborder="0">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
