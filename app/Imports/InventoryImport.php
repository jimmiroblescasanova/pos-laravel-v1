<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
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
            '*.3' => ['numeric', 'nullable'],
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
        foreach ($rows as $index => $row) {
            try {
                $product = Product::where('barcode', (string)$row[0])->first();

                if (!$product) {
                    // Lanzar una excepción personalizada si el producto no se encuentra
                    throw new \Exception("Producto con código de barras: {$row[0]}, no fue encontrado. Fila " . ($index + $this->startRow()));
                }

                $product->update([
                    'minimum' => $row[3],
                    'inventory' => $row[4],
                ]);
            } catch (\Exception $e) {
                // Si ocurre algún error, será capturado y registrado, luego se omitirá la fila
                $this->onError($e);
            }
        }
    }

    public function onError(\Throwable $e)
    {
        // Aquí puedes manejar los errores capturados, como registrar en los logs o almacenarlos en un array
        Log::error('Error durante la importación: ' . $e->getMessage());

        // Si prefieres almacenar los errores para revisarlos luego, puedes usar un array
        $this->errors[] = $e->getMessage();
    }
}
