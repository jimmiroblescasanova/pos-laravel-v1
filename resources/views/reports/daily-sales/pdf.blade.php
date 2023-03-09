<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DailySales</title>
    <style>
        table {
            boder: none;
            border-collapse: collapse;
            width: 100%;
        }
        .table-bordered td,
        .table-bordered th {
            border: 1px solid gray; // solo para diseño
        }
        .table-bordered .money-sign {
            border-right: none;
            text-align: center;
            width: 15px;
        }
        .table-bordered .total {
            border-left: none;
            text-align: right;
            width: 100px;
        }

        #reportName {
            line-height: 0 !important;
            font-size: 16pt;
            font-weight: bold;
            padding: 1em 0;
            text-align: center;
        }
        #reportTotalArea {
            padding: 1em 0;
        }
    </style>
</head>
<body>
    <table cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td style="width: 100px;">
                                <img src="{{ asset('storage/' . settings()->get('app_logo') ) }}" alt="logo empresa" style="max-width: 85px;">
                            </td>
                            <td style="font-size: 15pt; text-align:center;">{{ settings()->get('app_name') }}</td>
                            <td style="font-size: 9pt; width: 100px; text-align:right; vertical-align:top;">
                                <span>{{ date('d/m/Y H:i') }}</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td id="reportName">
                    <p>REPORTE DE VENTAS DEL D&Iacute;A</p>
                    <p>{{ $date->format('d/m/Y') }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="table-bordered">
                        <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Cliente</th>
                                <th>Vendedor</th>
                                <th colspan="2" style="width: 120px;">Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $docto)
                                <tr>
                                    <td>{{ $docto->id }}</td>
                                    <td>{{ $docto->customer }}</td>
                                    <td>{{ $docto->user->name }}</td>
                                    <td class="money-sign">$</td>
                                    <td class="total">{{ number_format( $docto->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td id="reportTotalArea">
                    <table style="width: auto;" class="table-bordered">
                        <tr>
                            <th style="width: 250px;">Vendedor</th>
                            <th colspan="2">Total de ventas</th>
                        </tr>
                        @foreach ($documents->groupBy('user.name') as $name => $doctos)
                            <tr>
                                <td>{{ $name }}</td>
                                <td class="money-sign">$</td>
                                <td class="total">{{ number_format($doctos->sum('total'), 2) }}</td>
                            </tr>
                        @endforeach
                        <tr style="font-weight: bold;">
                            <td>GRAN TOTAL</td>
                            <td class="money-sign">$</td>
                            <td class="total">{{ number_format($documents->sum('total'), 2) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>