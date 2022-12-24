<?php

namespace App\Http\Livewire\Sale;

use App\Exports\SalesExport;
use App\Models\User;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class IndexSales extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'page' => ['except' => 1],
        'perPage' => [
            'as' => 'show',
            'except' => 10,
        ],
        'startDate' => ['as' => 's'],
        'endDate' => ['as' => 'e'],
        'selectedUser' => [
            'as' => 'u',
            'except' => 'all',
        ],
    ];

    public $perPage = 10;
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
            'perPage',
            'selectedUser',
            'startDate',
            'endDate',
        ]);
        $this->resetPage();
        $this->emit('ClearDates');
    }

    public function dehydrate()
    {
        $this->resetPage();
    }

    public function export()
    {
        return (new SalesExport($this->selectedUser, $this->startDate, $this->endDate))
            ->download('ventas_'.NOW()->format('Ymd').'.xlsx');
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
        ->paginate($this->perPage);

        return view('livewire.sale.index-sales', [
            'sales' => $sales,
        ]);
    }
}
