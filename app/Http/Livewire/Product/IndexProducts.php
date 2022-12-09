<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Traits\WithSearching;

class IndexProducts extends Component
{
    use WithSearching;

    public function render()
    {
        $products = Product::query()
            ->search($this->search)
            ->paginate($this->perPage);
        
        return view('livewire.product.index-products', compact('products'));
    }
}
