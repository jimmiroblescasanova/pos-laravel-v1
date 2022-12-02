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
        .greetings {
            text-align: center;
            width: 100%;
        }
        .greetings tr td {
            padding-bottom: 1em;
        }
    </style>
</head>

<body>
    <table style="width: 100%; text-align: center;">
        <tr>
            <td><img src="{{ asset($business->logo) }}" alt="logo empresa" style="max-width: 85px;"></td>
        </tr>
        <tr>
            <td>
                {{ $business->name }}
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
                        <td style="width: 20%;">
                            Folio: {{ $order->id }} <br />
                            {{ $order->updated_at->format('d/m/Y') }}
                        </td>
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
            <td>Vendido por: {{ $order->user->name }}</td>
            <td style="text-align: right;">Total:</td>
            <td style="text-align: right;">{{ accounting($order->total) }}</td>
        </tr>
    </table>
    <br />
    <table class="greetings">
        @if ($ticket->signature_line)
            <tr>
                <td>
                    ______________________<br/>
                    Firma de conformidad
                </td>
            </tr>
        @endif
        <tr>
            <td>{{ $ticket->greeting_1 }}</td>
        </tr>
        <tr>
            <td>{{ $ticket->greeting_2 }}</td>
        </tr>
        <tr>
            <td>{{ $ticket->greeting_3 }}</td>
        </tr>
    </table>
</body>

</html>
