<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;

class Business extends Component
{
    use WithFileUploads;

    public $name;
    public $address;
    public $logo;

    protected $rules = [
        'name' => 'required|min:6',
        'address' => 'nullable|min:6',
        'logo' => [
            'nullable', 
            'image',
            'max:100',
            'dimensions:max_width=250,max_height=250',
        ],
    ];

    public function mount()
    {
        $this->name     = settings()->get('app_name');
        $this->address  = settings()->get('app_address');
        $this->logo     = settings()->get('app_logo');
    }

    public function updated($name)
    {
        $this->validateOnly($name);
    }

    public function save()
    {
        $this->validate();

        settings()->set([
            'app_name', $this->name,
            'app_address', $this->address,
        ]);

        if ($this->logo != null) {
            $logo = $this->logo->store('images', 'public');
            settings()->set('app_logo', $logo);
        }

        notyf()
            ->ripple(true)
            ->duration(1500)
            ->addSuccess('Información actualizada');
    }

    public function render()
    {
        return view('livewire.settings.business');
    }
}
