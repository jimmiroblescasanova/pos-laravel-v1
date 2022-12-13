<?php

namespace App\Http\Livewire\Sale;

use App\Models\Order;
use Livewire\Component;

class IndexSales extends Component
{
    public function render()
    {
        $sales = Order::query()
        ->where('closed', true)
        ->orderBy('id', 'desc')
        ->paginate();

        return view('livewire.sale.index-sales', [
            'sales' => $sales,
        ]);
    }
}
