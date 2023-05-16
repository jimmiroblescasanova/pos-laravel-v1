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

class InventoryImport implements ToCollection, WithStartRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    
    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            '*.0' => ['required',],
            '*.1' => ['nullable', 'string', 'min:5'],
            '*.2' => ['string', 'min:5', 'max:255'],
            '*.3' => ['numeric'],
            '*.4' => ['required', 'numeric'],
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => 'codigo de barras',
            '1' => 'cod. proveedor',
            '2' => 'nombre',
            '3' => 'minimo',
            '4' => 'inventario',
        ];
    }

    public function collection(Collection $rows)
    {        
        foreach ($rows as $row) {

            $product = Product::where('barcode', $row[0])->get();

            $product->update([
                'minimum' => isset($row[3]) ? $row[3] : 0,
                'inventory' => $row[4],
            ]);
        }
    }
}
