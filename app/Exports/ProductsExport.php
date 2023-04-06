<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromQuery, 
    WithHeadings
{
    use Exportable;

    public $active;
    public $columns;

    public function __construct($active, $columns)
    {
        $this->active = $active;
        $this->columns = $columns;
    }

    public function headings(): array
    {
        return $this->columns;
    }
    
    public function query()
    {
        return Product::query()
        ->select($this->columns)
        ->when($this->active != 'all', function($query) {
            $query->where('active', $this->active);
        });
    }
}
