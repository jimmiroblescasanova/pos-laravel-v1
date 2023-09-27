<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Excel</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th></th>
                <th colspan="4" style="font-size: 24px; font-weight: bold; text-align:center;">REPORTE DE VENTAS POR TICKET</th>
                <th></th>
            </tr>
        </thead>
    </table>
    <table>
        <thead>
            <tr style="font-weight: bold;">
                <th>Fecha</th>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Precio U.</th>
                <th>Importe</th>
                <th>Descuento</th>
                <th>Impuesto</th>
                <th>Total</th>
                <th>Forma de Pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr style="border: 1px solid #000;">
                    <td style="border-top: 1px solid black">{{ $order->updated_at->format('d-m-Y') }}</td>
                    <td style="border-top: 1px solid black">{{ $order->id }}</td>
                    <td style="border-top: 1px solid black">{{ $order->customer }}</td>
                    <td style="border-top: 1px solid black"></td>
                    <td style="border-top: 1px solid black"></td>
                    <td style="border-top: 1px solid black">{{ $order->discount }}</td>
                    <td style="border-top: 1px solid black">{{ $order->tax }}</td>
                    <td style="border-top: 1px solid black">{{ ($order->total + $order->tax) - $order->discount }}</td>
                    <td style="border-top: 1px solid black">{{ paymentMethod($order->payment_method) }}</td>
                </tr>
                @foreach ($order->items as $key => $item)
                    <tr>
                        <td></td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity * $item->price }}</td>
                    </tr>
                @endforeach
            @endforeach
            @foreach($orders->groupBy('payment_method') as $pay => $subOrders)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-size: 16px; font-weight: bold;">{{ paymentMethod($pay) }}</td>
                <td style="font-size: 16px; font-weight: bold;">{{ number_format($subOrders->sum('total'), 2) }}</td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-size: 16px; font-weight: bold;">TOTAL GENERAL DEL DÍA</td>
                <td style="font-size: 16px; font-weight: bold;">{{ number_format($orders->sum('total'), 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>