<?php

namespace App\Http\Livewire\Access;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class IndexUsers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'page' => ['except' => 1, 'as' => 'u'],
    ];
    
    public function render()
    {
        $users = User::where('id', '!=', 1)->paginate();
        
        return view('livewire.access.index-users', [
            'users' => $users,
        ]);
    }
}
