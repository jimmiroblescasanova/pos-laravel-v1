<div>
    <div class="row">
        <div class="form-group col-12 col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                </div>
                <input type="text" id="date-range" class="form-control" placeholder="Selecciona un rango de fechas">
            </div>
        </div>
        <div class="form-group col-6 col-md-3">
            <select wire:model="selectedUser" class="form-control">
                <option value="all">Todos los vendedores</option>
                @foreach ($users as $id => $user)
                    <option value="{{ $id }}">{{ $user }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-2 col-md-1">
            <select wire:model="perPage" class="form-control">
                <option>10</option>
                <option>15</option>
                <option>25</option>
                <option>50</option>
            </select>
        </div>
        <div class="form-group col-2 col-md-1">
            <button wire:click="clear" class="btn btn-block btn-default" data-toggle="tooltip"><i class="fas fa-eraser mr-2"></i></button>
        </div>
        <div class="form-group col-2 col-md-1">
            <div class="btn-group d-flex">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-plus mr-2"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" style="">
                    <button wire:click="export" class="dropdown-item">
                        <i class="fas fa-download mr-2"></i>
                        Descargar filtro XLS
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-0 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 15%;">Fecha</th>
                        <th>Cliente</th>
                        <th style="width: 10%;">Total</th>
                        <th style="width: 25%;">Vendedor</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                    <tr>
                        <td scope="row">
                            <a href="{{ route('sales.show', $sale) }}">{{ $sale->number }}</a>
                        </td>
                        <td>{{ $sale->updated_at->format('d/m/Y') }}</td>
                        <td>{{ $sale->customer }}</td>
                        <td style="text-align: right;">$ {{ number_format($sale->total, 2) }}</td>
                        <td>{{ $sale->user->name }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6">No existen resultados para la búsqueda realizada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $sales->links() }}
        </div>
    </div>
</div>

@push('third_party_stylesheets')
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js" defer></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endpush

@push('third_party_scripts')
<script src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/moment@2.29.4/locale/es.js"></script>
<script type="module">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            placement: 'top',
            title: "Limpiar valores",
        });
    });

    let start = moment().subtract(29, 'days');
    let end = moment();

    $('input#date-range').daterangepicker({
        autoUpdateInput: false,
        locale: {
            format: 'DD/MM/YYYY',
            cancelLabel: 'Cancelar',
            applyLabel: 'Aplicar', 
            customRangeLabel: "Seleccionar otra fecha",
            daysOfWeek: [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            monthNames: [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Deciembre"
            ],
        },
        startDate: start,
        endDate: end,
        ranges: {
        'Hoy': [moment(), moment()],
        'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
        'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
        'Este mes': [moment().startOf('month'), moment().endOf('month')],
        'Mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    $('input#date-range').on('apply.daterangepicker', function(ev, picker) {
        $(this).val('Del: ' + picker.startDate.format('D MMMM, YYYY') + ' al: ' + picker.endDate.format('D MMMM, YYYY'));
        @this.set('startDate', picker.startDate.format('YYYY-MM-DD'));
        @this.set('endDate', picker.endDate.format('YYYY-MM-DD'));
    });

    Livewire.on('ClearDates', function() {
        $('input#date-range').val("").change();
        $('[data-toggle="tooltip"]').tooltip('hide');
    });
</script>
@endpush