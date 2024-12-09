<div>
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <span>Datos del ticket</span>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="greeting_1">Mensaje 1</label>
                        <input type="text" wire:model.lazy='greeting_1'
                            class="form-control @error('greeting_1') is-invalid @enderror">
                        @error('greeting_1')
                        <small class="form-text invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="greeting_2">Mensaje 2</label>
                        <input type="text" wire:model.lazy='greeting_2'
                            class="form-control @error('greeting_2') is-invalid @enderror">
                        @error('greeting_2')
                        <small class="form-text invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="greeting_3">Mensaje 3</label>
                        <input type="text" wire:model.lazy='greeting_3'
                            class="form-control @error('greeting_3') is-invalid @enderror">
                        @error('greeting_3')
                        <small class="form-text invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="paper_size">Tamaño del papel</label>
                        <select name="paper_size" id="paper_size" wire:model.lazy='paper_size' class="form-control">
                            <option value="letter">Carta</option>
                            <option value="ticket">Ticket 80mm</option>
                        </select>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" wire:model="signature_line" value="1">
                        Mostrar linea de firma
                      </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="card card-outline card-danger">
                <div class="card-header">
                    Ticket de ejemplo
                </div>
                <div class="card-body text-center px-5">
                    <p><img src="{{ asset('storage/' . settings()->get('app_logo') ) }}" alt="logo empresa" style="max-height: 85px;"></p>
                    <p>{{ settings()->get('app_name') }}</p>
                    <p>{{ settings()->get('app_address') }}</p>
                    <div class="row justify-content-between mb-3">
                        <span>Cliente: VENTA MOSTRADOR</span>
                        <span>Folio: 001<br /> Fecha: {{ NOW()->format('d/m/Y') }} </span>
                    </div>
                    <table class="table table-bordered table-condensed table-sm mb-2">
                        <tr>
                            <td>Descripcion</td>
                            <td>Cantidad</td>
                            <td>Precio U.</td>
                            <td>Importe</td>
                        </tr>
                        <tr>
                            <td>Desarmador cruz, pieza</td>
                            <td>1</td>
                            <td>80.00</td>
                            <td>80.00</td>
                        </tr>
                        <tr>
                            <td>Pinza de corte, pieza</td>
                            <td>1</td>
                            <td>100.00</td>
                            <td>100.00</td>
                        </tr>
                    </table>
                    <div class="row justify-content-between mb-3">
                        <p>Vendido por: Admin</p>
                        <span class="text-right">
                            Subtotal: $ 180.00<br />
                            <B>TOTAL: $ 180.00</B>
                        </span>
                    </div>
                    @if (settings()->get('signature_line'))
                        <p>_______________________ <br />Firma de conformidad</p>
                    @endif
                    <p>{{ settings()->get('greeting_1') }}</p>
                    <p>{{ settings()->get('greeting_2') }}</p>
                    <p>{{ settings()->get('greeting_3') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>