<div>
    <div class="row">
        <div class="form-group col-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                </div>
                <input type="text" id="date-range" class="form-control" placeholder="Selecciona un rango de fechas">
            </div>
        </div>
        <div class="form-group col-3">
            <select wire:model="selectedUser" class="form-control">
                <option value="all">Todos los vendedores</option>
                @foreach ($users as $id => $user)
                    <option value="{{ $id }}">{{ $user }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-1">
            <button wire:click="clear" class="btn btn-block btn-default" data-toggle="tooltip"><i class="fas fa-eraser mr-2"></i></button>
        </div>
        <div class="col-6 col-md-2 form-group">
            <div class="btn-group btn-block">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">Opciones avanzadas
                </button>
                <div class="dropdown-menu dropdown-menu-right" style="">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-download mr-2"></i>
                        Descargar filtro XLS
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-upload mr-2"></i>
                        Cargar inventario
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 15%;">Fecha</th>
                        <th>Cliente</th>
                        <th style="width: 10%;">Total</th>
                        <th style="width: 25%;">Vendedor</th>
                        <th style="width: 10%;"><i class="fas fa-cogs"></i></th>
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