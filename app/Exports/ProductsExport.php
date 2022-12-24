<?php

namespace App\Exports;

use App\Models\Product;
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

class ProductsExport implements FromQuery, 
    WithStyles, 
    WithMapping,
    WithHeadings, 
    ShouldAutoSize, 
    WithColumnFormatting
{
    use Exportable;

    public function __construct($active, $search)
    {
        $this->active = $active;
        $this->search = $search;
    }

    public function headings(): array
    {
        return [
            'Código',
            'Código proveedor',
            'Nombre',
            'Costo',
            'Precio',
            'Descrición',
            'Estado',
            'Fecha de alta',
        ];
    }

    public function styles(Worksheet $sheet) {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function columnFormats(): array {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'E' => NumberFormat::FORMAT_ACCOUNTING_USD,
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function map($product): array
    {
        return [
            $product->barcode,
            $product->supplier_code,
            $product->name,
            $product->cost,
            $product->price,
            $product->descripction,
            $product->active ? '1' : '0',
            Date::dateTimeToExcel($product->updated_at),
        ];
    }
    
    public function query()
    {
        return Product::query()
        ->search($this->search)
        ->when($this->active != 'all', function($query) {
            $query->where('active', $this->active);
        });
    }
}
