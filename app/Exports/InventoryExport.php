<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class InventoryExport implements FromQuery, WithHeadings, ShouldAutoSize, WithColumnFormatting
{
    use Exportable;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function headings(): array
    {
        return [
            'Codigo',
            'Cod Proveedor',
            'Nombre del producto',
            'Minimo Inventario',
            'Inventario Actual',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_NUMBER,
            'E' => NumberFormat::FORMAT_NUMBER,
        ];
    }
    
    public function query()
    {
        return Product::query()
            ->select('barcode', 'supplier_code', 'name', 'minimum', 'inventory')
            ->when($this->type != 0, function($q) {
                if ($this->type == 1) {
                    $q->where('inventory', 0);
                } else {
                    $q->where('inventory', '>=', 1);
                }
            });
    }
}
