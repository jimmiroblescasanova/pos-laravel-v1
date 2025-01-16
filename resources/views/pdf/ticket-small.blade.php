<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ticket de Venta</title>

    <style>
        @page {
            margin: 1em;
            /* Establecemos el tamaño de página para ticket de 80mm */
            size: 76mm auto;
        }

        body {
            font-size: 12px;
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
        @if(settings()->get('app_logo'))
        <tr>
            <td><img src="{{ asset('storage/'.settings()->get('app_logo')) }}" alt="logo empresa" style="max-height: 90px;"></td>
        </tr>
        @endif
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
                <table style="width: 100%; margin-top: 10px;">
                    <tr>
                        <td style="text-align: left; padding-right: 10px;">
                            <strong>Cliente:</strong><br/>
                            <span style="padding-left: 10px;">{{ $order->customer }}</span>
                        </td>
                        <td style="width: 30%; border-left: 1px solid #ccc; padding-left: 10px;">
                            <strong>Folio:</strong> {{ $order->id }}<br />
                            <span style="font-size: 11px;">{{ $order->updated_at->format('d/m/Y') }}</span>
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
    <table style="width:100%;">
        <tr>
            <td>Vendedor: {{ $order->user->name }}</td>
        </tr>
        <tr>
            <td>Forma de pago: {{ paymentMethod($order->payment_method) }}</td>
        </tr>
    </table>

    <table style="width:100%;">
        <tr>
            <td style="text-align: right;">Descuento:</td>
            <td style="text-align: right; width: 30%;">{{ accounting($order->discount) }}</td>
        </tr>
        <tr>
            <td style="text-align: right;">IVA:</td>
            <td style="text-align: right;">{{ accounting($order->tax) }}</td>
        </tr>
        <tr style="font-weight: bold;">
            <td style="text-align: right;">Total:</td>
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
