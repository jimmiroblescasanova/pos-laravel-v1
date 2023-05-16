<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToCollection, WithStartRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            '*.0' => ['required', 'min:1'],
            '*.1' => ['nullable', 'string', 'min:5'],
            '*.2' => ['string', 'min:5', 'max:125'],
            '*.3' => ['numeric'],
            '*.4' => ['numeric'],
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => 'codigo de barras',
            '1' => 'codigo del proveedor',
            '2' => 'nombre',
            '3' => 'costo',
            '4' => 'precio de venta',
        ];
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Product::updateOrCreate([
                'barcode' => $row[0]
            ],
            [
                'supplier_code' => $row[1],
                'name' => $row[2],
                'cost' => isset($row[3]) ? $row[3] : 0,
                'price' => $row[4],
            ]);
        }
    }
}
