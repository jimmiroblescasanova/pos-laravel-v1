<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Traits\WithSorting;
use App\Traits\WithSearching;

class IndexProducts extends Component
{
    use WithSorting;
    use WithSearching;

    public $active = 'all';

    public function mount()
    {
        $this->sortField = 'barcode';
    }

    public function clear()
    {
        $this->reset([
            'search',
            'perPage',
            'active',
        ]);
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::query()
            ->search($this->search)
            ->when($this->active != 'all', function($query) {
                $query->where('active', $this->active);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
        
        return view('livewire.product.index-products', compact('products'));
    }
}
