<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class SalesExport implements FromQuery, ShouldAutoSize, WithHeadings, WithMapping, WithColumnFormatting, WithStyles
{
    use Exportable;

    public function __construct(
        public string $user, 
        public string $startDate, 
        public string $endDate,
        public bool $showCanceled = false
    ) { }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return [
            'Folio',
            'Fecha',
            'Cliente',
            'Total',
            'Vendedor',
            'Estado',
        ];
    }

    public function map($order): array
    {
        return [
            $order->folio,
            Date::dateTimeToExcel($order->updated_at),
            $order->customer,
            $order->total,
            $order->user->name,
            $order->trashed() ? 'Cancelado' : 'Activo',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'D' => NumberFormat::FORMAT_ACCOUNTING_USD,
        ];
    }

    public function query()
    {
        return Order::query()
            ->where('closed', true)
            ->when($this->showCanceled, function ($q) {
                $q->withTrashed();
            })
            ->when($this->endDate != null, function ($q) {
                $q->whereBetween('updated_at', [$this->startDate, $this->endDate." 23:59:59"]);
            })
            ->when($this->user != 'all', function ($q) {
                $q->where('user_id', $this->user);
            })
            ->orderBy('id', 'desc');
    }
}
