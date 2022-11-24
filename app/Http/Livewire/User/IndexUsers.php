<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class IndexUsers extends Component
{
    public $users;

    public function render()
    {
        $this->users = User::all();
        
        return view('livewire.user.index-users');
    }
}
