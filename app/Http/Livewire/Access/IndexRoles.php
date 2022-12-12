<?php

namespace App\Http\Livewire\Access;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class IndexRoles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'page' => ['except' => 1, 'as' => 'r'],
    ];
    
    public function render()
    {
        $roles = Role::paginate();
        
        return view('livewire.access.index-roles', [
            'roles' => $roles,
        ]);
    }
}
