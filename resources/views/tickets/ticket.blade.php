<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ticket de Venta</title>

    <style>
        .itemsTable {
            border: 1px solid gray;
            border-collapse: collapse;
            width: 100%;
        }
        .itemsTable thead th {
            border: 1px solid gray;
            font-weight: bold;
            text-align: center;
        }
        .itemsTable tr td.money {
            text-align: right;
        }
        .itemsTable tr:nth-child(even) {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <table style="width: 100%;">
        @if ($business->logo != null)
            <tr>
                <td>logo</td>
            </tr>
        @endif
        <tr>
            <td>
                {{ $business->company_name }}
            </td>
        </tr>
        <tr>
            <td>
                {{ $business->address }}
            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 100%;">
                    <tr>
                        <td>Cliente: {{ $order->customer }}</td>
                        <td style="width: 20%;">{{ $order->updated_at->format('d/m/Y') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br />
    <table class="itemsTable">
        <thead>
            <tr>
                <th>Cant.</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td scope="row">{{ $item->quantity }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td class="money">
                        {{ accounting($item->price) }}
                    </td>
                    <td class="money">
                        {{ accounting($item->quantity * $item->price) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br />
    <table style="border: 1px solid gray; width:100%;">
        <tr>
            <td>
                Total de productos: 
                <br />
                Vendido por: {{ $order->user->name }}
            </td>
            <td>Total:</td>
            <td>{{ $order->total }}</td>
        </tr>
    </table>
</body>

</html>
