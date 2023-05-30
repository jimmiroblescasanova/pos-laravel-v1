<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventario</title>
    <style>
        table {
            boder: none;
            border-collapse: collapse;
            width: 100%;
        }
        .table-bordered tbody {
            font-size: 14px;
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

        .reportTotalArea {
            padding: 1em 0 0 0;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div style="page-break-after:auto;">
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
                    <p>REPORTE DE INVENTARIO FISICO</p>
                </td>
            </tr>
            @foreach ($products as $group => $products)
            <tr>
                <td>
                    <p>Grupo: {{ $group }}</p>
                    <table class="table-bordered">
                        <thead>
                            <tr>
                                <th style="width:25%;">CODIGO</th>
                                <th>DESCRIPCION</th>
                                <th style="width:15%;">SISTEMA</th>
                                <th style="width:15%;">FISICO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                @if (($loop->iteration % 30) == 0)
                                    </tbody>
                                </table>
                                <div class="page-break"></div>
                                <table class="table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width:25%;">CODIGO</th>
                                            <th>DESCRIPCION</th>
                                            <th style="width:15%;">SISTEMA</th>
                                            <th style="width:15%;">FISICO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                @endif
                                <tr>
                                    <td style="vertical-align: top;">{{ $product->barcode }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td style="vertical-align: top; text-align: center;">{{ $product->inventory }}</td>
                                    <td>&nbsp;</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</body>
</html>