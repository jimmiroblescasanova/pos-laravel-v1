<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TicketSalesExport implements FromView, WithStyles, ShouldAutoSize
{
    use Exportable;

    public $startDate;
    public $endDate;

    public function __construct(array $request)
    {
        $this->startDate = $request['startDate'];
        $this->endDate = $request['endDate'];
    }

    public function view(): View
    {
        $orders = Order::query()
            ->whereBetween('updated_at', [$this->startDate . ' 00:00:00', $this->endDate . ' 23:59:59'])
            ->where('closed', '=', true)
            ->get();

        return view('reports.ticket-sales.excel', [
            'orders' => $orders,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            3    => ['font' => ['bold' => true]],
        ];
    }
}
