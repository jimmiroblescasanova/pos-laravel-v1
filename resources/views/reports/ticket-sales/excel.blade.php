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
            <tr style="font-weight: bold">
                <th>Fecha</th>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Descuento</th>
                <th>Impuesto</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->updated_at->format('Y-m-d') }}</td>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer }}</td>
                    <td>{{ $order->discount }}</td>
                    <td>{{ $order->tax }}</td>
                    <td>{{ $order->total }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Cantidad</td>
                    <td>Producto</td>
                    <td>Precio</td>
                </tr>
                @foreach ($order->items as $item)
                    <tr>
                        <td></td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->price }}</td>
                    </tr>
                @endforeach
                <tr></tr>
                <tr></tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>