<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Product;
use Livewire\Component;
use App\Traits\WithSorting;
use App\Traits\WithSearching;

class IndexInventory extends Component
{
    use WithSorting;
    use WithSearching;

    public $showInventory = 0;

    public function mount()
    {
        $this->sortField = 'barcode';
    }

    public function clear()
    {
        $this->reset([
            'search',
            'perPage',
            'showInventory'
        ]);
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::query()
        ->search($this->search) 
        ->when($this->showInventory != 0, function ($query) {
            if ($this->showInventory == 1) {
                $query->where('inventory', 0);
            } else {
                $query->where('inventory', '>=', 1);
            }
        })
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate();
        
        return view('livewire.inventory.index-inventory', [
            'products' => $products,
        ]);
    }
}
