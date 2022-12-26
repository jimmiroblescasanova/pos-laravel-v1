@extends('layouts.app')

@section('content-header')
    <div class="col-12">
        <h1 class="m-0">Venta ID: {{ $order->number }}</h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card card-outline card-primary">
                <div class="card-header d-flex">
                    <span class="mr-auto">Vendedor: {{ $order->user->name }}</span>
                    <span>Fecha de Venta: {{ $order->updated_at->format('d-m-Y') }}</span>
                </div>
                <div class="card-body">
                    <p>Nombre del cliente: {{ $order->customer }}</p>
                    <p>Detalle de productos:</p>
                    <table class="table table-sm">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 20%;">Cantidad</th>
                                <th>Nombre</th>
                                <th style="width: 20%;">Precio</th>
                                <th style="width: 20%;">Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                            <tr>
                                <td scope="row">{{ $item->quantity }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td class="text-right">$ {{ number_format($item->price, 2) }}</td>
                                <td class="text-right">$ {{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td scope="row" colspan="3" class="text-right">TOTAL:</td>
                                <td class="text-right">$ {{ number_format($order->items()->sum('price')/100, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <a href="{{ route('sales.print', $order) }}" class="btn btn-lg btn-block btn-outline-primary">
                <i class="fas fa-print mr-2"></i>
                Imprimir
            </a>
            <a href="#" class="btn btn-lg btn-block btn-outline-primary">
                <i class="fas fa-paper-plane mr-2"></i>
                Email
            </a>
            <button type="button" id="cancelBtn" class="btn btn-lg btn-block btn-outline-danger">
                <i class="fas fa-ban mr-2"></i>
                Cancelar
            </button>
            <button onclick="history.back();" class="btn btn-lg btn-block btn-outline-secondary">
                <i class="fas fa-backward mr-2"></i>
                Atrás
            </button>
        </div>
    </div>
    <form action="{{ route('orders.delete', $order) }}" id="cancelOrder" method="POST">
        @csrf
        @method('delete')
    </form>
@stop

@push('third_party_scripts')
    <script>
        let btn = document.getElementById('cancelBtn');
        let form = document.getElementById('cancelOrder');
        
        btn.addEventListener('click', () => {
            if (confirm('¿Estas seguro de cancelar la orden?')) {
                form.submit();
            }
        });
    </script>
@endpush