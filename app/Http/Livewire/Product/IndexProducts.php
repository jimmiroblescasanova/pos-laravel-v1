<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class IndexProducts extends Component
{
    public function render()
    {
        $products = Product::all();
        
        return view('livewire.product.index-products', compact('products'));
    }
}
