<?php

namespace App\Http\Livewire\Sale;

use App\Models\User;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class IndexSales extends Component
{
    use WithPagination;

    public $startDate = null; 
    public $endDate = null; 
    public $users;
    public $selectedUser = 'all';

    public function mount()
    {
        $this->users = User::pluck('name', 'id');
    }

    public function clear()
    {
        $this->reset([
            'selectedUser',
            'startDate',
            'endDate',
        ]);
        $this->resetPage();
        $this->emit('ClearDates');
    }

    public function render()
    {
        $sales = Order::query()
        ->where('closed', true)
        ->when($this->endDate != null, function ($q) {
            $q->whereBetween('updated_at', [$this->startDate, $this->endDate." 23:59:59"]);
        })
        ->when($this->selectedUser != 'all', function ($q) {
            $q->where('user_id', $this->selectedUser);
        })
        ->orderBy('id', 'desc')
        ->paginate();

        return view('livewire.sale.index-sales', [
            'sales' => $sales,
        ]);
    }
}
