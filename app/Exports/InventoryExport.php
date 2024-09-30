<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class InventoryExport implements FromQuery, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithMapping
{
    use Exportable;

    public function __construct(
        public int $type
    ) {}

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

    public function map($inventory): array
    {
        return [
            $inventory->barcode,
            $inventory->supplier_code,
            $inventory->name,
            $inventory->minimum == 0 ? '0' : $inventory->minimum,
            $inventory->inventory == 0 ? '0' : $inventory->inventory,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
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
