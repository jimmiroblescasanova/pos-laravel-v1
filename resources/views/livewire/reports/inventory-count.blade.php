<div>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    Parámetros del reporte
                </div>
                <form >
                    <div class="card-body">
                        
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
