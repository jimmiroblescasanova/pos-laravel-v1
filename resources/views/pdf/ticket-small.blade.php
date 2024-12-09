<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ticket de Venta</title>

    <style>
        body {
            font-size: 10px;
        }

        .itemsTable {
            border: 0.5px solid gray;
            border-collapse: collapse;
            width: 100%;
        }

        .itemsTable thead th {
            border: 1px solid gray;
            font-weight: bold;
            text-align: center;
        }

        .itemsTable tbody {
            vertical-align: text-top;
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
            <td><img src="{{ asset('storage/'.settings()->get('app_logo')) }}" alt="logo empresa" style="max-height: 120px;"></td>
        </tr>
        <tr>
            <td>
                {{ settings()->get('app_name') }}
            </td>
        </tr>
        <tr>
            <td>
                {{ settings()->get('app_address') }}
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
                <th style="width: 10%;">Cant.</th>
                <th>Descripción</th>
                <th style="width: 20%;">Precio</th>
                <th style="width: 20%;">Importe</th>
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
    <table style="border: 0.5px solid gray; width:100%;">
        <tr>
            <td style="vertical-align: text-top;">Vendedor: {{ $order->user->name }}</td>
            <td style="text-align: right;">Descuento:</td>
            <td style="text-align: right;">{{ accounting($order->discount) }}</td>
        </tr>
        <tr>
            <td style="vertical-align: text-top;">Forma de pago: 
                <span>{{ paymentMethod($order->payment_method) }}</span>
            </td>
            <td style="text-align: right;">IVA:</td>
            <td style="text-align: right;">{{ accounting($order->tax) }}</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right;">Total:</td>
            <td style="text-align: right;">{{ accounting($order->totalWithTaxes) }}</td>
        </tr>
    </table>
    <br />
    <table class="greetings">
        @if (settings()->get('signature_line'))
            <tr>
                <td>
                    ______________________<br/>
                    Firma de conformidad
                </td>
            </tr>
        @endif
        <tr>
            <td>{{ settings()->get('greeting_1') }}</td>
        </tr>
        <tr>
            <td>{{ settings()->get('greeting_2') }}</td>
        </tr>
        <tr>
            <td>{{ settings()->get('greeting_3') }}</td>
        </tr>
    </table>
</body>

</html>
