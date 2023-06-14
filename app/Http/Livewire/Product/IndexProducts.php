<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Traits\WithSorting;
use App\Traits\WithSearching;
use Livewire\WithPagination;

class IndexProducts extends Component
{
    use WithSorting;
    use WithSearching;
    use WithPagination;

    public $active = 'all';

    protected $queryString = [
        'search' => ['except' => '', 'as' => 'p'],
        'active' => ['except' => 'all', 'as' => 's'],
        'perPage' => ['except' => 25, 'as' => 'show'],
    ];

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
